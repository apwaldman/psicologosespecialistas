<?php

class Conexao {
    private static $host = 'mysql.psicologosespecialistas.com.br';
    private static $dbname = 'psicologosespe01';
    private static $username = 'psicologosespe01';
    private static $password = 'Danu666';
    private static $conn = null;

    public static function getConnection() {
        if (self::$conn === null) {
            try {
                // Adicionando charset=utf8mb4 na string de conexão
                $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$dbname . ";charset=utf8mb4";
                
                self::$conn = new PDO(
                    $dsn,
                    self::$username,
                    self::$password,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES => false,
                        // Configuração adicional para garantir UTF-8
                        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"
                    ]
                );
                
                // Executa comandos adicionais para garantir a codificação
                self::$conn->exec("SET CHARACTER SET utf8mb4");
                
            } catch (PDOException $e) {
                // Log do erro em arquivo (mais seguro que die())
                error_log("Erro de conexão com o banco de dados: " . $e->getMessage());
                throw new Exception("Erro ao conectar com o banco de dados. Por favor, tente novamente mais tarde.");
            }
        }
        return self::$conn;
    }
}