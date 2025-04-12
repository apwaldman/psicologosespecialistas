<?php
session_start();

// Páginas que não requerem autenticação
$public_pages = [
    '../index.php',
    '../cadastro.php',
    '../confirmar_cadastro.php',
    '../redefinir_senha.php',
    '../recuperar_senha.php',
    '../logout.php'
];

// Página atual sendo acessada
$current_page = $_SERVER['PHP_SELF'];

// Verifica se é uma página pública
$is_public = false;
foreach ($public_pages as $page) {
    if (strpos($current_page, $page) !== false) {
        $is_public = true;
        break;
    }
}

// Se não é página pública e usuário não está logado
if (!$is_public && empty($_SESSION['usuario_id'])) {
    $_SESSION['redirect_url'] = $current_page;
    header('Location: /login.php');
    exit;
}

// Se é página de login mas usuário já está logado
if (strpos($current_page, 'login.php') !== false && !empty($_SESSION['usuario_id'])) {
    $redirect = isset($_SESSION['usuario_admin']) && $_SESSION['usuario_admin'] == 1 
        ? '/admin_painel.php' 
        : '/painel.php';
    header("Location: $redirect");
    exit;
}
?>