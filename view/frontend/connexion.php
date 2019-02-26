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
    <div>
        <form action="/php/architecture MVC/index.php?action=connectMember" method="post">
            <div id="connection">
                <div>
                    <label for="userName">Identifiant</label><br />
                    <input type="text" id="userName" name="userName" />
                </div>
                <div>
                    <label for="comment">Mot de passe</label><br />
                    <input type="password" id="pass" name="pass">
                    <?php
                        if(isset($_SESSION['errorConnectPass']))
                        {
                            echo '<p>' . $_SESSION['errorConnectPass'] . '</p>';
                        }
                        if(isset($_SESSION['errorConnectPseudo'])){
                            echo '<p>' . $_SESSION['errorConnectPseudo'] . '</p>';
                        }
                    ?>
                </div>
                <div>
                    <input type="submit" value="Se connecter" name="connectionButton">
                </div>
            </div>
            <div class="links">
                <a href="inscription.php">Pas encore inscrit ? S'inscrire</a>
                <a href="/php/architecture MVC/index.php">Retour vers la page d'accueil</a>
            </div>
        </form>
    </div>
</body>

</html>
