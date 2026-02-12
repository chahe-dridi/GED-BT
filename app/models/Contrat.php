<?php
class Contrat {
    private $db; // On déclare la variable de connexion

    public function __construct($db) {
        $this->db = $db; // On initialise la connexion
    }

    public function create($data) {
        // Ajout de 'id' au début car vous le saisissez manuellement
        $query = "INSERT INTO contrats (id, fournisseur, reference, departement, date_debut, date_fin, designation, fichier, statut) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        // Utilisation de $this->db qui n'est plus "null" maintenant
        $stmt = $this->db->prepare($query); 
        return $stmt->execute($data);
    }

    public function getAll() {
        $query = "SELECT * FROM contrats ORDER BY date_debut DESC";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}