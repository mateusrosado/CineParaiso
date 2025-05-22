<?php
require_once __DIR__ . '/../core/database.php';
require_once __DIR__ . '/../models/Filme.php';

class FilmeDAO {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    public function listarTodos() {
        $stmt = $this->conn->query("SELECT * FROM filmes");
        $filmesData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $filmes = [];
        foreach ($filmesData as $f) {
            $filmes[] = new Filme($f['id'], $f['titulo'], $f['horario'], $f['descricao'], $f['capa_url']);
        }
        return $filmes;
    }

    public function buscarPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM filmes WHERE id = ?");
        $stmt->execute([$id]);
        $f = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($f) {
            return new Filme($f['id'], $f['titulo'], $f['horario'], $f['descricao'], $f['capa_url']);
        }
        return null;
    }
}
