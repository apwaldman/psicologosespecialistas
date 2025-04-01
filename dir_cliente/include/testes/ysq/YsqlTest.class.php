<?php
require_once __DIR__.'/../../conexao.php';

class YsqlTest {
    private $pdo;
    private const MIN_QUESTIONS = 10; // Ajuste para o número mínimo de questões esperadas

    public function __construct() {
        $this->pdo = Conexao::getConnection();
    }

    /**
     * Obtém todas as questões do teste
     */
    public function getQuestoes() {
        try {
            $stmt = $this->pdo->query("SELECT id, numero, texto FROM teste_ysql_questoes ORDER BY numero");
            $questoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if (count($questoes) < self::MIN_QUESTIONS) {
                throw new Exception("Número insuficiente de questões encontradas");
            }
            
            return $questoes;
        } catch (PDOException $e) {
            error_log("Erro ao buscar questões: " . $e->getMessage());
            throw new Exception("Erro ao carregar o teste. Por favor, tente novamente.");
        }
    }

    /**
     * Processa as respostas do usuário
     */
    public function processarRespostas($postData, $usuarioId) {
        // Validação do usuário
        $this->validarUsuario($usuarioId);
        
        // Validação básica dos dados
        if (empty($postData) || !is_array($postData)) {
            throw new Exception("Nenhuma resposta foi recebida");
        }

        try {
            $this->pdo->beginTransaction();

            // 1. Registrar a resposta principal
            $respostaId = $this->registrarRespostaPrincipal($usuarioId);
            
            // 2. Processar cada questão
            $questoesRespondidas = $this->processarItensResposta($postData, $respostaId);
            
            // 3. Verificar completude
            $totalQuestoes = $this->getTotalQuestoes();
            if ($questoesRespondidas < $totalQuestoes) {
                throw new Exception("Responda todas as questões antes de enviar");
            }

            // 4. Calcular resultados
            $this->calcularResultados($respostaId, $usuarioId);

            $this->pdo->commit();
            
            return [
                'success' => true,
                'message' => 'Respostas salvas com sucesso!',
                'resposta_id' => $respostaId
            ];

        } catch (Exception $e) {
            $this->pdo->rollBack();
            error_log("Erro ao processar respostas: " . $e->getMessage());
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Métodos auxiliares
     */
    private function validarUsuario($usuarioId) {
        if (!is_numeric($usuarioId) || $usuarioId <= 0) {
            throw new Exception("ID de usuário inválido");
        }

        $stmt = $this->pdo->prepare("SELECT id FROM usuarios WHERE id = ?");
        $stmt->execute([$usuarioId]);
        
        if (!$stmt->fetch()) {
            throw new Exception("Usuário não encontrado");
        }
    }

    private function registrarRespostaPrincipal($usuarioId) {
        $stmt = $this->pdo->prepare(
            "INSERT INTO teste_ysql_respostas 
             (usuario_id, data_resposta, completo) 
             VALUES (?, NOW(), 1)"
        );
        
        if (!$stmt->execute([$usuarioId])) {
            throw new Exception("Falha ao registrar resposta");
        }
        
        return $this->pdo->lastInsertId();
    }

    private function processarItensResposta($postData, $respostaId) {
        $stmt = $this->pdo->prepare(
            "INSERT INTO teste_ysql_respostas_itens 
             (resposta_id, questao_numero, valor) 
             VALUES (?, ?, ?)"
        );

        $questoesRespondidas = 0;
        
        foreach ($postData as $key => $value) {
            if (strpos($key, 'questao_') === 0) {
                $questaoId = (int)str_replace('questao_', '', $key);
                $valor = (int)$value;
                
                if ($valor < 1 || $valor > 6) {
                    throw new Exception("Valor inválido para questão $questaoId");
                }
                
                $questaoNumero = $this->getQuestaoNumero($questaoId);
                $stmt->execute([$respostaId, $questaoNumero, $valor]);
                $questoesRespondidas++;
            }
        }
        
        return $questoesRespondidas;
    }

    private function getQuestaoNumero($questaoId) {
        $stmt = $this->pdo->prepare("SELECT numero FROM teste_ysql_questoes WHERE id = ?");
        $stmt->execute([$questaoId]);
        $numero = $stmt->fetchColumn();
        
        if (!$numero) {
            throw new Exception("Questão $questaoId não encontrada");
        }
        
        return $numero;
    }

    private function getTotalQuestoes() {
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM teste_ysql_questoes");
        return (int)$stmt->fetchColumn();
    }

    private function calcularResultados($respostaId, $usuarioId) {
        // Implemente seu cálculo específico aqui
        // Exemplo simplificado:
        $stmt = $this->pdo->prepare(
            "INSERT INTO teste_ysql_resultados 
             (resposta_id, usuario_id, data_calculo, total_geral) 
             VALUES (?, ?, NOW(), 0)" // O total real seria calculado aqui
        );
        $stmt->execute([$respostaId, $usuarioId]);
    }
}
?>