<?php

$database = require_once dirname(__FILE__) . '/../utils/database.utils.php';

$querybis = $database->prepare('SELECT * FROM `subject` WHERE id = :subid');

$query = $database->prepare('SELECT * FROM `reply` WHERE subjectId = :subid');

$query->execute([
    'subid' => $_GET['subid'],
]);

$querybis->execute([
    'subid' => $_GET['subid'],
]);

$subjectId = $_GET['subid'];

if (isset($_POST['replyForm'])) {
    if ( isset($_POST['content']) && !empty($_POST['content'])) {

        $queryInsert = $database->prepare('INSERT INTO `reply`(`author`, `content`, `subjectId`) VALUES (:author,:content,:subid)');
        $queryInsert->execute([
            'author' => $_POST['author'],
            'content' => $_POST['content'],
            'subid' => $subjectId
        ]);

        header("Location: ./?page=single-subject&subid=$subjectId");
    }
}

?>
<div class="wrapper">

    <?php while (($q = $querybis->fetch())) { ?>

        <div class="subject__content">
            <div class="post__status"><?= $q['status'] ?></div>
            <h1><h1 class="text-center"><?= $q['title'] ?></h1></h1>
            <p><?= $q['content'] ?><p></p></p>
        </div>
    <?php } ?>
    <div class="reply__content my-5">
        <h2 class="my-2" style="font-size: 2rem">Réponse :</h2>
        <?php while (($qb = $query->fetch())) { ?>

            <div class="reponse__single">
                <div class="reponse__author">
                    <h2><?= $qb['author'] ?></h2>
                </div>
                <div class="reponse__content">
                    <p><?= $qb['content'] ?></p>
                </div>
            </div>

        <?php } ?>
    </div>
    <div class="reply__form">
        <h2 class="my-2" style="font-size: 2rem">Ajouter une réponse :</h2>
        <form action="/?page=single-subject&subid=<?= $subjectId?>" method="POST">
            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" class="form-control" id="author" name="author" placeholder="Auteur">
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <textarea type="text" class="form-control" id="content" name="content" placeholder="content"></textarea>
            </div>
            <button type="submit" name="replyForm" class="my-2 btn btn-primary">Submit</button>
        </form>
    </div>


</div>

