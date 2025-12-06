<?php
class Conexao {
    private static $host = "localhost";
    private static $db   = "gestao_escola";
    private static $user = "root";
    private static $pass = "";
    private static $conn;

    // Impede instanciação direta
    private function __construct() {}

    // Retorna a conexão PDO (singleton)
    public static function getConexao() {
        if (!isset(self::$conn)) {
            try {
                self::$conn = new PDO(
                    "mysql:host=" . self::$host . ";dbname=" . self::$db . ";charset=utf8",
                    self::$user,
                    self::$pass,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
            } catch (PDOException $e) {
                die("Erro de conexão: " . $e->getMessage());
            }
        }
        return self::$conn;
    }
}
?>

