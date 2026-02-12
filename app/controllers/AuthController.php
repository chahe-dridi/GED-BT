<?php
// app/controllers/AuthController.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../config/database.php';

$database = new config();
$db = $database->getConnexion();

// --- LOGIQUE DE DÉCONNEXION ---
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_unset();
    session_destroy();
    header("Location: ../views/auth/login.php");
    exit();
}

// --- LOGIQUE DE CONNEXION ---
if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    try {
        // On sélectionne uniquement les colonnes existantes dans la table 'users'
        $query = "SELECT id, email, password, role, departement FROM users WHERE email = :email";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $password === $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['departement'] = $user['departement'];

            // --- RÉCUPÉRATION DES PERMISSIONS DEPUIS LA TABLE DÉDIÉE ---
            $stmtPerm = $db->prepare("SELECT module, access FROM permissions WHERE user_id = :uid");
            $stmtPerm->execute([':uid' => $user['id']]);
            $allPerms = $stmtPerm->fetchAll(PDO::FETCH_ASSOC);

            // Initialisation par défaut
            $_SESSION['perm_contrat'] = 'NONE';
            $_SESSION['perm_leasing'] = 'NONE';

            // Respect strict des majuscules de la base de données
            foreach ($allPerms as $p) {
                if ($p['module'] === 'CONTRAT') {
                    $_SESSION['perm_contrat'] = $p['access'];
                } elseif ($p['module'] === 'LEASING') {
                    $_SESSION['perm_leasing'] = $p['access'];
                }
            }

            // Forcer FULL pour le Super Admin
            if ($user['role'] === 'SUPER_ADMIN') {
                $_SESSION['perm_contrat'] = 'FULL';
                $_SESSION['perm_leasing'] = 'FULL';
            }

            // Redirection selon le rôle
            if ($_SESSION['role'] === 'SUPER_ADMIN') {
                header("Location: ../views/admin/users_manage.php");
            } else {
                header("Location: ../views/dashboard/select-module.php");
            }
            exit();
        } else {
            header("Location: ../views/auth/login.php?error=1");
            exit();
        }
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
}