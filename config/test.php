<?php
require_once 'database.php';

$db = new Config();
$conn = $db->getConnexion();

echo "Connexion réussie à la base ged_bd";
?>