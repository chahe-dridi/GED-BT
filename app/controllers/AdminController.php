<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/User.php';

class AdminController {
    private $userModel;

    public function __construct() {
        $database = new config();
        $db = $database->getConnexion();
        $this->userModel = new User($db);
    }

    public function listUsers() {
        return $this->userModel->getAllUsersWithPermissions();
    }
}

// Traitement de la mise à jour
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_permissions'])) {
    $database = new config();
    $db = $database->getConnexion();
    $userModel = new User($db);

    $userId = $_POST['user_id'];
    $role = $_POST['role'];
    $permContrat = $_POST['perm_contrat'];
    $permLeasing = $_POST['perm_leasing'];

    if ($userModel->updateRoleAndPermissions($userId, $role, $permContrat, $permLeasing)) {
        header("Location: ../views/admin/users_manage.php?status=success");
        exit();
    } else {
        // C'est ici que l'erreur s'affichait sur votre capture
        die("Erreur critique lors de la mise à jour des permissions. Vérifiez que l'ID utilisateur existe.");
    }
}