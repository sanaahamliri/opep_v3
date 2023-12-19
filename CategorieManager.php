<?php
class CategorieManager {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function ajouterCategorie($nomCategorie) {
        try {
            $conn = $this->db->getConnection();

            $stmt = $conn->prepare("INSERT INTO categorie (nomCategorie) VALUES (?)");
            $stmt->execute([$nomCategorie]);
            
            return true;
        } catch (PDOException $e) {
            // Gère l'erreur
            echo "Erreur d'ajout de catégorie : " . $e->getMessage();
            return false;
        }
    }

    public function getListeCategories() {
        try {
            $conn = $this->db->getConnection();

            $sql = "SELECT * FROM categorie";
            $stmt = $conn->query($sql);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Gère l'erreur
            echo "Erreur lors de la récupération des catégories : " . $e->getMessage();
            return [];
        }
    }

    public function filtrerPlantesParCategorie($categoryFilter) {
        try {
            $conn = $this->db->getConnection();

            $sql = "SELECT plante.*, categorie.nomCategorie FROM plante
                    INNER JOIN categorie ON plante.idCategorie = categorie.idCategorie
                    WHERE categorie.idCategorie = :categoryFilter";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':categoryFilter', $categoryFilter, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Gère l'erreur
            echo "Erreur lors du filtrage des plantes par catégorie : " . $e->getMessage();
            return [];
        }
    }
}
?>
