<?php
session_start();
require 'Database.php';
require 'Role.php';

$db = new Database();
$roleManager = new Role($db);

if (isset($_POST['save_role'])) {
    $registrationData = $_SESSION['registration_data'];
    $role = $_POST['role'];

    if ($roleManager->saveRole($registrationData, $role)) {
        if ($role == 1) {
            header("Location: admin_page.php");
        } else {
            header("Location: client_page.php");
        }
        exit();
    } else {
        // Gère les erreurs d'enregistrement du rôle
        echo "Erreur d'enregistrement : " . $roleManager->getLastError();
    }
}
?>
