<?php
class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllUsersWithPermissions() {
        $query = "SELECT u.*, 
                  (SELECT access FROM permissions WHERE user_id = u.id AND module = 'CONTRAT') as perm_contrat,
                  (SELECT access FROM permissions WHERE user_id = u.id AND module = 'LEASING') as perm_leasing
                  FROM users u 
                  WHERE u.role != 'SUPER_ADMIN'";
        return $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateRoleAndPermissions($userId, $role, $permContrat, $permLeasing) {
        try {
            $this->db->beginTransaction();

            // 1. Mise à jour du rôle dans la table users
            $stmtRole = $this->db->prepare("UPDATE users SET role = :role WHERE id = :id");
            $stmtRole->execute(['role' => $role, 'id' => $userId]);

            // 2. Supprimer les anciennes permissions pour cet utilisateur
            $stmtDel = $this->db->prepare("DELETE FROM permissions WHERE user_id = :uid");
            $stmtDel->execute(['uid' => $userId]);

            // 3. Ré-insérer les permissions choisies
            $stmtIns = $this->db->prepare("INSERT INTO permissions (user_id, module, access) VALUES (:uid, :mod, :acc)");
            
            // Insertion CONTRAT
            $stmtIns->execute(['uid' => $userId, 'mod' => 'CONTRAT', 'acc' => $permContrat]);
            
            // Insertion LEASING
            $stmtIns->execute(['uid' => $userId, 'mod' => 'LEASING', 'acc' => $permLeasing]);

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            if ($this->db->inTransaction()) { $this->db->rollBack(); }
            // Log de l'erreur pour débogage si nécessaire
            error_log($e->getMessage());
            return false;
        }
    }
}