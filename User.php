<?php

class User {
    private $db;
    private $lastError;

    public function __construct($db) {
        $this->db = $db;
    }

    public function register($nom, $email, $motDePasse) {
        try {
            $conn = $this->db->getConnection();

            // Utilise des requêtes préparées pour éviter les injections SQL
            $stmt = $conn->prepare("INSERT INTO utilisateur (nom, email, motDePasse) VALUES (:nom, :email, :motDePasse)");
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':motDePasse', $motDePasse);

            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            // Enregistre l'erreur
            $this->lastError = $e->getMessage();
            return false;
        }
    }

    public function getLastError() {
        return $this->lastError;
    }
}

?>
