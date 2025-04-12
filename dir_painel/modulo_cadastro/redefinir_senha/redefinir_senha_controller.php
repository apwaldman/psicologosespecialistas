<?php
require_once __DIR__ . '/../conexao.php';

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $token = $_POST['token'];
    $nova_senha = $_POST['nova_senha'];
    $confirmar_senha = $_POST['confirmar_senha'];

    if ($nova_senha !== $confirmar_senha) {
        $mensagem = "As senhas n�o coincidem.";
    } else {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        // Verifica se o token � v�lido e n�o expirou
        $sql = "SELECT id FROM usuarios WHERE token_recuperacao = :token AND token_expiracao > NOW()";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            // Atualiza a senha e limpa o token
            $senha_hash = password_hash($nova_senha, PASSWORD_BCRYPT);
            $sql = "UPDATE usuarios SET senha = :senha, token_recuperacao = NULL, token_expiracao = NULL WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':senha', $senha_hash);
            $stmt->bindParam(':id', $usuario['id']);
            $stmt->execute();

            $mensagem = "Senha redefinida com sucesso!";
        } else {
            $mensagem = "Token inv�lido ou expirado.";
        }
    }
} else {
    $token = $_GET['token'] ?? '';
}
?>
