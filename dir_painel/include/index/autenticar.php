<?php
ob_start();
session_start();
require_once __DIR__ . '/../conexao.php';

class Autenticacao {
    private $pdo;

    public function __construct() {
        $this->pdo = Conexao::getConnection();
    }

    public function autenticar($id_numero, $senha) {
        if (empty($id_numero)) {
            return ['sucesso' => false, 'erro' => 'Preencha o ID.'];
        }

        if (empty($senha)) {
            return ['sucesso' => false, 'erro' => 'Preencha a senha.'];
        }

        try {
            $sql = "SELECT id, nome_completo, id_numero, senha, admin FROM usuarios WHERE id_numero = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id_numero]);
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

// Verifica se o usuário já está autenticado para evitar loops
if (isset($_SESSION['usuario_id'])) {
    $redirect_url = $_SESSION['redirect_url'] ?? ($_SESSION['usuario_admin'] == 1 ? '/admin_painel.php' : '/painel.php');
    
    // Evita redirecionamento para a página de login
    if (strpos($redirect_url, 'index.php') !== false) {
        $redirect_url = ($_SESSION['usuario_admin'] == 1 ? '/admin_painel.php' : '/painel.php');
    }

    header("Location: $redirect_url");
    exit();
}

// Processamento do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $autenticacao = new Autenticacao();
    $resultado = $autenticacao->autenticar($_POST['id_numero'] ?? '', $_POST['senha'] ?? '');

    if ($resultado['sucesso']) {
        $_SESSION['usuario_id'] = $resultado['usuario']['id'];
        $_SESSION['usuario_nome'] = $resultado['usuario']['nome_completo'];
        $_SESSION['id_numero'] = $resultado['usuario']['id_numero'];
        $_SESSION['usuario_admin'] = $resultado['usuario']['admin'] ?? 0;

        // Evita redirecionamento para a própria página de login
        $redirect_url = $_SESSION['redirect_url'] ?? ($_SESSION['usuario_admin'] == 1 ? '/admin_painel.php' : '/painel.php');
        unset($_SESSION['redirect_url']);

        if (strpos($redirect_url, 'index.php') !== false) {
            $redirect_url = ($_SESSION['usuario_admin'] == 1 ? '/admin_painel.php' : '/painel.php');
        }

        header("Location: $redirect_url");
        exit();
    } else {
        $_SESSION['erro'] = $resultado['erro'] ?? 'Erro desconhecido.';
        header("Location: ../../index.php");
        exit();
    }
} else {
    header("Location: ../../index.php");
    exit();
}
?>
