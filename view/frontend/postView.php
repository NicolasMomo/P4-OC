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
while ($comment = $comments->fetch())<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
<h1>Billet simple pour l'Alaska !</h1>
<p><a href="index.php">&larr; Retour à la liste des billets</a></p>

<div id="background2">
    <div id="separateur"></div>
    <div id="separateur2"></div>
</div>

<div class="news">
    <h3>
        <?= $post['title'] ?>
        <em>le
            <?= $post['creation_date_fr'] ?></em>
    </h3>
    <div class="newsContent">
        <p>
            <?= $post['content'] ?>
        </p>
    </div>
</div>

<h2 id="titleComments">Écrire un commentaire</h2>
<div>
    <?php
        if (isset($_SESSION['id']) AND $_SESSION['pseudo'])
            {
            ?>
    <div id="commentBlock">
        <form id="postComment" action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
            <div>
                <label for="author">Auteur</label><br />
                <input type="text" id="author" name="author" value="<?php echo $_SESSION['pseudo'] ?>" />
            </div>
            <div>
                <label for="comment">Commentaire</label><br />
                <textarea id="comment" name="comment"></textarea>
            </div>
            <div>
                <input type="submit" />
            </div>
        </form>
    </div>
    <?php
            }
            else
                {
                ?>
    <p id="connectForComment">Veuillez vous connecter afin de pouvoir poster un commentaire.</p>
    <?php
                }
                ?>
    <h2 id="titleComments">Commentaires</h2>
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

        <a href="index.php?action=reportComment&amp;id=<?= $comment['id'] ?>&amp;postId=<?= $post['id'] ?>">Signaler</a>
    </div>
    <?php
    }
    ?>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>

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

    <a href="index.php?action=reportComment&amp;id=<?= $comment['id'] ?>&amp;postId=<?= $post['id'] ?>">Signaler</a>
</div>
<?php
}
?>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
