<?php
require_once __DIR__ . '/../conexao.php';

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['email'])) {
        $email = trim($_POST['email']);

        try {
            $conexao = new Conexao();
            $conn = $conexao->getConnection();

            // Verifica se o e-mail existe no banco de dados
            $sql = "SELECT id FROM usuarios WHERE email = :email";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario) {
                // Gera um token único para recuperação de senha
                $token = bin2hex(random_bytes(32));
                $expiracao = date("Y-m-d H:i:s", strtotime("+1 hour")); // Expira em 1 hora

                // Atualiza o banco com o token
                $sql = "UPDATE usuarios SET token_recuperacao = :token, token_expiracao = :expiracao WHERE id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':token', $token);
                $stmt->bindParam(':expiracao', $expiracao);
                $stmt->bindParam(':id', $usuario['id']);
                $stmt->execute();

                // Configuração do e-mail
                $destinatario = $email;
                $remetente = "contato@waldmanpsicologia.com.br";
                $assunto = "Recuperação de Senha";
                $headers = "From: " . $remetente . "\r\n";
                $headers .= "Reply-To: " . $remetente . "\r\n";
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

                $link = "https://cliente.waldmanpsicologia.com.br/redefinir_senha.php?token=$token";
                
                $corpo_email = "<html><body>";
                $corpo_email .= "<p>Olá,</p>";
                $corpo_email .= "<p>Recebemos uma solicitação para redefinir sua senha. Para continuar, clique no link abaixo:</p>";
                $corpo_email .= "<p><a href='$link'>$link</a></p>";
                $corpo_email .= "<p>Se você não solicitou a alteração, ignore este e-mail.</p>";
                $corpo_email .= "<p>Atenciosamente,<br>Waldman Psicologia</p>";
                $corpo_email .= "</body></html>";

                if (mail($destinatario, $assunto, $corpo_email, $headers)) {
                    $mensagem = "Um e-mail foi enviado com instruções para redefinir sua senha.";
                } else {
                    $mensagem = "Erro ao enviar o e-mail. Tente novamente mais tarde.";
                }
            } else {
                $mensagem = "E-mail não encontrado.";
            }
        } catch (Exception $e) {
            $mensagem = "Erro ao processar a solicitação.";
        }
    } else {
        $mensagem = "Por favor, insira um e-mail válido.";
    }
}
?>
