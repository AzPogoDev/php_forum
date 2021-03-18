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
    if (isset($_POST['content']) && !empty($_POST['content'])) {

        $queryInsert = $database->prepare('INSERT INTO `reply`(`author`, `content`, `subjectId`) VALUES (:author,:content,:subid)');
        $queryInsert->execute([
            'author' => $_POST['author'],
            'content' => $_POST['content'],
            'subid' => $subjectId
        ]);

        header("Location: ./?page=single-subject&subid=$subjectId");
    }
}


if (isset($_POST['replyToDelete'])) {
    if (isset($_POST['replyIdToDelete']) && !empty($_POST['replyIdToDelete'])) {

        $queryInsert = $database->prepare('DELETE FROM `reply` WHERE `reply`.`id` = :replyIdToDelete');

        $queryInsert->execute([
            'replyIdToDelete' => $_POST['replyIdToDelete']
        ]);

        header("Location: ./?page=single-subject&subid=$subjectId");
    }
}

?>
<div class="wrapper">

    <?php while (($q = $querybis->fetch())) { ?>

        <div class="subject__content" style="min-height: 15vh;margin-top: 20vh">
            <div class="post__status"><?= $q['status'] ?></div>
            <h1><h1 class="text-center text-decoration-underline"><?= $q['title'] ?></h1></h1>
            <p class="mt-3 text-center"><?= $q['content'] ?><p></p></p>
        </div>


        <div class="reply__content my-5">
            <!--        <h2 class="my-2" style="font-size: 2rem">Réponse :</h2>-->
            <?php while (($qb = $query->fetch())) { ?>

                <div class="reponse__single my-4">
                    <div class="reponse__author d-flex justify-content-between">
                        <h2>Auteur : <?= $qb['author'] ?></h2>
                        <?php if (isset($_SESSION['user'])) : ?>
                            <form action="/?page=single-subject&subid=<?= $subjectId ?>" method="POST">

                                <input type="hidden" name="replyIdToDelete" value="<?= $qb['id']; ?>">
                                <button type="submit" name="replyToDelete" class="my-2 btn btn-danger">X
                                </button>
                            </form>
                        <?php endif ?>
                    </div>
                    <div class="reponse__content py-3" style="background: #7e7b7b; color: black">
                        <p><?= $qb['content'] ?></p>
                    </div>
                </div>

            <?php } ?>
        </div>

        <?php  if ( $q['status'] == 'Ouvert') : ?>

        <div class="reply__form">
            <h2 class="my-2" style="font-size: 2rem">Ajouter une réponse :</h2>
            <form action="/?page=single-subject&subid=<?= $subjectId ?>" method="POST">
                <div class="form-group">
                    <label for="author">Auteur</label>

                    <input type="text" class="form-control" id="author" name="author" placeholder=" Auteur">

                </div>


                <div class="form-group">
                    <label for="content">Contenue</label>
                    <textarea type="text" class="form-control" id="content" name="content"
                              placeholder=" Contenue"></textarea>
                </div>
                <button type="submit" name="replyForm" class="my-2 btn btn-primary">Ajouter</button>
            </form>
        </div>

        <?php else : ?>

            <h2 class="my-2" style="font-size: 2rem">Sujet clos</h2>

        <?php endif; ?>

    <?php } ?>
</div>

