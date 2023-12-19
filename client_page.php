<?php
require 'Database.php';
require 'PlanteManager.php';
require 'CategorieManager.php';

$db = new Database();
$categorieManager = new CategorieManager($db);
$planteManager = new PlanteManager($db);

$sqlCategories = "SELECT * FROM categorie";
$resultCategories = $categorieManager->getListeCategories();

if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    $categoryFilter = isset($_GET['category']) ? $_GET['category'] : null;

    if ($categoryFilter) {
        $resultPlantes = $categorieManager->filtrerPlantesParCategorie($categoryFilter);
    } else {
        $resultPlantes = $planteManager->rechercherPlantes($searchTerm);
    }
} else {
    $resultPlantes = $planteManager->getListePlantes();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Page</title>
    <link rel="stylesheet" href="client.css?v=<?php echo time(); ?>">
</head>

<body>

    <header>
        <nav>
            <a href="index.php"><img src="./images/Capture_d_écran_2023-12-02_231056-removebg-preview.png" alt="logo"></a>
            <a href="index.php">Accueil</a>
            <a href="index.php">A propos de nous</a>
            <a href="panier.php">Panier</a>
        </nav>
    </header>

    <section class="search">
        <form action="" method="GET">
            <label for="searchTerm">Nom de la plante:</label>
            <input type="text" id="searchTerm" name="search" placeholder="Nom de la plante">

            <label for="categoryFilter">Catégorie:</label>
            <select id="categoryFilter" name="category">
                <option value="" selected>Toutes les catégories</option>
                <?php
                foreach ($resultCategories as $rowCategory) {
                    echo "<option value='" . $rowCategory['idCategorie'] . "'>" . $rowCategory['nomCategorie'] . "</option>";
                }
                ?>
            </select>

            <button type="submit">Rechercher</button>
        </form>
    </section>

    <section class="plantes">
        <?php
        foreach ($resultPlantes as $rowPlante) {
            echo "<div class='plant'>";
            echo "<img src='./uploads/" . $rowPlante['image'] . "' alt='" . $rowPlante['nomPlante'] . "'>";
            echo "<p> " . $rowPlante['nomPlante'] . "</p>";
            echo "<p>Prix: $" . $rowPlante['prix'] . "</p>";

            echo "<form action='' method='post'>";
            echo "<input type='hidden' name='plantId' value='" . $rowPlante['idPlante'] . "'>";
            echo "<button type='submit' name='addToCart'>Ajouter au panier</button>";
            echo "</form>";

            echo "</div>";
        }
        ?>
    </section>

</body>

</html>
