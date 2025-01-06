<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = strip_tags(trim($_POST["nome"]));
    $email = strip_tags(trim($_POST["email"]));
    $telefone = strip_tags(trim($_POST["telefone"]));
    $assunto = strip_tags(trim($_POST["assunto"]));
    $mensagem = strip_tags(trim($_POST["mensagem"]));

    // Validação básica
    if (empty($nome) || empty($email) || empty($assunto) || empty($mensagem)) {
        $erro = "Por favor, preencha todos os campos obrigatórios.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "Por favor, insira um endereço de e-mail válido.";
    }

    if (empty($erro)) {
        try {
            $destinatario = "contato@waldmanpsicologia.com.br";
            $remetente = "contato@waldmanpsicologia.com.br"; // Substitua pelo seu domínio
            $headers = "From: " . $remetente . "\r\n";
            $headers .= "Reply-To: " . $email . "\r\n";
            $headers .= "Content-type: multipart/mixed; boundary=\"boundary\"\r\n";

            // Corpo do e-mail
            $corpo_email = "--boundary\r\n";
            $corpo_email .= "Content-Type: text/html; charset=UTF-8\r\n\r\n";
            $corpo_email .= "<strong>Nome:</strong> " . $nome . "<br>";
            $corpo_email .= "<strong>Email:</strong> " . $email . "<br>";
            $corpo_email .= "<strong>Telefone:</strong> " . $telefone . "<br>";
            $corpo_email .= "<strong>Assunto:</strong> " . $assunto . "<br>";
            $corpo_email .= "<strong>Mensagem:</strong> " . $mensagem . "<br>\r\n";

            // Verifica e anexa o arquivo, se enviado
            if (isset($_FILES["arquivo"]) && $_FILES["arquivo"]["error"] == 0) {
                $file = $_FILES["arquivo"];
                $file_data = file_get_contents($file["tmp_name"]);
                $file_encoded = chunk_split(base64_encode($file_data));

                $corpo_email .= "--boundary\r\n";
                $corpo_email .= "Content-Type: " . $file["type"] . "; name=\"" . $file["name"] . "\"\r\n";
                $corpo_email .= "Content-Disposition: attachment; filename=\"" . $file["name"] . "\"\r\n";
                $corpo_email .= "Content-Transfer-Encoding: base64\r\n\r\n";
                $corpo_email .= $file_encoded . "\r\n";
            }

            $corpo_email .= "--boundary--";

            // Envia o e-mail
            if (mail($destinatario, $assunto, $corpo_email, $headers)) {
                $_SESSION['contato_sucesso'] = "Mensagem enviada com sucesso!"; // Usando sessão
                $sucesso = "Mensagem enviada com sucesso!";
            } else {
                $_SESSION['contato_erro'] = "Erro ao enviar a mensagem."; // Usando sessão
                $erro = "Erro ao enviar a mensagem. Tente novamente mais tarde.";
            }
        } catch (Exception $e) {
            $erro = "Erro ao enviar a mensagem.";
        }
    }
}
?>