<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>
        <?= $title ?>
    </title>
    <link href="public/css/style.css" rel="stylesheet" />
</head>

<body>
    <div id="welcomeConnect">
        <div id="welcome">
            <?php
                if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
                {
                    echo 'Bonjour ' . $_SESSION['pseudo'];
            ?>
            <br /><a href="index.php?action=disconnectMember">Se déconnecter</a>
            <?php
                }
            ?>
        </div>
        <?php
            if (!isset($_SESSION['id']) AND !isset($_SESSION['pseudo']))
                {
        ?>
        <div id="welcomeLinks">
            <a href="index.php?action=connectForm">Se connecter</a>
            <a href="index.php?action=inscriptionForm">S'inscrire</a>
            <?php
                }
        ?>
        </div>

        <?= $content ?>
        <?php
        if (isset($_SESSION['admin']) AND ($_SESSION['admin'] == 1))
        {
        ?>
        <div id="connectAdmin">
            <a href="index.php?action=seeReported">Administration</a>
        </div>
        <?php
        }
    ?>
    </div>
</body>

</html>
