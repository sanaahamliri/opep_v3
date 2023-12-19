<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription et Connexion</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
    <style>
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
            height: 80vh;
        }

        input {
            margin-right: 5px;
            padding-right: 20px;
            width: 300px;
            height: 40px;
            box-sizing: border-box;
        }

        #bttn {
            width: 150px;
            align-self: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <header>
        <nav>
            <a href="index.php"><img src="./images/Capture_d_écran_2023-12-02_231056-removebg-preview.png" alt="logo"></a>
            <a href="index.php">Accueil</a>
            <a href="about.php">A propos de nous</a>
        </nav>
    </header>
    <section class="container">
        <div>
            <form method="post" action="register.php" onsubmit="return validateForm()">
                <label for="nom">Nom :</label>
                <div style="position: relative; display: flex; align-items: center;">
                    <input id="name" type="text" name="nom" required>

                </div>

                <label for="email">Email :</label>
                <div style="position: relative; display: flex; align-items: center;">
                    <input id="email" type="email" name="email" required>

                </div>

                <label for="motDePasse">Mot de passe :</label>
                <div style="position: relative; display: flex; align-items: center;">
                    <input id="mot" type="password" name="motDePasse" required>

                </div>

                <button id="bttn" type="submit" name="register">S'inscrire</button>
            </form>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>
        function validateForm() {
            var nameInput = document.getElementById("name");
            var emailInput = document.getElementById("email");
            var passwordInput = document.getElementById("mot");

            const nameRegex = /^[A-Za-z\s]{3,30}$/;
            const emailRegex = /^[a-zA-Z0-9._-]+@[a-z]+\.[a-zA-Z]{2,3}$/;
            var passwordRegex = /^.{8,}$/;


            if (!nameRegex.test(nameInput.value)) {
                alert("Veuillez saisir un nom valide (entre 3 et 30 caractères, lettres et espaces uniquement).");
                return false;
            }


            if (!emailRegex.test(emailInput.value)) {
                alert("Veuillez saisir une adresse e-mail valide.");
                return false;
            }


            if (!passwordRegex.test(passwordInput.value)) {
                alert("Veuillez saisir un mot de passe d'au moins 8 caractères.");
                return false;
            }


            return true;
        }
    </script>
</body>

</html>