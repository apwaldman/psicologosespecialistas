<?php
// Verifica se há mensagens de erro ou sucesso na sessão
$mensagens = [];

if (isset($_SESSION['erro_nome_completo'])) {
    $mensagens[] = ['tipo' => 'erro', 'texto' => $_SESSION['erro_nome_completo']];
    unset($_SESSION['erro_nome_completo']);
}
if (isset($_SESSION['erro_crp'])) {
    $mensagens[] = ['tipo' => 'erro', 'texto' => $_SESSION['erro_crp']];
    unset($_SESSION['erro_crp']);
}
if (isset($_SESSION['erro_data_nascimento'])) {
    $mensagens[] = ['tipo' => 'erro', 'texto' => $_SESSION['erro_data_nascimento']];
    unset($_SESSION['erro_data_nascimento']);
}
if (isset($_SESSION['erro_cpf'])) {
    $mensagens[] = ['tipo' => 'erro', 'texto' => $_SESSION['erro_cpf']];
    unset($_SESSION['erro_cpf']);
}
if (isset($_SESSION['erro_profissao'])) {
    $mensagens[] = ['tipo' => 'erro', 'texto' => $_SESSION['erro_profissao']];
    unset($_SESSION['erro_profissao']);
}
if (isset($_SESSION['erro_email'])) {
    $mensagens[] = ['tipo' => 'erro', 'texto' => $_SESSION['erro_email']];
    unset($_SESSION['erro_email']);
}
if (isset($_SESSION['erro_celular'])) {
    $mensagens[] = ['tipo' => 'erro', 'texto' => $_SESSION['erro_celular']];
    unset($_SESSION['erro_celular']);
}
if (isset($_SESSION['erro_cep'])) {
    $mensagens[] = ['tipo' => 'erro', 'texto' => $_SESSION['erro_cep']];
    unset($_SESSION['erro_cep']);
}
if (isset($_SESSION['erro_endereco'])) {
    $mensagens[] = ['tipo' => 'erro', 'texto' => $_SESSION['erro_endereco']];
    unset($_SESSION['erro_endereco']);
}
if (isset($_SESSION['erro_numero'])) {
    $mensagens[] = ['tipo' => 'erro', 'texto' => $_SESSION['erro_numero']];
    unset($_SESSION['erro_numero']);
}
if (isset($_SESSION['erro_bairro'])) {
    $mensagens[] = ['tipo' => 'erro', 'texto' => $_SESSION['erro_bairro']];
    unset($_SESSION['erro_bairro']);
}
if (isset($_SESSION['erro_cidade'])) {
    $mensagens[] = ['tipo' => 'erro', 'texto' => $_SESSION['erro_cidade']];
    unset($_SESSION['erro_cidade']);
}
if (isset($_SESSION['erro_estado'])) {
    $mensagens[] = ['tipo' => 'erro', 'texto' => $_SESSION['erro_estado']];
    unset($_SESSION['erro_estado']);
}
if (isset($_SESSION['erro_estado_civil'])) {
    $mensagens[] = ['tipo' => 'erro', 'texto' => $_SESSION['erro_estado_civil']];
    unset($_SESSION['erro_estado_civil']);
}
if (isset($_SESSION['erro_naturalidade'])) {
    $mensagens[] = ['tipo' => 'erro', 'texto' => $_SESSION['erro_naturalidade']];
    unset($_SESSION['erro_naturalidade']);
}
if (isset($_SESSION['erro_escolaridade'])) {
    $mensagens[] = ['tipo' => 'erro', 'texto' => $_SESSION['erro_escolaridade']];
    unset($_SESSION['erro_escolaridade']);
}
if (isset($_SESSION['erro_senha'])) {
    $mensagens[] = ['tipo' => 'erro', 'texto' => $_SESSION['erro_senha']];
    unset($_SESSION['erro_senha']);
}
if (isset($_SESSION['erro_confirmacao_senha'])) {
    $mensagens[] = ['tipo' => 'erro', 'texto' => $_SESSION['erro_confirmacao_senha']];
    unset($_SESSION['erro_confirmacao_senha']);
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
        echo "<script>exibirPopupMsgUsuario('$titulo', '{$mensagem['texto']}');</script>";
    }
}
?>