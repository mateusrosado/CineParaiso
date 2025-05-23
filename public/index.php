<?php
require_once __DIR__ . '/../core/database.php';
require_once __DIR__ . '/../models/dao/FilmeDAO.php';
require_once __DIR__ . '/../models/dao/CadeiraDAO.php';
require_once __DIR__ . '/../models/dao/ReservaDAO.php';
require_once __DIR__ . '/../controllers/ReservaController.php';

$controller = $_GET['controller'] ?? 'Reserva';
$action = $_GET['action'] ?? 'index';

$controllerClass = $controller . 'Controller';

if (class_exists($controllerClass)) {
    $c = new $controllerClass();

    if (method_exists($c, $action)) {
        $c->$action();
    } else {
        echo "Ação '$action' não encontrada.";
    }
} else {
    echo "Controller '$controllerClass' não encontrado.";
}