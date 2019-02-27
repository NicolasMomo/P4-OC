<!DOCTYPE html>
<html>

<head>
    <script src="https://cloud.tinymce.com/5/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
</head>

<body>
    <div id="WrittingChap">

        <h2>Modifier chapitre</h2>
        <?php
					while($chapitre = $post->fetch()){
				?>
        <form id="getNewChapter" action="index.php?action=modifyPost&amp;id=<?php echo $chapitre['id']; ?>" method="post">

            <label>Titre:<input type="text" name="title" id="title" value="<?= htmlspecialchars($chapitre['title']) ?>" required /></label>

            <textarea class="tinymce" name="tinymce_Chap"><?= nl2br(htmlspecialchars($chapitre['content'])) ?></textarea>

            <input type="submit" id="edit" value="Modifier" />
        </form>
        <?php
					}
					$post->closeCursor();
				?>
    </div>
</body>

</html>
