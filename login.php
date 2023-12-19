
<?php
session_start();
require 'Database.php';

if (isset($_POST['login'])) {
    $loginEmail = $_POST['loginEmail'];
    $loginMotDePasse = $_POST['loginMotDePasse'];

    $db = new Database();
    $conn = $db->getConnection();

    // Utilisation de requêtes préparées avec PDO pour éviter l'injection SQL
    $sql = "SELECT * FROM utilisateur WHERE email = :email AND motDePasse = :motDePasse";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $loginEmail, PDO::PARAM_STR);
    $stmt->bindParam(':motDePasse', $loginMotDePasse, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION['iduser'] = $user['idUser'];

        if ($user['idRole'] == 1) {
            header("Location: admin_page.php");
        } else {
            header("Location: client_page.php");
        }
        exit();
    } else {
        echo "Échec de la connexion. Veuillez vérifier vos informations.";
    }
}
?>
