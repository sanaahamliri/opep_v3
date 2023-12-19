<?php

class PlanteManager {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function ajouterPlante($idCategorie, $nomPlante, $prix, $image) {
        try {
            $conn = $this->db->getConnection();

            $stmt = $conn->prepare("INSERT INTO plante (idCategorie, nomPlante, prix, image) VALUES (?, ?, ?, ?)");
            $stmt->execute([$idCategorie, $nomPlante, $prix, $image]);
            
            return true;
        } catch (PDOException $e) {
            // Gère l'erreur
            echo "Erreur d'ajout de plante : " . $e->getMessage();
            return false;
        }
    }

    public function getListePlantes() {
        try {
            $conn = $this->db->getConnection();

            $sql = "SELECT plante.*, categorie.nomCategorie FROM plante
                    INNER JOIN categorie ON plante.idCategorie = categorie.idCategorie";
            $stmt = $conn->query($sql);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Gère l'erreur
            echo "Erreur lors de la récupération des plantes : " . $e->getMessage();
            return [];
        }
    }

    public function getPlanteById($idPlante) {
        try {
            $conn = $this->db->getConnection();

            $stmt = $conn->prepare("SELECT * FROM plante WHERE idPlante = ?");
            $stmt->execute([$idPlante]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Gère l'erreur
            echo "Erreur lors de la récupération de la plante : " . $e->getMessage();
            return false;
        }
    }

    public function modifierPlante($idPlante, $nouveauNom, $nouveauPrix) {
        try {
            $conn = $this->db->getConnection();

            $stmt = $conn->prepare("UPDATE plante SET nomPlante = ?, prix = ? WHERE idPlante = ?");
            $stmt->execute([$nouveauNom, $nouveauPrix, $idPlante]);

            return true;
        } catch (PDOException $e) {
            // Gère l'erreur
            echo "Erreur lors de la modification de la plante : " . $e->getMessage();
            return false;
        }
    }

    public function supprimerPlante($idPlante) {
        try {
            $conn = $this->db->getConnection();

            $stmt = $conn->prepare("DELETE FROM plante WHERE idPlante = ?");
            $stmt->execute([$idPlante]);

            return true;
        } catch (PDOException $e) {
            // Gère l'erreur
            echo "Erreur lors de la suppression de la plante : " . $e->getMessage();
            return false;
        }
    }

    public function rechercherPlantes($searchTerm, $categoryFilter = null) {
        try {
            $conn = $this->db->getConnection();

            $sql = "SELECT plante.*, categorie.nomCategorie FROM plante
                    INNER JOIN categorie ON plante.idCategorie = categorie.idCategorie
                    WHERE plante.nomPlante LIKE :searchTerm";

            if ($categoryFilter) {
                $sql .= " AND plante.idCategorie = :categoryFilter";
            }

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);

            if ($categoryFilter) {
                $stmt->bindParam(':categoryFilter', $categoryFilter, PDO::PARAM_INT);
            }

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Gère l'erreur
            echo "Erreur lors de la recherche des plantes : " . $e->getMessage();
            return [];
        }
    }
}

?>