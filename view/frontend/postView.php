<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
<h1>Billet simple pour l'Alaska !</h1>
<p><a href="index.php">Retour à la liste des billets</a></p>

<div class="news">
    <h3>
        <?= htmlspecialchars($post['title']) ?>
        <em>le
            <?= $post['creation_date_fr'] ?></em>
    </h3>

    <p>
        <?= nl2br(htmlspecialchars($post['content'])) ?>
    </p>
</div>

<h2>Commentaires</h2>

<?php
        if (isset($_SESSION['id']) AND $_SESSION['pseudo'])
        {
        ?>
<form id="postComment" action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
    <div>
        <label for="author">Auteur</label><br />
        <input type="text" id="author" name="author" />
    </div>
    <div>
        <label for="comment">Commentaire</label><br />
        <textarea id="comment" name="comment"></textarea>
    </div>
    <div>
        <input type="submit" />
    </div>
</form>
<?php
        }
    else
    {
    ?>
<p id="connectForComment">Veuillez vous connecter afin de pouvoir poster un commentaire.</p>
<?php
    }
    ?>

<?php
while ($comment = $comments->fetch())
{
?>
<div id="commentZone">
    <p id="authorNameDate"><strong>
            <?= htmlspecialchars($comment['author']) ?></strong> le
        <?= $comment['comment_date_fr'] ?>
    </p>
    <p id="commentText">
        <?= nl2br(htmlspecialchars($comment['comment'])) ?>
    </p>

</div>
<?php
}
?>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
