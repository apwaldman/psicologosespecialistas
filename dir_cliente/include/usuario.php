<?php
require_once __DIR__ . 'conexao.php';

class Usuario {
    public static function verificarCredenciais($id_numero, $senha) {
        $conn = Conexao::getConnection();
        $stmt = $conn->prepare("SELECT id, senha FROM usuarios WHERE id_numero = :id_numero");
        $stmt->bindParam(':id_numero', $id_numero);
        $stmt->execute();
        $usuario = $stmt->fetch();

        // Verifica se encontrou o usuário e se a senha está correta
        if ($usuario && password_verify($senha, $usuario['senha'])) {
            return $usuario;
        }
        return false;
    }
}