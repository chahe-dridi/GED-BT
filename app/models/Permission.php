        <?php
        class Permission {
            private $db;
            public function __construct($db) { $this->db = $db; }

            public function getPermissionsByUser($user_id) {
                $sql = "SELECT module, access FROM permissions WHERE user_id = ?";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([$user_id]);
                return $stmt->fetchAll(PDO::FETCH_KEY_PAIR); // Retourne ['CONTRAT' => 'FULL', 'LEASING' => 'VIEW']
            }
        }
        ?>