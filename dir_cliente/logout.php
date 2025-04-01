<?php
// Inicia a sessão se não estiver iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Destroi todos os dados da sessão
$_SESSION = array();

// Se estiver usando cookies de sessão, remove o cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(), 
        '', 
        time() - 42000,
        $params["path"], 
        $params["domain"], 
        $params["secure"], 
        $params["httponly"]
    );
}

// Destroi a sessão
session_destroy();

// Redireciona para a página inicial (index.php)
header("Location: /index.php");
exit();
?>