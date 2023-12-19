<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sélection du rôle</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>

<body>
<header>
        <nav>
            <a href="index.php"><img src="./images/Capture_d_écran_2023-12-02_231056-removebg-preview.png" alt="logo"></a>
            <a href="index.php">Accueil</a>
            <a href="about.php">A propos de nous</a>
        </nav>
    </header>
    <form method="post" action="save_role.php">
        <label for="role">Choisissez votre rôle :</label>
        <select name="role" required>
            <option value="1">Admin</option>
            <option value="2">Client</option>
        </select>

        <button type="submit" name="save_role">Enregistrer le rôle</button>
    </form>
</body>

</html>