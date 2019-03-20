<?php $title = 'Modération des commentaires'; ?>

<?php ob_start(); ?>

<h1 class='welcomeTitle'>ESPACE D'ADMINISTRATION</h1>

<a href="index.php">&larr; Retour à l'accueil</a>

<?php
        if (isset($_SESSION['admin']) AND $_SESSION['admin'] == 1)
        {
        ?>
<div id="adminLinks">
    <div class="adminLinksBox">
        <a href="#" id="newChapter">Écrire un nouveau chapitre</a>
        <img class="newPostsImg" src="public/img/posts.png" />
    </div>
    <div class="adminLinksBox">
        <a href="#" id="showComments">Modération des commentaires</a>
        <img id="commentsImg" src="public/img/comments.png" />
    </div>
    <div class="adminLinksBox">
        <a href="#" id="showPosts">Gestion des posts</a>
        <img class="newPostsImg" src="public/img/modifyposts.png" />
    </div>
</div>

<div id="background3">
    <div id="separateur"></div>
    <div id="separateur2"></div>
</div>

<div id="adminSpace">

    <div id="WrittingChap">
        <div class="titles">
            <h2>Écriture d'un nouveau chapitre</h2>
        </div>

        <form id="getNewChapter" action="index.php?action=addPost" method="post">

            <label id='postTitle'>Titre:<input type="text" name="title" id="title" value="" required /></label>

            <textarea class="tinymce" name="tinymce_Chap"></textarea>

            <input type="submit" id="send" value="Publier" />
        </form>
    </div>


    <div id="adminComments">
        <div class="titles">
            <h2>Modération des commentaires</h2>
        </div>
        <div>
            <?php
    foreach ($reported as $report)
    {
    ?>
            <div id="adminCommentZone">
                <p id="authorNameDate"><strong>
                        <?= htmlspecialchars($report['author']) ?></strong> le
                    <?= $report['comment_date_fr'] ?>
                </p>
                <p id="commentText">
                    <?= nl2br(htmlspecialchars($report['comment'])) ?>
                </p>
                <a href="index.php?action=autoriseComment&amp;id=<?= $report['id'] ?>">Autoriser</a>
                <a href="index.php?action=deleteComment&amp;id=<?= $report['id'] ?>">Supprimer</a>
            </div>
            <?php
            }
            ?>
        </div>
    </div>

    <div id="adminPosts">
        <div class="titles">
            <h2>Modération des posts</h2>
        </div>
        <div>
            <?php
while ($data = $posts->fetch())
{
?>
            <div class="newsAdmin">
                <h3>
                    <?= htmlspecialchars($data['title']) ?>
                    <em>le
                        <?= $data['creation_date_fr'] ?></em>
                </h3>

                <div id="newsAdminContent">
                    <?= nl2br($data['content']) ?>


                    <a href="index.php?action=seePost&amp;id=<?= $data['id'] ?>">Modifier</a>
                    <a href="index.php?action=deletePost&amp;id=<?= $data['id'] ?>">Supprimer</a>
                </div>
            </div>
            <?php
}
$posts->closeCursor();
?>
        </div>
    </div>
</div>
<?php
        }
else{
    ?>
<h1>Zone réservée à l'administrateur</h1>
<?php
}
?>

<script src="public/js/blog.js"></script>
<script src="https://cloud.tinymce.com/5/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: 'textarea',
        height: '600px'
    });

</script>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
