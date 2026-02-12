<?php
// app/controllers/UserController.php
require_once __DIR__ . '/../../config/database.php';

if (isset($_POST['register'])) {
    $id = $_POST['id'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];
    $dept = $_POST['departement'];
    
    $role = "USER"; 

    if ($password !== $confirm) {
        die("❌ Les mots de passe ne correspondent pas");
    }

    $database = new config();
    $db = $database->getConnexion();

    try {
        $db->beginTransaction();

        // 1. Insertion de l'utilisateur
        $sql = "INSERT INTO users (id, email, password, role, departement, created_at)
                VALUES (?, ?, ?, ?, ?, NOW())";
        $stmt = $db->prepare($sql);
        $stmt->execute([$id, $email, $password, $role, $dept]);

        // 2. Création automatique des permissions par défaut (NONE)
        // On insère une ligne pour CONTRAT
        $stmtPerm1 = $db->prepare("INSERT INTO permissions (user_id, module, access) VALUES (?, 'CONTRAT', 'NONE')");
        $stmtPerm1->execute([$id]);

        // On insère une ligne pour LEASING
        $stmtPerm2 = $db->prepare("INSERT INTO permissions (user_id, module, access) VALUES (?, 'LEASING', 'NONE')");
        $stmtPerm2->execute([$id]);

        $db->commit();
        header("Location: ../views/auth/login.php?success=1");
        exit(); 

    } catch (PDOException $e) {
        $db->rollBack();
        die("Erreur lors de l'enregistrement : " . $e->getMessage());
    }
}
?>