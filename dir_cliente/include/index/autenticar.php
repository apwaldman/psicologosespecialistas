<?php
ob_start();
session_start();
require_once __DIR__ . '/../conexao.php';

class Autenticacao {
    private $pdo;

    public function __construct() {
        $this->pdo = Conexao::getConnection();
    }

    public function limparCPF($cpf) {
        // Remove todos os caracteres não numéricos
        $cpfLimpo = preg_replace('/[^0-9]/', '', $cpf);
        
        // Verifica se tem 11 dígitos após a limpeza
        if (strlen($cpfLimpo) !== 11) {
            return false;
        }
        
        return $cpfLimpo;
    }

    public function autenticar($cpf, $senha) {
        // Limpa e valida o CPF
        $cpfLimpo = $this->limparCPF($cpf);
        if (!$cpfLimpo) {
            return ['sucesso' => false, 'erro' => 'CPF inválido. Digite os 11 dígitos.'];
        }

        // Validação básica dos campos
        if (empty($senha)) {
            return ['sucesso' => false, 'erro' => 'Preencha a senha.'];
        }

        try {
            // Consulta o usuário no banco de dados incluindo o campo admin
            $sql = "SELECT id, nome_completo, cpf, senha, admin FROM usuarios WHERE cpf = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$cpfLimpo]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$usuario) {
                return ['sucesso' => false, 'erro' => 'Usuário não encontrado.'];
            }

            if (!password_verify($senha, $usuario['senha'])) {
                return ['sucesso' => false, 'erro' => 'Senha incorreta.'];
            }

            return ['sucesso' => true, 'usuario' => $usuario];
        } catch (PDOException $e) {
            error_log('Erro na autenticação: ' . $e->getMessage());
            return ['sucesso' => false, 'erro' => 'Erro no sistema. Por favor, tente novamente.'];
        }
    }
}

// Processamento do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $autenticacao = new Autenticacao();
    $resultado = $autenticacao->autenticar($_POST['cpf'] ?? '', $_POST['senha'] ?? '');

    if ($resultado['sucesso']) {
        // Login bem-sucedido
        $_SESSION['usuario_id'] = $resultado['usuario']['id'];
        $_SESSION['usuario_nome'] = $resultado['usuario']['nome_completo'];
        $_SESSION['usuario_cpf'] = $resultado['usuario']['cpf'];
        $_SESSION['usuario_admin'] = $resultado['usuario']['admin'] ?? 0;
        
        // Redireciona para a URL armazenada ou para o painel apropriado
        $redirect_url = $_SESSION['redirect_url'] ?? 
                      ($_SESSION['usuario_admin'] == 1 ? '/admin_painel.php' : '/painel.php');
        unset($_SESSION['redirect_url']);
        
        header("Location: $redirect_url");
        exit;
    } else {
        // Armazena mensagem de erro e redireciona
        $_SESSION['erro'] = $resultado['erro'] ?? 'Erro desconhecido.';
        header("Location: ../../index.php");
        exit();
    }
} else {
    // Se não for POST, redireciona para index
    header("Location: ../../index.php");
    exit();
}
?>