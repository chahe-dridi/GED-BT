<?php
session_start();
require_once '../config/database.php';
require_once '../app/controllers/AuthController.php';

$page = $_GET['page'] ?? 'home';

switch ($page) {

    case 'login':
        $auth = new AuthController();
        $auth->login();
        break;

    case 'logout':
        $auth = new AuthController();
        $auth->logout();
        break;

    case 'register':
        require '../app/views/auth/register.php';
        break;

    case 'dashboard':
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?page=login');
            exit;
        }
        require '../app/views/dashboard/select-module.php';
        break;

    case 'home':
    default:
        require '../app/views/home/index.php';
        break;
}
