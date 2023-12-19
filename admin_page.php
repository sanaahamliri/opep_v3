<?php
require 'Database.php';
require 'PlanteManager.php';
require 'CategorieManager.php';

$db = new Database();
$planteManager = new PlanteManager($db);
$categorieManager = new CategorieManager($db);

if (isset($_POST['ajouterCategorie'])) {
    $nomCategorie = $_POST['nomCategorie'];
    $categorieManager->ajouterCategorie($nomCategorie);
}

if (isset($_POST['ajouterPlante'])) {
    $idCategorie = $_POST['categorie'];
    $nomPlante = $_POST['nom'];
    $prix = $_POST['prix'];
    $image = $_FILES['my_image']['name'];
    $tempImage = $_FILES['my_image']['tmp_name'];
    
    move_uploaded_file($tempImage, "./uploads/$image");

    $planteManager->ajouterPlante($idCategorie, $nomPlante, $prix, $image);
}

$listePlantes = $planteManager->getListePlantes();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'Administration</title>
    <link rel="stylesheet" href="admin.css?v=<?php echo time(); ?>">
</head>

<body>
    <div class="container">
        <section class="section form-container">
            <h2>Ajouter une catégorie</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <label for="nom">Nom de la catégorie :</label>
                <input type="text" id="nom" name="nomCategorie" required>
                <div class="button-container">
                    <button type="submit" name="ajouterCategorie">Ajouter la catégorie</button>
                </div>
            </form>
        </section>

        <section class="section form-container">
            <h2>Ajouter une Plante</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <label for="categorie">Catégorie :</label>
                <select name="categorie">
                    <?php
                    foreach ($categorieManager->getListeCategories() as $categorie) {
                        echo "<option value=\"{$categorie['idCategorie']}\">{$categorie['nomCategorie']}</option>";
                    }
                    ?>
                </select>

                <label for="nom">Nom de la Plante :</label>
                <input type="text" id="nom" name="nom" required>

                <label for="prix">Prix :</label>
                <input type="text" id="prix" name="prix" required>

                <label for="image">Image de la Plante :</label>
                <input type="file" id="image" name="my_image" required>
                <button type="submit" name="ajouterPlante">Ajouter la Plante</button>
            </form>
        </section>

        <section class="section list-container">
            <h2>Liste des Plantes</h2>
            <table>
                <thead>
                    <tr>
                        <th>Catégorie</th>
                        <th>Nom</th>
                        <th>Prix</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($listePlantes as $plante) {
                        echo "<tr>";
                        echo "<td>{$plante['nomCategorie']}</td>";
                        echo "<td>{$plante['nomPlante']}</td>";
                        echo "<td>{$plante['prix']}</td>";
                        echo "<td><img src='./uploads/{$plante['image']}' alt='{$plante['nomPlante']}' class='thumbnail'></td>";
                        echo "<td><a href='modifier_plante.php?id={$plante['idPlante']}'>Modifier</a>   <a href='supprimer_plante.php?id={$plante['idPlante']}' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer cette plante ?\")'>Supprimer</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </div>
</body>

</html>