<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Contrat.php';

class ContratController {
    private $conn;

    public function __construct() {
        $database = new config();
        $this->conn = $database->getConnexion();
    }

    public function getAll() {
        $query = "SELECT * FROM contrats ORDER BY id DESC";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($id) {
        $query = "DELETE FROM contrats WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }
}

// Logique d'ajout (Appelée par le formulaire)
if (isset($_POST['add_contrat'])) {
    $database = new config();
    $db = $database->getConnexion();
    $contratModel = new Contrat($db);
    
    // Gestion du fichier
    $nomFichier = $_FILES['fichier']['name']; 
    $destination = "../../public/uploads/" . $nomFichier;

    if (move_uploaded_file($_FILES['fichier']['tmp_name'], $destination)) {
        $data = [
            $_POST['id'],
            $_POST['fournisseur'], 
            $_POST['reference'], 
            $_POST['departement'],
            $_POST['date_debut'], 
            $_POST['date_fin'], 
            $_POST['designation'], 
            $nomFichier,
            $_POST['statut']
        ];
        
        if ($contratModel->create($data)) {
            header("Location: ../views/contrats/index.php?msg=success");
            exit();
        }
    }
}

// Logique de suppression
if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    // Vérification de sécurité supplémentaire ici si nécessaire
    $controller = new ContratController();
    $controller->delete($_GET['id']);
    header("Location: ../views/contrats/index.php?msg=deleted");
    exit();
}