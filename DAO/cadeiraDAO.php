<?php
require_once __DIR__ . '/../core/database.php';
require_once __DIR__ . '/../models/Cadeira.php';

class CadeiraDAO {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    public function listarTodas() {
        $stmt = $this->conn->query("SELECT * FROM cadeiras");
        $cadeirasData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $cadeiras = [];
        foreach ($cadeirasData as $c) {
            $cadeiras[] = new Cadeira($c['id'], $c['codigo']);
        }
        return $cadeiras;
    }

    public function estaDisponivel($filme_id, $cadeira_id) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM reservas WHERE filme_id = ? AND cadeira_id = ?");
        $stmt->execute([$filme_id, $cadeira_id]);
        return $stmt->fetchColumn() == 0;
    }
}
