<?php
session_start();
require_once '../../controllers/LeasingController.php';

$userPerm = $_SESSION['perm_leasing'] ?? 'NONE';

// DESIGN DE LA PAGE ACCÈS REFUSÉ (CSS INTERNE)
if ($userPerm === 'NONE' && $_SESSION['role'] !== 'SUPER_ADMIN') {
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Accès Refusé</title>
        <style>
            .forbidden-body { margin: 0; font-family: 'Segoe UI', sans-serif; background-color: #f4f7f6; display: flex; flex-direction: column; height: 100vh; }
            .forbidden-wrapper { flex: 1; display: flex; justify-content: center; align-items: center; padding: 20px; }
            .forbidden-card { background: white; max-width: 450px; width: 100%; padding: 40px; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); text-align: center; border-top: 6px solid #dc3545; }
            .forbidden-card h1 { color: #dc3545; font-size: 24px; margin-top: 15px; }
            .forbidden-card p { color: #555; line-height: 1.6; margin-bottom: 25px; }
            .btn-return { display: inline-block; background-color: #004a99; color: white !important; padding: 12px 25px; border-radius: 6px; text-decoration: none; font-weight: bold; }
        </style>
    </head>
    <body class="forbidden-body">
        <?php include '../layouts/navbar.php'; ?>
        <div class="forbidden-wrapper">
            <div class="forbidden-card">
                <div style="font-size: 50px;">🚫</div>
                <h1>Accès Refusé</h1>
                <p>Vous n'avez pas les autorisations nécessaires pour accéder au module <strong>Leasing</strong>. Veuillez contacter votre administrateur.</p>
                <a href="../dashboard/select-module.php" class="btn-return">Retour au menu principal</a>
            </div>
        </div>
    </body>
    </html>
    <?php
    exit();
}

$canEdit = ($_SESSION['role'] === 'SUPER_ADMIN' || $userPerm === 'FULL');
$canViewFile = ($_SESSION['role'] === 'SUPER_ADMIN' || $userPerm === 'FULL' || $userPerm === 'VIEW');

$leasingCtrl = new LeasingController();
$leasings = $leasingCtrl->getAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion Leasing - BT</title>
    <link rel="stylesheet" href="../../public/css/style.css">
</head>
<body>
    <?php include '../layouts/navbar.php'; ?>
    
    <div style="padding:30px;">
        <h2>📂 Gestion des Dossiers Leasing</h2>

        <?php if ($canEdit): ?>
            <a href="form.php" style="background:#004a99; color:white; padding:10px; text-decoration:none; border-radius:5px;">+ Ajouter un dossier</a>
            <br><br>
        <?php endif; ?>

        <table border="1" width="100%" style="border-collapse:collapse; background:white;">
            <thead style="background:#f8fafc;">
                <tr>
                    <th>ID</th>
                    <th>Client</th>
                    <th>Montant</th>
                    <th>Fichier</th>
                    <?php if ($canEdit): ?> <th>Actions</th> <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($leasings as $l): ?>
                <tr>
                    <td><?= htmlspecialchars($l['id']) ?></td>
                    <td><?= htmlspecialchars($l['client']) ?></td>
                    <td><?= number_format($l['montant'], 3, ',', ' ') ?> DT</td>
                    
                    <td>
                        <?php if (!empty($l['fichier']) && $canViewFile): ?>
                            <a href="../../../public/uploads/<?= htmlspecialchars($l['fichier']) ?>" target="_blank" style="color:#004a99; font-weight:bold; font-size: 0.9em;">
                                📄 <?= htmlspecialchars($l['fichier']) ?>
                            </a>
                        <?php else: ?>
                            <span style="color:gray;">Pas de fichier</span>
                        <?php endif; ?>
                    </td>

                    <?php if ($canEdit): ?>
                    <td>
                        <a href="form.php?id=<?= $l['id'] ?>">Modifier</a> | 
                        <a href="../../controllers/LeasingController.php?action=delete&id=<?= $l['id'] ?>" style="color:red;" onclick="return confirm('Supprimer ?')">Supprimer</a>
                    </td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>