<?php
// app/views/auth/register.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>BT - Inscription</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f4f7f6; margin: 0; padding: 0; min-height: 100vh; display: flex; flex-direction: column; }
        .container { flex: 1; display: flex; justify-content: center; align-items: center; padding: 20px; }
        form { background: white; padding: 35px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 100%; max-width: 450px; border-top: 5px solid #004a99; }
        h2 { color: #004a99; text-align: center; margin-bottom: 25px; }
        label { font-weight: bold; color: #334155; display: block; margin-bottom: 5px; }
        input, select { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        button { width: 100%; padding: 14px; background: #004a99; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; }
    </style>
</head>
<body>
    <?php include '../layouts/navbar.php'; ?>
    
    <div class="container">
        <form action="../../controllers/UserController.php" method="POST">
            <h2>Inscription Collaborateur</h2>
            
            <label>Id</label>
            <input type="text" name="id" placeholder="Ex: admin" required>
            
            <label>Email</label>
            <input type="email" name="email" required>
            
            <label>Mot de passe</label>
            <input type="password" name="password" required>
            
            <label>Confirmer</label>
            <input type="password" name="confirm_password" required>
            
            <label>Département</label>
            <select name="departement">
                <option value="Informatique">Informatique</option>
            </select>

            <button type="submit" name="register">Créer mon compte</button>
        </form>
    </div>
    
    <?php include '../layouts/footer.php'; ?>
</body>
</html>