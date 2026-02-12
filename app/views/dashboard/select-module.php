<?php
// app/views/dashboard/select-module.php
session_start();

// Protection de la page
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

// Simulation de récupération des permissions
$hasContrat = true; 
$hasLeasing = true; 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Sélection Module - BT</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f8fafc; text-align: center; margin: 0; padding: 0; }
        .content { padding: 50px; }
        h1 { color: #004a99; margin-bottom: 10px; }
        p { color: #64748b; margin-bottom: 40px; }
        button { 
            background: white; 
            border: 2px solid #004a99; 
            color: #004a99; 
            padding: 25px 40px; 
            margin: 15px; 
            border-radius: 12px; 
            font-size: 18px; 
            font-weight: bold; 
            cursor: pointer; 
            transition: all 0.3s ease; 
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            min-width: 250px;
        }
        button:hover { 
            background: #004a99; 
            color: white; 
            transform: translateY(-5px); 
            box-shadow: 0 10px 15px rgba(0,0,0,0.1); 
        }
    </style>
</head>
<body>
    <?php include '../layouts/navbar.php'; ?>

    <div class="content">
        <h1>Bienvenue dans la GED</h1>
        <p>Choisissez un module :</p>

        <?php if ($hasContrat): ?>
            <a href="../contrats/index.php"><button>📂 Module Contrats</button></a>
        <?php endif; ?>

        <?php if ($hasLeasing): ?>
            <a href="../leasing/index.php"><button>🚗 Module Leasing</button></a>
        <?php endif; ?>
    </div>

    <?php include '../layouts/footer.php'; ?>
</body>
</html>