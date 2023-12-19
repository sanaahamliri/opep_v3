<?php
require 'Database.php';
require 'PlanteManager.php';

$db = new Database();
$planteManager = new PlanteManager($db);

if (isset($_GET['id'])) {
    $idPlante = $_GET['id'];

    $plante = $planteManager->getPlanteById($idPlante);

    if (!$plante) {
        echo "Erreur : Plante non trouvée.";
        exit;
    }

    $nomPlanteActuel = $plante['nomPlante'];
    $prixActuel = $plante['prix'];
} else {
    echo "Erreur : ID de la plante non spécifié.";
    exit;
}

if (isset($_POST['modifierPlante'])) {
    $nouveauNom = $_POST['nouveauNom'];
    $nouveauPrix = $_POST['nouveauPrix'];

    if ($planteManager->modifierPlante($idPlante, $nouveauNom, $nouveauPrix)) {
        echo "Plante modifiée avec succès.";
        header("Location: admin_page.php");
        exit;
    } else {
        echo "Erreur lors de la modification de la plante.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une Plante</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form action="modifier_plante.php?id=<?php echo $idPlante; ?>" method="post">
        <label for="nouveauNom">Nouveau Nom de la Plante :</label>
        <input type="text" id="nouveauNom" name="nouveauNom" value="<?php echo $nomPlanteActuel; ?>" required>

        <label for="nouveauPrix">Nouveau Prix :</label>
        <input type="text" id="nouveauPrix" name="nouveauPrix" value="<?php echo $prixActuel; ?>" required>

        <button type="submit" name="modifierPlante">Modifier la Plante</button>
    </form>
</body>

</html>
