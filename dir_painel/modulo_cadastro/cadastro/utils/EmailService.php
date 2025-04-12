
<?php
class EmailService {
    public function enviarEmailConfirmacao(Usuario $usuario){
        $destinatario = $usuario->getEmail();
        $nome_completo = $usuario->getNomeCompleto();
        $remetente = "psicologosespecialistas@psicologosespecialistas.com.br"; // Substitua pelo seu domínio
        $assunto = "Confirmação de Cadastro";
        
        $headers = "From: " . $remetente . "\r\n";
        $headers .= "Reply-To: " . $destinatario . "\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";

        $corpo_email = "<strong>Olá, $nome_completo!</strong><br><br>";
        $corpo_email .= "Por favor, clique no link abaixo para confirmar seu cadastro:<br><br>";
        $corpo_email .= "<a href='https://painel.psicologosespecialistas.com.br/confirmar_cadastro.php?email=" . urlencode($destinatario) . "&token=" . md5($destinatario . time()) . "'>Confirmar Cadastro</a><br><br>";
        $corpo_email .= "Atenciosamente,<br>Equipe Waldman Psicologia";
        
        Try{
            if (mail($destinatario, $assunto, $corpo_email, $headers)) {
                $_SESSION['sucesso'] = "Cadastro realizado com sucesso! Um e-mail de confirmação foi enviado.";
                header('Location: https://painel.psicologosespecialistas.com.br/cadastro.php');
                exit();
            } else {
                $_SESSION['erro_email'] = "Erro ao enviar e-mail de confirmação. Tente novamente mais tarde.";
                header('Location: https://painel.psicologosespecialistas.com.br/cadastro.php');
                exit();
            }
        } catch (Exception $e) {
            $_SESSION['erro_email'] = "Erro ao enviar e-mail de confirmação. " . $e->getMessage();
            header('Location: https://painel.psicologosespecialistas.com.br/cadastro.php');
            exit();
        }
    }
}
?>