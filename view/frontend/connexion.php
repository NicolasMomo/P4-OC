<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link href="public/css/style.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Old+Standard+TT" rel="stylesheet">
    <title>Connexion au blog</title>
</head>
<style>
    form
    {
        text-align:center;
    }
    </style>

<body>

    <h1 id="connexionTitle" class="welcomeTitle">CONNEXION AU BLOG</h1>

    <div id="background4">
        <div id="separateur"></div>
        <div id="separateur2"></div>
    </div>

    <div>
        <form action="index.php?action=connectMember" method="post">
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
                <a href="index.php?action=inscriptionForm">Pas encore inscrit ? S'inscrire</a>
                <a href="index.php?action=listPosts">Retour vers la page d'accueil</a>
            </div>
        </form>
    </div>
</body>

</html>
