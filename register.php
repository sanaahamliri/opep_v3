<?php
session_start();
require 'Database.php';
require 'User.php';

$db = new Database();
$user = new User($db);

if (isset($_POST['register'])) {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $motDePasse = $_POST['motDePasse'];

    if ($user->register($nom, $email, $motDePasse)) {
        $_SESSION['registration_data'] = array(
            'nom' => $nom,
            'email' => $email,
            'motDePasse' => $motDePasse
        );

        header("Location: select_role.php");
        exit();
    } else {
        echo "Erreur d'inscription : Veuillez vérifier vos données et réessayer.";
        echo "Erreur détaillée : " . $user->getLastError();
    }
}
?>
