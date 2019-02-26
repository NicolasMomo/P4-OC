<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link href="/php/architecture MVC/public/css/style.css" rel="stylesheet" />
    <title>Inscription espace membre</title>
</head>
<style>
    form
    {
        text-align:center;
    }
    </style>

<body>
    <form action="/php/architecture MVC/index.php?action=addMember" method="post">
        <div id="formInscription">
            <div id="inscriptionPseudo">
                <div class="inscriptionInput">
                    <label for="pseudo">Pseudo :</label>
                    <input type="text" name="pseudo" id="pseudo" />
                </div>
                <div>
                    <?php
                        if (isset($_SESSION['errorPseudo']))
                        {
                            echo $_SESSION['errorPseudo'];
                        }
                        ?>
                </div>
            </div>
            <div id="inscriptionPass">
                <div class="inscriptionInput">
                    <label for="pass">Mot de passe :</label>
                    <input type="password" name="pass" id="pass" />
                </div>
                <div>
                    <?php
                        if (isset($_SESSION['errorPass']))
                        {
                            echo $_SESSION['errorPass'];
                        }
                    ?>
                </div>
            </div>
            <div id="inscriptionConfirmPass">
                <label for="confirmPass">Confirmez votre mot de passe :</label>
                <input type="password" name="confirmPass" id="confirmPass" />
            </div>
            <div id="inscriptionEmail">
                <div class="inscriptionInput">
                    <label for="email">Adresse email :</label>
                    <input type="email" name="email" id="email" />
                </div>
                <div>
                    <?php
                        if (isset($_SESSION['errorMail']))
                        {
                            echo $_SESSION['errorMail'];
                        }
                    ?>
                </div>
            </div>
            <div id="inscriptionSubmit">
                <input type="submit" value="S'inscrire" />
            </div>
        </div>
        <div class="links">
            <a href="connexion.php">Déjà inscrit ? Se connecter</a>
            <a href="/php/architecture MVC/index.php">Retour vers la page d'accueil</a>
        </div>
    </form>
</body>

</html>
