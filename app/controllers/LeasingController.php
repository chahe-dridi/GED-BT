<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Leasing.php';

class LeasingController {
    private $conn;

    public function __construct() {
        $database = new config();
        $this->conn = $database->getConnexion();
    }

    public function getAll() {
        $query = "SELECT * FROM leasing ORDER BY id DESC";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($id) {
        $query = "DELETE FROM leasing WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }
}

// Logique d'ajout
if (isset($_POST['add_leasing'])) {
    $database = new config();
    $db = $database->getConnexion();
    $leasingModel = new Leasing($db);
    
    $nomFichier = $_FILES['fichier']['name']; 
    $destination = "../../public/uploads/" . $nomFichier;

    if (move_uploaded_file($_FILES['fichier']['tmp_name'], $destination)) {
        $data = [
            $_POST['id'],
            $_POST['client'], 
            $_POST['numero'], 
            $_POST['montant'],
            $_POST['date'], 
            $_POST['statut'], 
            $nomFichier
        ];
        
        if ($leasingModel->create($data)) {
            header("Location: ../views/leasing/index.php?msg=success");
            exit();
        }
    }
}

// Logique de suppression
if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    $controller = new LeasingController();
    $controller->delete($_GET['id']);
    header("Location: ../views/leasing/index.php?msg=deleted");
    exit();
}