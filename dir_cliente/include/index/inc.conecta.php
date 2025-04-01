<?php
ob_start(); // Inicia o buffer de saída para evitar erro de headers
session_start();

// Inclui a conexão corretamente
require_once __DIR__ . '/../conexao.php';

// Verifica se o usuário já está logado
if (isset($_SESSION['usuario_id'])) {
    header("Location: ../../painel.php");
    exit();
}

// Verifica se há uma mensagem de erro
$erro = '';
if (isset($_GET['erro'])) {
    $erro = '<div class="alert alert-danger">CPF ou senha incorretos.</div>';
}
?>