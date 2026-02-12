<?php
class Leasing {
    private $db;
    public function __construct($db) { 
        $this->db = $db; 
    }

    public function getAll() {
        // Trajet par ID descendante pour voir le nouveau dossier en haut
        $query = "SELECT * FROM leasing ORDER BY id DESC";
        return $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        // On insère exactement 7 valeurs : id, client, numero, montant, date, statut, fichier
        $query = "INSERT INTO leasing (id, client, numero, montant, date, statut, fichier) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute($data);
    }
}