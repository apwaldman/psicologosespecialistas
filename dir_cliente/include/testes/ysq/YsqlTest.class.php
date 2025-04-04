<?php
require_once __DIR__.'/../../conexao.php';

class YsqlTest {
    private $db;
    
    public function __construct() {
        try {
            $this->db = Conexao::getConnection();
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exception("Falha ao conectar ao banco de dados: " . $e->getMessage());
        }
    }

    public function getQuestoes() {
        $stmt = $this->db->query("
            SELECT q.*, e.nome as esquema_nome 
            FROM teste_ysql_questoes q
            JOIN teste_ysql_esquemas e ON q.esquema_id = e.id
            ORDER BY q.numero
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function processarRespostas($postData, $usuario_id) {
        try {
            $this->db->beginTransaction();

            $respostas = $this->extrairRespostas($postData);
            $respostaId = $this->salvarRespostasIndividuais($usuario_id, $respostas);
            
            // Calcula pontuações corretamente
            $pontuacoesArray = $this->calcularPontuacoes($respostas);
            
            // Prepara dados para salvarResultados
            $pontuacoes = [];
            foreach ($pontuacoesArray as $esquema) {
                $pontuacoes[$esquema['esquema_id']] = $esquema['pontuacao'];
            }
            
            $interpretacao = $this->gerarInterpretacao($pontuacoesArray);
            
            $resultadoId = $this->salvarResultados($usuario_id, $interpretacao, $pontuacoes, $respostaId);
            
            $this->db->commit();
            
            return [
                'success' => true,
                'message' => 'Respostas processadas com sucesso!',
                'resultado_id' => $resultadoId,
                'interpretacao' => $interpretacao
            ];
            
        } catch (Exception $e) {
            $this->db->rollBack();
            return [
                'success' => false,
                'message' => 'Erro ao processar respostas: ' . $e->getMessage()
            ];
        }
    }

    private function salvarRespostasIndividuais($usuario_id, $respostas) {
        $data = date('Y-m-d H:i:s');
        
        $stmt = $this->db->query("DESCRIBE teste_ysql_respostas");
        $colunas = $stmt->fetchAll(PDO::FETCH_COLUMN);
        
        $dados = [
            'usuario_id' => $usuario_id,
            'data_resposta' => $data
        ];
        
        foreach ($respostas as $questaoId => $valor) {
            $coluna = "questao_" . $questaoId;
            if (in_array($coluna, $colunas)) {
                $dados[$coluna] = $valor;
            }
        }
        
        $colunas = implode(', ', array_keys($dados));
        $valores = ':' . implode(', :', array_keys($dados));
        
        $sql = "INSERT INTO teste_ysql_respostas ($colunas) VALUES ($valores)";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($dados);
        
        return $this->db->lastInsertId();
    }

    private function extrairRespostas($postData) {
        $respostas = [];
        
        foreach ($postData as $key => $value) {
            if (strpos($key, 'questao_') === 0) {
                $questaoId = str_replace('questao_', '', $key);
                $valor = (int)$value;
                
                if ($valor < 1 || $valor > 6) {
                    throw new Exception("Valor inválido para a questão {$questaoId}");
                }
                
                $respostas[$questaoId] = $valor;
            }
        }
        
        if (count($respostas) === 0) {
            throw new Exception('Nenhuma resposta foi enviada.');
        }
        
        return $respostas;
    }
    
    private function calcularPontuacoes($respostas) {
        $questoes = $this->getQuestoesComEsquemas();
        $pontuacoes = [];
        $contagem = [];
        
        foreach ($questoes as $questao) {
            $esquemaId = $questao['esquema_id'];
            $questaoId = $questao['id'];
            
            if (!isset($pontuacoes[$esquemaId])) {
                $pontuacoes[$esquemaId] = 0;
                $contagem[$esquemaId] = 0;
            }
            
            if (isset($respostas[$questaoId])) {
                $pontuacoes[$esquemaId] += $respostas[$questaoId];
                $contagem[$esquemaId]++;
            }
        }
        
        $resultado = [];
        $esquemas = $this->getEsquemas();
        
        foreach ($pontuacoes as $esquemaId => $total) {
            $media = $contagem[$esquemaId] > 0 ? round($total / $contagem[$esquemaId], 2) : 0;
            
            $resultado[] = [
                'esquema_id' => $esquemaId,
                'nome' => $esquemas[$esquemaId],
                'pontuacao' => $media,
                'questoes_respondidas' => $contagem[$esquemaId]
            ];
        }
        
        return $resultado;
    }

    private function getQuestoesComEsquemas() {
        $stmt = $this->db->query("
            SELECT q.id, q.esquema_id, e.nome 
            FROM teste_ysql_questoes q
            JOIN teste_ysql_esquemas e ON q.esquema_id = e.id
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    
    private function gerarInterpretacao($pontuacoes) {
        // First get all schema descriptions from database
        $stmt = $this->db->query("SELECT id, nome, descricao FROM teste_ysql_esquemas");
        $esquemasInfo = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $esquemasInfo[$row['id']] = [
                'nome' => $row['nome'],
                'descricao' => $row['descricao']
            ];
        }
        
        // Sort by score (highest first)
        usort($pontuacoes, function($a, $b) {
            return $b['pontuacao'] <=> $a['pontuacao'];
        });
        
        $output = "RESULTADO DO TESTE YSQL\n\n";
        $output .= "Pontuações por Esquema:\n";
        
        foreach ($pontuacoes as $esquema) {
            $output .= sprintf("- %s: %.2f/6 (%d questões)\n", 
                $esquema['nome'], 
                $esquema['pontuacao'],
                $esquema['questoes_respondidas']);
        }
        
        
        // Filter only elevated schemas (≥4)
        $esquemasElevados = array_filter($pontuacoes, fn($e) => $e['pontuacao'] >= 4);
        
        if (!empty($esquemasElevados)) {
            $output .= "ESQUEMAS ELEVADOS E SUAS INTERPRETAÇÕES:\n";
            foreach ($esquemasElevados as $esquema) {
                $output .= sprintf("\n%s: %.2f/6\n", $esquema['nome'], $esquema['pontuacao']);
                
                // Add schema description if available
                if (isset($esquemasInfo[$esquema['esquema_id']])) {
                    $output .= "Significado: " . $esquemasInfo[$esquema['esquema_id']]['descricao'] . "\n";
                }
            }
        } else {
            $output .= "Ausência de indícios de esquemas iniciais desadaptativos\n";
        }
        
       
        
        return $output;
    }
    
    private function getEsquemas() {
        $stmt = $this->db->query("SELECT id, nome FROM teste_ysql_esquemas");
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $esquemas = [];
        foreach ($result as $row) {
            $esquemas[$row['id']] = $row['nome'];
        }
        
        return $esquemas;
    }
    
    private function salvarResultados($usuario_id, $interpretacao, $pontuacoes, $respostaId) {
        $mapeamentoEsquemas = [
            1 => 'privacao_emocional',
            2 => 'abandono',
            3 => 'desconfianca_abuso',
            4 => 'isolamento_social_alienacao',
            5 => 'defectividade_vergonha',
            6 => 'fracasso',
            7 => 'dependencia_incompetencia',
            8 => 'vulnerabilidade_dano_doenca',
            9 => 'emaranhamento',
            10 => 'subjugacao',
            11 => 'autossacrificio',
            12 => 'inibicao_emocional',
            13 => 'padroes_inflexiveis',
            14 => 'arrogo_grandiosidade',
            15 => 'autocontrole_autodisciplina_insuficientes',
            16 => 'busca_aprovacao_reconhecimento',
            17 => 'negatividade_pessimismo',
            18 => 'postura_punitiva'
        ];
        
        $dados = [
            'usuario_id' => $usuario_id,
            'resposta_id' => $respostaId,            
            'interpretacao' => $interpretacao,
            'data_calculo' => date('Y-m-d H:i:s')
        ];
        
        foreach ($mapeamentoEsquemas as $esquemaId => $coluna) {
            $dados[$coluna] = $pontuacoes[$esquemaId] ?? 0;
        }
        
        $colunas = implode(', ', array_keys($dados));
        $valores = ':' . implode(', :', array_keys($dados));
        
        $sql = "INSERT INTO teste_ysql_resultados ($colunas) VALUES ($valores)";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($dados);
        
        return $this->db->lastInsertId();
    }
    
    public function getResultadosUsuario($usuario_id, $limit = 5) {
        $stmt = $this->db->prepare("
            SELECT * FROM teste_ysql_resultados
            WHERE usuario_id = :usuario_id
            ORDER BY data_calculo DESC
            LIMIT :limit
        ");
        $stmt->bindValue(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}