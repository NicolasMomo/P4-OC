<!DOCTYPE html>
<html>

<head>
    <link href="public/css/style.css" rel="stylesheet" />
    <script src="https://cloud.tinymce.com/5/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea', height: '600px' });</script>
</head>

<body>

    <h1>Modifier chapitre</h1>

    <a href="index.php?action=seeReported">&larr; Retour à l'administration</a>

    <div id="background3">
        <div id="separateur"></div>
        <div id="separateur2"></div>
    </div>

    <div id="WrittingChap">

        <?php
					while($chapitre = $post->fetch()){
				?>
        <form id="getNewChapter" action="index.php?action=modifyPost&amp;id=<?php echo $chapitre['id']; ?>" method="post">

            <label id="modifyPostLabel">Titre:<input type="text" name="title" id="title" value="<?= htmlspecialchars($chapitre['title']) ?>" required /></label>

            <textarea class="tinymce" name="tinymce_Chap"><?= $chapitre['content'] ?></textarea>

            <input type="submit" id="edit" value="Modifier" />
        </form>
        <?php
					}
					$post->closeCursor();
				?>
    </div>
</body>

</html>
