<?php
session_start(); // Inicia a sessão para armazenar mensagens
require '../conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conexao = new Conexao();
    $conn = $conexao->getConnection();

    // Configurar a conexão para usar UTF-8
    $conn->exec("SET NAMES 'utf8'");
    $conn->exec("SET CHARACTER SET 'utf8'");

    // Coletando os dados do formulário
    $nome_completo = strip_tags(trim($_POST['nome_completo']));
    $data_nascimento = $_POST['data_nascimento'];
    $idade = $_POST['idade'];
    
    // Remover máscaras de CPF, e Celular
    $cpf = preg_replace('/[^0-9]/', '', $_POST['cpf']);
    $celular = preg_replace('/[^0-9]/', '', $_POST['celular']);

    $profissao = $_POST['profissao'];
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $cep = $_POST['cep'];
    $endereco = $_POST['endereco'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $estado_civil = $_POST['estado_civil'];
    $naturalidade = $_POST['naturalidade'];
    $escolaridade = $_POST['escolaridade'];
    $senha = $_POST['senha'];
    $confirmacao_senha = $_POST['confirmacao_senha'];

    // Validando os campos obrigatórios
    $campos_obrigatorios = [
        'nome_completo' => $nome_completo,
        'data_nascimento' => $data_nascimento,
        'cpf' => $cpf,
        'profissao' => $profissao,
        'email' => $email,
        'celular' => $celular,
        'cep' => $cep,
        'endereco' => $endereco,
        'numero' => $numero,
        'bairro' => $bairro,
        'cidade' => $cidade,
        'estado' => $estado,
        'estado_civil' => $estado_civil,
        'naturalidade' => $naturalidade,
        'escolaridade' => $escolaridade
    ];

    foreach ($campos_obrigatorios as $campo => $valor) {
        if (empty($valor)) {
            $_SESSION['erro_' . $campo] = "O campo " . ucfirst(str_replace('_', ' ', $campo)) . " é obrigatório.";
            header('Location: https://cliente.psicologosespecialistas.com.br/cadastro.php');
            exit();
        }
    }

    // Validando a senha e confirmação de senha
    if ($senha !== $confirmacao_senha) {
        $_SESSION['erro_senha'] = "As senhas não coincidem!";
        header('Location: https://cliente.psicologosespecialistas.com.br/cadastro.php');
        exit();
    }

    // Validando o e-mail
    if (!$email) {
        $_SESSION['erro_email'] = "Por favor, insira um endereço de e-mail válido.";
        header('Location: https://cliente.psicologosespecialistas.com.br/cadastro.php');
        exit();
    }

    // Verificando se o CPF ou email já existe no banco de dados
    $sql_check = "SELECT * FROM usuarios WHERE cpf = :cpf OR email = :email";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bindParam(':cpf', $cpf);
    $stmt_check->bindParam(':email', $email);
    $stmt_check->execute();
    
    if ($stmt_check->rowCount() > 0) {
        $_SESSION['erro_cpf'] = "Já existe um usuário com este CPF ou e-mail.";
        header('Location: https://cliente.psicologosespecialistas.com.br/cadastro.php');
        exit();
    }

    // Hash da senha
    $senha_hash = password_hash($senha, PASSWORD_BCRYPT);

    // Inserindo os dados no banco
    $sql = "INSERT INTO usuarios (nome_completo, data_nascimento, idade, cpf, profissao, email, celular, cep, endereco, numero, complemento, bairro, cidade, estado, estado_civil, naturalidade, escolaridade, senha) 
            VALUES (:nome_completo, :data_nascimento, :idade, :cpf, :profissao, :email, :celular, :cep, :endereco, :numero, :complemento, :bairro, :cidade, :estado, :estado_civil, :naturalidade, :escolaridade, :senha)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nome_completo', $nome_completo);
    $stmt->bindParam(':data_nascimento', $data_nascimento);
    $stmt->bindParam(':idade', $idade);
    $stmt->bindParam(':cpf', $cpf);   
    $stmt->bindParam(':profissao', $profissao);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':celular', $celular);
    $stmt->bindParam(':cep', $cep);
    $stmt->bindParam(':endereco', $endereco);
    $stmt->bindParam(':numero', $numero);
    $stmt->bindParam(':complemento', $complemento);
    $stmt->bindParam(':bairro', $bairro);
    $stmt->bindParam(':cidade', $cidade);
    $stmt->bindParam(':estado', $estado);
    $stmt->bindParam(':estado_civil', $estado_civil);
    $stmt->bindParam(':naturalidade', $naturalidade);
    $stmt->bindParam(':escolaridade', $escolaridade);
    $stmt->bindParam(':senha', $senha_hash);

    if ($stmt->execute()) {
        // Enviar e-mail de confirmação
        try {
            $destinatario = $email;
            $remetente = "contato@waldmanpsicologia.com.br"; // Substitua pelo seu domínio
            $assunto = "Confirmação de Cadastro";
           
            $headers = "From: " . $remetente . "\r\n";
            $headers .= "Reply-To: " . $email . "\r\n";
            $headers .= "Content-type: text/html; charset=UTF-8\r\n";

            $corpo_email = "<strong>Olá, $nome_completo!</strong><br><br>";
            $corpo_email .= "Por favor, clique no link abaixo para confirmar seu cadastro:<br><br>";
            $corpo_email .= "<a href='https://cliente.psicologosespecialistas.com.br/confirmar_cadastro.php?email=" . urlencode($email) . "&token=" . md5($email . time()) . "'>Confirmar Cadastro</a><br><br>";
            $corpo_email .= "Atenciosamente,<br>Equipe Waldman Psicologia";
            
            if (mail($destinatario, $assunto, $corpo_email, $headers)) {
                $_SESSION['sucesso'] = "Cadastro realizado com sucesso! Um e-mail de confirmação foi enviado.";
                header('Location: https://cliente.psicologosespecialistas.com.br/cadastro.php');
                exit();
            } else {
                $_SESSION['erro_email'] = "Erro ao enviar e-mail de confirmação. Tente novamente mais tarde.";
                header('Location: https://cliente.psicologosespecialistas.com.br/cadastro.php');
                exit();
            }
        } catch (Exception $e) {
            $_SESSION['erro_email'] = "Erro ao enviar e-mail de confirmação. " . $e->getMessage();
            header('Location: https://cliente.psicologosespecialistas.com.br/cadastro.php');
            exit();
        }
    } else {
        $_SESSION['erro_banco'] = "Erro ao cadastrar usuário. Tente novamente mais tarde.";
        header('Location: https://cliente.psicologosespecialistas.com.br/cadastro.php');
        exit();
    }
}
?>