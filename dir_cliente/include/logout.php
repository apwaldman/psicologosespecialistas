<?php
ob_start();
session_start();

// Limpa todos os dados da sessão
$_SESSION = array();

// Se deseja matar a sessão, também apague o cookie de sessão
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destrói a sessão
session_destroy();

// Redireciona para a página de login
header("Location: index.php?logout=1");
exit();
?>