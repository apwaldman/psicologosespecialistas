<?php

class Conexao {
    private static $host = 'mysql.psicologosespecialistas.com.br';
    private static $dbname = 'psicologosespe';
    private static $username = 'psicologosespe';
    private static $password = 'Danu6664';
    private static $conn = null;

    public static function getConnection() {
        if (self::$conn === null) {
            try {
                self::$conn = new PDO(
                    "mysql:host=" . self::$host . ";dbname=" . self::$dbname,
                    self::$username,
                    self::$password,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES => false
                    ]
                );
            } catch (PDOException $e) {
                die("Erro de conexão com o banco de dados."); // Não use echo
            }
        }
        return self::$conn;
    }
}
