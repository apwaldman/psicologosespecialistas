<?php
session_start(); // Inicia a sessão

// Verifica se há mensagens de erro ou sucesso na sessão
$mensagens = [];

if (isset($_SESSION['erro_nome_completo'])) {
    $mensagens[] = ['tipo' => 'erro', 'texto' => $_SESSION['erro_nome_completo']];
    unset($_SESSION['erro_nome_completo']);
}
if (isset($_SESSION['erro_data_nascimento'])) {
    $mensagens[] = ['tipo' => 'erro', 'texto' => $_SESSION['erro_data_nascimento']];
    unset($_SESSION['erro_data_nascimento']);
}
if (isset($_SESSION['erro_senha'])) {
    $mensagens[] = ['tipo' => 'erro', 'texto' => $_SESSION['erro_senha']];
    unset($_SESSION['erro_senha']);
}
if (isset($_SESSION['erro_cpf'])) {
    $mensagens[] = ['tipo' => 'erro', 'texto' => $_SESSION['erro_cpf']];
    unset($_SESSION['erro_cpf']);
}
if (isset($_SESSION['erro_email'])) {
    $mensagens[] = ['tipo' => 'erro', 'texto' => $_SESSION['erro_email']];
    unset($_SESSION['erro_email']);
}
if (isset($_SESSION['erro_celular'])) {
    $mensagens[] = ['tipo' => 'erro', 'texto' => $_SESSION['erro_celular']];
    unset($_SESSION['erro_celular']);
}
if (isset($_SESSION['erro_banco'])) {
    $mensagens[] = ['tipo' => 'erro', 'texto' => $_SESSION['erro_banco']];
    unset($_SESSION['erro_banco']);
}
if (isset($_SESSION['sucesso'])) {
    $mensagens[] = ['tipo' => 'sucesso', 'texto' => $_SESSION['sucesso']];
    unset($_SESSION['sucesso']);
}

// Exibe as mensagens em um popup
if (!empty($mensagens)) {
    foreach ($mensagens as $mensagem) {
        $titulo = ($mensagem['tipo'] === 'erro') ? 'Erro' : 'Sucesso';
        echo "<script>exibirPopup('$titulo', '{$mensagem['texto']}');</script>";
    }
}
?>