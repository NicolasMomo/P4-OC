<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>
        <?= $title ?>
    </title>
    <link href="public/css/style.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Old+Standard+TT" rel="stylesheet">
</head>

<body>
    <div id="top"></div>
    <div id="welcomeConnect">
        <div id="welcome">
            <?php
                if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
                {
                    echo 'Bonjour ' . htmlspecialchars($_SESSION['pseudo']);
                    
                    if (isset($_SESSION['admin']) AND ($_SESSION['admin'] == 1))
                    {
                    ?>
            <div id="connectAdmin">
                <a href="index.php?action=seeReported">Administration</a>
            </div>
            <?php
                    }
                    ?>
            <a href="index.php?action=disconnectMember">Se déconnecter</a>
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
        </div>
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

    <div>
        <a id='cRetour' class='cVisible' href='#top'></a>
    </div>

    <script src="public/js/buttonReturnTop.js"></script>
</body>

</html>
