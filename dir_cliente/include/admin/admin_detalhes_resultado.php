<?php
// TOPO ABSOLUTO - sem espaços antes
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Debug - Verificando estágios</h1>";
echo "<h2>Etapa 1: Sessão</h2>";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

echo "<pre>Sessão: ";
print_r($_SESSION);
echo "</pre>";

echo "<h2>Etapa 2: Autenticação</h2>";
if (!isset($_SESSION['usuario_admin'])) {
    die("Variável usuario_admin não definida na sessão");
}

if ($_SESSION['usuario_admin'] != 1) {
    die("Acesso negado - Não é admin");
}

echo "<h2>Etapa 3: Conexão com banco</h2>";
require_once __DIR__ . '/../conexao.php';
try {
    $pdo = Conexao::getConnection();
    echo "Conexão OK<br>";
} catch (Exception $e) {
    die("Erro conexão: " . $e->getMessage());
}

echo "<h2>Etapa 4: Consulta</h2>";
$usuario_id = intval($_GET['usuario_id'] ?? 0);
if ($usuario_id <= 0) {
    die("ID de usuário inválido");
}

$query = "SELECT r.*, u.nome_completo, u.cpf, e.nome as esquema_nome, e.descricao as esquema_descricao 
          FROM teste_ysql_resultados r
          JOIN usuarios u ON r.usuario_id = u.id
          JOIN teste_ysql_esquemas e ON r.esquema_id = e.id
          WHERE r.usuario_id = ?";

echo "Query: " . htmlspecialchars($query) . "<br>";
echo "Usuário ID: $usuario_id<br>";

try {
    $stmt = $pdo->prepare($query);
    $stmt->execute([$usuario_id]);
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<pre>Resultados: ";
    print_r($resultados);
    echo "</pre>";
    
    if (empty($resultados)) {
        die("Nenhum resultado encontrado");
    }
} catch (PDOException $e) {
    die("Erro na consulta: " . $e->getMessage());
}

// Se chegou até aqui, mostre os dados normalmente
?>
<!DOCTYPE html>
<html>
<head>
    <title>Resultados</title>
</head>
<body>
    <h1>Dados encontrados</h1>
    <pre><?php print_r($resultados); ?></pre>
</body>
</html>