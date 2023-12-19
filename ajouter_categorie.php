<?php
require 'Database.php';
require 'CategorieManager.php';

$db = new Database();
$categorieManager = new CategorieManager($db);

if (isset($_POST['ajouterCategorie'])) {
    $nomCategorie = $_POST['nomCategorie'];

    if ($categorieManager->ajouterCategorie($nomCategorie)) {
        header("Location: admin_page.php?success=PlanteAdded");
    } else {
        header("Location: admin_page.php?error=CategoryAddFailed");
    }
} else {
    header("Location: admin_page.php");
}
?>