<?php
require_once __DIR__ . '/../conexao.php';

header('Content-Type: application/json'); // Define o cabeçalho como JSON

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $conexao = new Conexao();
    $conn = $conexao->getConnection();

    // Verifica se o email já existe no banco de dados
    $sql = "SELECT * FROM usuarios WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo json_encode(['exists' => true]); // Retorna JSON com exists = true
    } else {
        echo json_encode(['exists' => false]); // Retorna JSON com exists = false
    }
} else {
    echo json_encode(['error' => 'Método não permitido.']); // Retorna JSON com erro
}
?>