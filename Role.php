<?php
class Role {
    private $db;
    private $lastError;

    public function __construct($db) {
        $this->db = $db;
    }

    public function saveRole($registrationData, $role) {
        try {
            $conn = $this->db->getConnection();

            // Utilise des requêtes préparées pour éviter les injections SQL
            $stmt = $conn->prepare("INSERT INTO utilisateur (nom, email, motDePasse, idRole) VALUES (:nom, :email, :motDePasse, :role)");
            $stmt->bindParam(':nom', $registrationData['nom']);
            $stmt->bindParam(':email', $registrationData['email']);
            $stmt->bindParam(':motDePasse', $registrationData['motDePasse']);
            $stmt->bindParam(':role', $role);

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
