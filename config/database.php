<?php

class config
{
    private $pdo = null;

    public function getConnexion()
    {
        if (!isset($this->pdo)) {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "ged_bd";

            try {
                $this->pdo = new PDO(
                    "mysql:host=$servername;dbname=$dbname",
                    $username,
                    $password,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
            } catch (Exception $e) {
                die('Erreur: ' . $e->getMessage());
            }
        }

        return $this->pdo;
    }
}

?>