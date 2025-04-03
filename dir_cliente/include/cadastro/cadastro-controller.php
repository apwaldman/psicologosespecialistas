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
    $id_numero = $_POST['id_numero'];
    $senha = $_POST['senha'];
    $confirmacao_senha = $_POST['confirmacao_senha'];
    $autoriza_pesquisa = isset($_POST['autoriza_pesquisa']) ? 1 : 0;

    // Validando os campos obrigatórios
    $campos_obrigatorios = [
        'nome_completo' => $nome_completo,
        'id_numero' => $id_numero,       
        'senha' => $senha
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

    // Verificando se o id já existe no banco de dados
    $sql_check = "SELECT * FROM usuarios WHERE id_numero = :id_numero";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bindParam(':id_numero', $id_numero);    
    $stmt_check->execute();
    
    if ($stmt_check->rowCount() > 0) {
        $_SESSION['erro_id_numero'] = "Já existe um usuário com este ID.";
        header('Location: https://cliente.psicologosespecialistas.com.br/cadastro.php');
        exit();
    }

    // Hash da senha
    $senha_hash = password_hash($senha, PASSWORD_BCRYPT);

    // Inserindo os dados no banco
    $sql = "INSERT INTO usuarios (nome_completo, id_numero, senha, autoriza_pesquisa) 
            VALUES (:nome_completo, :id_numero, :senha, :autoriza_pesquisa)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nome_completo', $nome_completo);
    $stmt->bindParam(':id_numero', $id_numero);      
    $stmt->bindParam(':senha', $senha_hash);
    $stmt->bindParam(':autoriza_pesquisa', $autoriza_pesquisa);

    if ($stmt->execute()) {
        $_SESSION['sucesso'] = "Cadastro realizado com sucesso!";
        header('Location: https://cliente.psicologosespecialistas.com.br/cadastro.php');
        exit();        
    } else {
        $_SESSION['erro_banco'] = "Erro ao cadastrar usuário. Tente novamente mais tarde.";
        header('Location: https://cliente.psicologosespecialistas.com.br/cadastro.php');
        exit();
    }
}
?>