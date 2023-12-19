<?php
require 'Database.php';
require 'PlanteManager.php';

$db = new Database();
$planteManager = new PlanteManager($db);

if (isset($_POST['ajouterPlante'])) {
    $categorie = (int) $_POST['categorie'];
    $nom = $_POST['nom'];
    $prix = $_POST['prix'];

    $img_name = $_FILES['my_image']['name'];
    $img_size = $_FILES['my_image']['size'];
    $tmp_name = $_FILES['my_image']['tmp_name'];
    $error = $_FILES['my_image']['error'];

    if ($error === 0) {
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);

        $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
        $img_upload_path = 'uploads/' . $new_img_name;
        move_uploaded_file($tmp_name, $img_upload_path);

        if ($planteManager->ajouterPlante($categorie, $nom, $prix, $new_img_name)) {
            header("Location: admin_page.php?success=PlanteAdded");
        } else {
            header("Location: admin_page.php?error=PlantAddFailed");
        }
    } else {
        $em = "Unknown error occurred!";
        header("Location: admin_page.php?error=$em");
    }
} else {
    header("Location: admin_page.php");
}
?>