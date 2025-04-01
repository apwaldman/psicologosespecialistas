<?php
require_once __DIR__ . '/../conexao.php';

header('Content-Type: application/json'); // Define o cabeçalho como JSON

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cpf = $_POST['cpf'];
    $conexao = new Conexao();
    $conn = $conexao->getConnection();

    // Remove caracteres não numéricos do CPF
    $cpf = preg_replace('/[^0-9]/', '', $cpf);

    // Verifica se o CPF já existe no banco de dados
    $sql = "SELECT * FROM usuarios WHERE cpf = :cpf";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':cpf', $cpf);
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