<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: ../auth/login.php"); exit(); }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouveau Contrat</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f4f7f6; }
        .form-container { max-width: 600px; margin: 40px auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        input, select, textarea { width: 100%; padding: 12px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        label { font-weight: bold; color: #333; display: block; margin-bottom: 5px; }
        .btn-save { background: #10b981; color: white; border: none; padding: 15px; width: 100%; border-radius: 5px; cursor: pointer; font-size: 16px; }
    </style>
</head>
<body>
    <?php include '../layouts/navbar.php'; ?>
    <div class="form-container">
        <h2 style="color: #004a99; text-align: center;">Ajouter un Contrat</h2>
        <form action="../../controllers/ContratController.php" method="POST" enctype="multipart/form-data">
            <input type="number" name="id" placeholder="Saisir l'ID du contrat" required>
            <input type="text" name="fournisseur" placeholder="Nom du Fournisseur" required>
            <input type="text" name="reference" placeholder="Référence Contrat" required>
            <input type="text" name="departement" placeholder="Département" required>
            
            <label>Date Début :</label>
            <input type="date" name="date_debut" required>
            
            <label>Date Fin :</label>
            <input type="date" name="date_fin" required>
            
            <textarea name="designation" placeholder="Désignation / Détails" rows="3"></textarea>

            <label>Statut du Contrat :</label>
            <select name="statut" required>
                <option value="En cours">En cours</option>
                <option value="Validé">Validé</option>
                <option value="Terminé">Terminé</option>
                <option value="Annulé">Annulé</option>
            </select>

            <label>Document PDF :</label>
            <input type="file" name="fichier" required>

            <button type="submit" name="add_contrat" class="btn-save">Enregistrer le Contrat</button>
        </form>
    </div>
</body>
</html>