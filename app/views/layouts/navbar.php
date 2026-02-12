<?php
// app/views/layouts/navbar.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<nav style="background: #004a99; padding: 15px 40px; display: flex; justify-content: space-between; align-items: center; color: white;">
    <div style="font-weight: bold; font-size: 20px; letter-spacing: 1px;">
        GED - BANQUE DE TUNISIE
    </div>
    
    <div style="display: flex; gap: 20px; align-items: center;">
        <?php if (!isset($_SESSION['user_id'])): ?>
            <a href="../home/index.php" style="color: white; text-decoration: none;">Accueil</a>
            <a href="../auth/login.php" style="color: white; text-decoration: none;">Connexion</a>
            <a href="../auth/register.php" style="background: #ffcc00; color: #004a99; padding: 8px 15px; border-radius: 4px; text-decoration: none; font-weight: bold;">S'inscrire</a>
        <?php else: ?>
            
            <a href="../dashboard/select-module.php" style="color: white; text-decoration: none; font-weight: 500;">Modules</a>

            <?php if ($_SESSION['role'] === 'SUPER_ADMIN'): ?>
                <a href="../admin/users_manage.php" style="background: #ef4444; color: white; padding: 6px 12px; border-radius: 4px; text-decoration: none; font-size: 14px; font-weight: bold; display: flex; align-items: center; gap: 5px;">
                   <span style="background: rgba(255,255,255,0.2); padding: 2px 5px; border-radius: 3px;">🛡️</span> Admin
                </a>
            <?php endif; ?>
            
            <span style="color: #abdbe3; margin-left: 10px; font-size: 14px;">
                👤 <?= htmlspecialchars($_SESSION['email']); ?> 
                <small style="opacity: 0.8;">(<?= htmlspecialchars($_SESSION['role']); ?>)</small>
            </span>
            
            <a href="../../controllers/AuthController.php?action=logout" style="color: #ff4d4d; text-decoration: none; font-weight: bold; margin-left: 10px;">Déconnexion</a>
        <?php endif; ?>
    </div>
</nav>