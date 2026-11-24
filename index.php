<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once __DIR__ . "/controlador/UsersController.php";
require_once __DIR__ . "/modelo/UsersModel.php";

if (!isset($_SESSION['username'])) {
    header("Location: /vistas/login.php");
    exit;
}

$controller = new UsersController();
$action = $_GET['action'] ?? 'index';
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
if ($action === 'edit') {
    $controller->edit($id);
} else {
    $controller->index();
}
