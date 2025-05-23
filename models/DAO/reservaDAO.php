<?php
require_once __DIR__ . '/../../core/database.php';
require_once __DIR__ . '/../Reserva.php';

class ReservaDAO {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    public function reservar(Reserva $reserva) {
        $stmt = $this->conn->prepare("INSERT INTO reservas (nome, email, filme_id, cadeira_id) VALUES (?, ?, ?, ?)");
        return $stmt->execute([
            $reserva->nome,
            $reserva->email,
            $reserva->filme_id,
            $reserva->cadeira_id
        ]);
    }

    public function cancelarTodas($nome, $email, $filme_id) {
        $stmt = $this->conn->prepare("DELETE FROM reservas WHERE nome = ? AND email = ? AND filme_id = ?");
        return $stmt->execute([$nome, $email, $filme_id]);
    }

    public function listarPorFilme($filme_id) {
        $stmt = $this->conn->prepare("SELECT r.*, c.codigo FROM reservas r JOIN cadeiras c ON r.cadeira_id = c.id WHERE filme_id = ?");
        $stmt->execute([$filme_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarReservas($nome, $email, $filme_id) {
        $stmt = $this->conn->prepare("SELECT * FROM reservas WHERE nome = ? AND email = ? AND filme_id = ?");
        $stmt->execute([$nome, $email, $filme_id]);
        $reservasData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $reservas = [];
        foreach ($reservasData as $r) {
            $reservas[] = new Reserva($r['id'], $r['nome'], $r['email'], $r['filme_id'], $r['cadeira_id']);
        }
        return $reservas;
    }
}
