<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<h1>Billet simple pour l'Alaska !</h1>
<p>Derniers billets du blog :</p>

<div id="organizeLinks">
    <a href="index.php?action=postsAsc">&darr;Organiser du plus ancien au plus récent</a>
    -
    <a href="index.php?action=listPosts">&uarr;Organiser du plus récent au plus ancien</a>
</div>
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

    <p>
        <?= nl2br($data['content']) ?>
        <br />
        <em><a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Commentaires</a></em>
    </p>
</div>
<?php
}
$posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
