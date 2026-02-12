<?php
// app/views/home/index.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>BT - Accueil GED</title>
    <style>
        /* L'image de fond est UNIQUEMENT ici */
        body, html { 
            margin: 0; 
            padding: 0; 
            height: 100%; 
            font-family: 'Segoe UI', sans-serif; 
        }
        
        .hero-section { 
            height: 100vh;
            background: linear-gradient(rgba(0, 74, 153, 0.6), rgba(0, 0, 0, 0.7)), 
                        url('repertoires.jpg') no-repeat center center fixed; 
            background-size: cover;
            display: flex;
            flex-direction: column;
        }

        .hero-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
        }

        h1 { font-size: 3.5rem; margin-bottom: 20px; text-shadow: 2px 2px 8px rgba(0,0,0,0.5); }
        p { font-size: 1.5rem; margin-bottom: 40px; max-width: 800px; }

        .btn-group { display: flex; gap: 20px; }
        .btn { 
            padding: 15px 40px; 
            border-radius: 5px; 
            text-decoration: none; 
            font-weight: bold; 
            font-size: 18px; 
            transition: 0.3s; 
        }
        .btn-login { background: #ffcc00; color: #004a99; }
        .btn-register { background: transparent; color: white; border: 2px solid white; }
        .btn:hover { transform: scale(1.05); opacity: 0.9; }
    </style>
</head>
<body>
    <div class="hero-section">
        <?php include '../layouts/navbar.php'; ?>

        <div class="hero-content">
            <h1>GED - BANQUE DE TUNISIE</h1>
            <p>Système de Gestion Électronique des Documents</p>
            
            <?php if (!isset($_SESSION['user_id'])): ?>
                <div class="btn-group">
                    <a href="../auth/login.php" class="btn btn-login">Connexion</a>
                    <a href="../auth/register.php" class="btn btn-register">S'inscrire</a>
                </div>
            <?php else: ?>
                <a href="../dashboard/select-module.php" class="btn btn-login">Accéder à mon espace</a>
            <?php endif; ?>
        </div>
    </div>
    <?php include '../layouts/footer.php'; ?>
</body>
</html>