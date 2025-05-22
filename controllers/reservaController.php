<?php
require_once __DIR__ . '/../dao/FilmeDAO.php';
require_once __DIR__ . '/../dao/CadeiraDAO.php';
require_once __DIR__ . '/../dao/ReservaDAO.php';

class ReservaController {
    private $filmeDAO;
    private $cadeiraDAO;
    private $reservaDAO;

    public function __construct() {
        $this->filmeDAO = new FilmeDAO();
        $this->cadeiraDAO = new CadeiraDAO();
        $this->reservaDAO = new ReservaDAO();
    }

    public function index() {
        $filmes = $this->filmeDAO->listarTodos();
        include __DIR__ . '/../view/filmes.php';
    }

    public function reservar() {
        $msg = null;
        $filmes = $this->filmeDAO->listarTodos();
        $cadeiras = $this->cadeiraDAO->listarTodas();

        $filme_id = $_POST['filme_id'] ?? ($_GET['filme_id'] ?? null);
        $reservas = [];
        if ($filme_id) {
            $reservas = $this->reservaDAO->listarPorFilme($filme_id);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'] ?? '';
            $email = $_POST['email'] ?? '';
            $cadeirasSelecionadas = $_POST['cadeira_id'] ?? [];

            $sucesso = true;
            foreach ($cadeirasSelecionadas as $cadeira_id) {
                if ($this->cadeiraDAO->estaDisponivel($filme_id, $cadeira_id)) {
                    $reserva = new Reserva(null, $nome, $email, $filme_id, $cadeira_id);
                    $this->reservaDAO->reservar($reserva);
                } else {
                    $sucesso = false;
                    break;
                }
            }
            $msg = $sucesso ? "Reservas realizadas com sucesso!" : "Desculpe. Algumas cadeiras já estão reservadas.";
            $reservas = $this->reservaDAO->listarPorFilme($filme_id);
        }

        include __DIR__ . '/../view/reserva.php';
    }

    public function cancelar() {
        $msg = null;
        $filmes = $this->filmeDAO->listarTodos();

        $filme_id = $_POST['filme_id'] ?? ($_GET['filme_id'] ?? null);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'] ?? '';
            $email = $_POST['email'] ?? '';
            

            $reservasUsuario = $this->reservaDAO->buscarReservas($nome, $email, $filme_id);
            if (!empty($reservasUsuario)) {
                $this->reservaDAO->cancelarTodas($nome, $email, $filme_id);
                $msg = "Reservas canceladas com sucesso!";
            } else {
                $msg = "Nome ou email incorretos, ou nenhuma reserva encontrada.";
            }
        }

        include __DIR__ . '/../view/cancelar.php';
    }

    public function alterar() {
        $msg = null;
        $filmes = $this->filmeDAO->listarTodos();
        $cadeiras = $this->cadeiraDAO->listarTodas();

        $nome = $_POST['nome'] ?? '';
        $email = $_POST['email'] ?? '';
        $filme_id = $_POST['filme_id'] ?? ($_GET['filme_id'] ?? null);

        $reservas = [];
        if ($filme_id) {
            $reservas = $this->reservaDAO->listarPorFilme($filme_id);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cadeirasSelecionadas = $_POST['cadeira_id'] ?? [];

            $reservasUsuario = $this->reservaDAO->buscarReservas($nome, $email, $filme_id);
            $idsReservadasUsuario = array_map(fn($r) => $r->cadeira_id, $reservasUsuario);

            if (!empty($reservasUsuario)) {
                $todasDisponiveis = true;
                foreach ($cadeirasSelecionadas as $cadeira_id) {
                    if (!in_array($cadeira_id, $idsReservadasUsuario) && !$this->cadeiraDAO->estaDisponivel($filme_id, $cadeira_id)
                    ) {
                        $todasDisponiveis = false;
                        break;
                    }
                }
                if($todasDisponiveis){
                    $this->reservaDAO->cancelarTodas($nome, $email, $filme_id);

                    foreach ($cadeirasSelecionadas as $cadeira_id) {
                        $reserva = new Reserva(null, $nome, $email, $filme_id, $cadeira_id);
                        $this->reservaDAO->reservar($reserva);
                    }
                    $reservas = $this->reservaDAO->listarPorFilme($filme_id);
                    $msg = "Reservas atualizadas com sucesso!";
                } else {
                    $msg = "Uma ou mais das cadeiras escolhidas já estão ocupadas. Nenhuma alteração foi feita.";
                }
            } else {
                $msg = "Nome ou email incorretos, ou nenhuma reserva encontrada.";
            }
        }

        include __DIR__ . '/../view/alterar.php';
    }
}
