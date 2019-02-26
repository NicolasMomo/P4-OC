<?php $title = 'Modération des commentaires'; ?>

<?php ob_start(); ?>

<h1>Espace d'administration</h1>
<div id="adminSpace">

    <div id="WrittingChap">

        <h2>Nouveau chapitre</h2>

        <form id="getNewChapter" action="index.php?action=addPost" method="post">

            <label>Titre:<input type="text" name="title" id="title" value="" required /></label>

            <textarea class="tinymce" name="tinymce_Chap"></textarea>

            <input type="submit" id="send" value="Publier" />
        </form>
    </div>

    <div id="adminComments">
        <div>
            <h2>Modération des commentaires</h2>
        </div>
        <div>
            <?php
    foreach ($reported as $report)
    {
    ?>
            <div id="commentZone">
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
        <div>
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


                <?= nl2br($data['content']) ?>
                <br />

                <a href="index.php?action=seePost&amp;id=<?= $data['id'] ?>">Modifier</a>
                <a href="index.php?action=deletePost&amp;id=<?= $data['id'] ?>">Supprimer</a>
            </div>
            <?php
}
$posts->closeCursor();
?>
        </div>
    </div>
</div>

<script src="https://cloud.tinymce.com/5/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: 'textarea'
    });

</script>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>