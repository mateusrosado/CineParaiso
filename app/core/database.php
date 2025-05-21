<?php
namespace app\core;

class Database {
    private static $instance = null;

    private function __construct() {}

    public static function getConnection() {
        if (self::$instance === null) {
            try {
                $pdo = new \PDO(
                    'mysql:host=localhost;dbname=cinema;charset=utf8',
                    'root',
                    '');
                    $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                    self::$instance = $pdo;
                    
            } catch (\PDOException $e) {
                echo "Erro na conexão: " . $e->getMessage();
            }
        }
        return self::$instance;
    }
}
