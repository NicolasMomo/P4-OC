<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>

<h1 id="welcomeTitle">BIENVENUE SUR LE BLOG DE JEAN FORTEROCHE</h1>

<div id="background">
    <div id="separateur"></div>
    <div id="separateur2"></div>
</div>
<h1>Billet simple pour l'Alaska !</h1>
<div id="organizeLinks">
    <a href="index.php?action=postsAsc">&darr;Organiser du plus ancien au plus récent</a>
    -
    <a href="index.php?action=listPosts">&uarr;Organiser du plus récent au plus ancien</a>
</div>
<div id="postsList">
    <?php
while ($data = $posts->fetch())
{
?>
    <div class="news">
        <h3>
            <?= htmlspecialchars($data['title']) ?>
            <em>le
                <?= $data['creation_date_fr'] ?></em>
        </h3>
        <div class="newsContent">
            <p>
                <?= nl2br($data['content']) ?>
                <em><a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Commentaires</a></em>
            </p>
        </div>
    </div>
    <div id="img">
        <img src="public/img/wind.png" />
        <img id="mountain" src="public/img/mountain2.png" />
        <img src="public/img/wind.png" />
    </div>
    <?php
}
$posts->closeCursor();
?>
</div>

<div id="iframe">
</div>

<?php $content = ob_get_clean(); ?>

<script src="public/js/map.js"></script>

<script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDNR0N5nOM0FK95UQdVn8EYlJxMNFQ_yZQ&callback=initApp"></script>

<?php require('template.php'); ?>
