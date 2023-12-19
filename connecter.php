<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body>
<header>
        <nav>
            <a href="index.php"><img src="./images/Capture_d_écran_2023-12-02_231056-removebg-preview.png" alt="logo"></a>
            <a href="index.php">Accueil</a>
            <a href="index.php">A propos de nous</a>
        </nav>
    </header>
     <!-- Formulaire de connexion -->
     <form method="post" action="login.php">
        <label for="loginEmail">Email :</label>
        <input type="email" name="loginEmail" required>

        <label for="loginMotDePasse">Mot de passe :</label>
        <input type="password" name="loginMotDePasse" required>

        <button type="submit" name="login">Se connecter</button>
    </form>
</body>
</html>