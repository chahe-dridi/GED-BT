<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'SUPER_ADMIN') {
    die("Accès interdit.");
}
require_once '../../controllers/AdminController.php';
$adminCtrl = new AdminController();
$users = $adminCtrl->listUsers();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion Permissions - BT</title>
    <link rel="stylesheet" href="../../public/css/style.css"> <style>
        .badge-success { background: #dcfce7; color: #166534; padding: 10px; margin-bottom: 15px; border-radius: 5px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; background: white; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #004a99; color: white; }
        .btn-save { background-color: #10b981; color: white; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer; }
    </style>
</head>
<body>
    <?php include '../layouts/navbar.php'; ?>
    
    <div style="padding: 30px;">
        <h2>🛡️ Gestion des Utilisateurs et Permissions</h2>

        <?php if (isset($_GET['status']) && $_GET['status'] === 'success'): ?>
            <div class="badge-success">✅ Les permissions ont été mises à jour avec succès !</div>
        <?php endif; ?>

        <table>
            <thead>
                <tr>
                    <th>Utilisateur</th>
                    <th>Rôle</th>
                    <th>Module Contrat</th>
                    <th>Module Leasing</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $u): ?>
                <tr>
                    <form action="../../controllers/AdminController.php" method="POST">
                        <input type="hidden" name="user_id" value="<?= $u['id'] ?>">
                        <td>
                            <strong><?= htmlspecialchars($u['email']) ?></strong><br>
                            <small>Dépt: <?= htmlspecialchars($u['departement']) ?></small>
                        </td>
                        <td>
                            <select name="role">
                                <option value="USER" <?= $u['role'] == 'USER' ? 'selected' : '' ?>>Utilisateur</option>
                                <option value="ADMIN" <?= $u['role'] == 'ADMIN' ? 'selected' : '' ?>>Administrateur</option>
                            </select>
                        </td>
                        <td>
                            <select name="perm_contrat">
                                <option value="NONE" <?= $u['perm_contrat'] == 'NONE' ? 'selected' : '' ?>>Aucun (NONE)</option>
                                <option value="VIEW" <?= $u['perm_contrat'] == 'VIEW' ? 'selected' : '' ?>>Lecture (VIEW)</option>
                                <option value="FULL" <?= $u['perm_contrat'] == 'FULL' ? 'selected' : '' ?>>Complet (FULL)</option>
                            </select>
                        </td>
                        <td>
                            <select name="perm_leasing">
                                <option value="NONE" <?= $u['perm_leasing'] == 'NONE' ? 'selected' : '' ?>>Aucun (NONE)</option>
                                <option value="VIEW" <?= $u['perm_leasing'] == 'VIEW' ? 'selected' : '' ?>>Lecture (VIEW)</option>
                                <option value="FULL" <?= $u['perm_leasing'] == 'FULL' ? 'selected' : '' ?>>Complet (FULL)</option>
                            </select>
                        </td>
                        <td>
                            <button type="submit" name="update_permissions" class="btn-save">Enregistrer</button>
                        </td>
                    </form>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>