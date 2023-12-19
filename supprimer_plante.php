<?php
require 'Database.php';
require 'PlanteManager.php';

$db = new Database();
$planteManager = new PlanteManager($db);

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $planteId = $_GET['id'];

    if ($planteManager->supprimerPlante($planteId)) {
        header("Location: admin_page.php");
        exit();
    } else {
        echo "Erreur lors de la suppression de la plante.";
    }
} else {
    echo "Paramètre 'id' manquant";
    exit();
}
?>