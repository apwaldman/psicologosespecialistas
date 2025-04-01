<?php
ob_start();
session_start();
require_once __DIR__ . '/include/conexao.php';
require_once __DIR__ . '/include/usuario.php';

// Verifica se os dados foram enviados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cpf = $_POST['cpf'] ?? '';
    $senha = $_POST['senha'] ?? '';

    // Valida as credenciais
    $usuario = Usuario::verificarCredenciais($cpf, $senha);

    if (isset($_SESSION['usuario_id'])) {
        header("Location: ../../painel.php");
        exit();
    }
    
    // Exibe popup se houver erro
    $erro = '';
    if (isset($_GET['erro'])) {
        echo '<script>alert("CPF ou senha incorretos!");</script>';
        // Mantém a mensagem original se desejar
        $erro = '<div class="alert alert-danger">CPF ou senha incorretos.</div>';
    }
}