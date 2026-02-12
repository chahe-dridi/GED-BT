<?php
// app/views/auth/login.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>BT - Connexion</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f4f7f6; margin: 0; padding: 0; min-height: 100vh; display: flex; flex-direction: column; }
        .container { flex: 1; display: flex; justify-content: center; align-items: center; padding: 20px; }
        form { background: white; padding: 40px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 100%; max-width: 400px; border-top: 5px solid #004a99; }
        h2 { color: #004a99; text-align: center; margin-bottom: 30px; }
        label { font-weight: bold; color: #334155; }
        input { width: 100%; padding: 12px; margin: 10px 0 25px 0; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        button { width: 100%; padding: 14px; background: #004a99; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; font-size: 16px; }
    </style>
</head>
<body>
    <?php include '../layouts/navbar.php'; ?>
    <div class="container">
        <form action="../../controllers/AuthController.php" method="POST">
            <h2>Connexion</h2>
            <label>Email Professionnel</label>
            <input type="email" name="email" placeholder="votre@email.com" required>
            <label>Mot de passe</label>
            <input type="password" name="password" placeholder="••••••••" required>
            <button type="submit" name="login">Se connecter</button>
        </form>
    </div>
    <?php include '../layouts/footer.php'; ?>
</body>
</html>