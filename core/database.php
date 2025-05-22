<?php

class Database {
    private static $instance = null;

    private function __construct() {}

    public static function getConnection() {
        if (self::$instance === null) {
            $pdo = new PDO("mysql:host=localhost;dbname=cinema;charset=utf8", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instance = $pdo;
        }
        return self::$instance;
    }
}
