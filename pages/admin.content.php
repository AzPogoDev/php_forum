<?php

/** @var PDO $database */
$database = require_once dirname(__FILE__) . '/../utils/database.utils.php';

$query = $database->prepare('SELECT * FROM category');
$querybis = $database->prepare('SELECT * FROM subject');
$queryreply = $database->prepare('SELECT * FROM reply');

$query->execute();
$querybis->execute();
$queryreply->execute();


if (isset($_POST['catSubmit'])) {
    if (isset($_POST['categoryTitle']) && !empty($_POST['categoryTitle'])) {

        $queryInsert = $database->prepare('INSERT INTO `category`(`title`) VALUES (:title)');
        $queryInsert->execute([
            'title' => $_POST['categoryTitle']
        ]);

        header("Location: ./?page=admin");
    }
}

if (isset($_POST['catDeleteSubmit'])) {
    if (isset($_POST['catIdToDelete']) && !empty($_POST['catIdToDelete'])) {

//        Delete cat name
        $queryInsert = $database->prepare('DELETE FROM `category` WHERE `category`.`id` = :catIdToDelete');

//        Delete all subject related
        $querySubDelete = $database->prepare('DELETE FROM `subject` WHERE `subject`.`categoryId` = :catIdToDelete');

//        Delete all reply related
        $queryReplyDelete = $database->prepare('DELETE FROM `reply` WHERE `reply`.`subjectId` = :subjectId');

        $queryInsert->execute([
            'catIdToDelete' => $_POST['catIdToDelete']
        ]);

        $queryReplyDelete->execute([
            'subjectId' => $_POST['subjectId']
        ]);

        $querySubDelete->execute([
            'catIdToDelete' => $_POST['catIdToDelete']
        ]);

        header("Location: ./?page=admin");
    }
}


if (isset($_POST['subToDelete'])) {
    if (isset($_POST['subIdToDelete']) && !empty($_POST['subIdToDelete'])) {

        $queryInsert = $database->prepare('DELETE FROM `subject` WHERE `subject`.`id` = :subIdToDelete');
        $queryInsert->execute([
            'subIdToDelete' => $_POST['subIdToDelete']
        ]);

        header("Location: ./?page=admin");
    }
}

function GetNumberOfPost($catId)
{

    $database = new PDO('mysql:dbname=php_forum_tp;host=localhost;charset=utf8', 'root');
    $querybis = $database->prepare('SELECT * FROM `subject` WHERE categoryid = :catid');
    $querybis->execute([
        'catid' => $catId,
    ]);
    $result = $querybis->rowCount();
    echo $result;
}

if (isset($_POST['newStatus'])) {
    if (isset($_POST['subIdToUpdate']) && !empty($_POST['subIdToUpdate'])) {

        $queryInsert = $database->prepare('UPDATE `subject` SET `status` = :status WHERE `subject`.`id` = :subIdToUpdate');
        $queryInsert->execute([
            'subIdToUpdate' => $_POST['subIdToUpdate'],
            'status' => $_POST['status']

        ]);

        header("Location: ./?page=admin");

    }

}


if (isset($_POST['disconnect'])) {
    session_destroy();
    header('Location: ./?page=home');
}


?>

<div class="wrapper">
    <h1 class="text-center" style="font-size: 4rem">Admin page</h1>

    <h2 class="text-left" style="font-size: 4rem">Catégorie Admin</h2>
    <form action="/?page=admin" method="POST">

        <div class="form-group">
            <label for="catname">Nom de la catégorie</label>
            <input type="text" class="form-control" id="categoryTitle" name="categoryTitle"
                   placeholder="Nom de la catégorie">
        </div>

        <button type="submit" name="catSubmit" class="my-2 btn btn-primary">Créer une catégorie</button>
    </form>

    <table class="my-1">
        <tr>
            <th class="" style="text-align: left;"> Categories</th>
            <th>
                <p>Settings</p>
            </th>
            <th>
                <p>Number of post</p>
            </th>
        </tr>

        <?php while (($q = $query->fetch())) { ?>


            <tr class="forum-topicview-row">
                <td><a about="__blank" data-bs-toggle="collapse" class="catLink"
                       aria-controls="collapseCat_<?= $q['id']; ?>">
                        <p>
                            <?= $q['title']; ?>
                        </p>
                    </a></td>
                <td>

                    <form action="/?page=admin" method="POST">

                        <?php while (($replyq = $queryreply->fetch())) { ?>
                            <input type="hidden" name="subjectId" value="<?= $replyq['subjectId']; ?>">
                        <?php } ?>

                        <input type="hidden" name="catIdToDelete" value="<?= $q['id']; ?>">
                        <button type="submit" name="catDeleteSubmit" class="my-2 btn btn-danger">Supprimer la
                            catégorie
                        </button>
                    </form>

                </td>
                <td><?php GetNumberOfPost($q['id']); ?></td>
            <tr>

            </tr>

            </tr>
        <?php } ?>


    </table>
    <h2 class="text-left my-3" style="font-size: 4rem">Subject Admin</h2>

    <!--    <form action="/?page=admin" method="POST">-->
    <!---->
    <!--        <div class="form-group">-->
    <!--            <label for="subName">Nom du sujet</label>-->
    <!--            <input type="text" class="form-control" id="subName" name="subName"-->
    <!--                   placeholder="Nom du sujet">-->
    <!--            <textarea class="form-control" placeholder="Content subject" name="subContent" id="subContent"></textarea>-->
    <!--        </div>-->
    <!---->
    <!--        <button type="submit" name="subSubmit" class="my-2 btn btn-primary">Créer un sujet</button>-->
    <!--    </form>-->

    <table>


        <tr>
            <th class="" style="text-align: left;">Les sujets
            <th>
                <p>Status</p>
            </th>
            <th>
                <p>Date de création</p>
            </th>
            <th>
                <p>Catégorie</p>
            </th>
            <th>
                <p>Settings</p>
            </th>
            <th>
                <p>Change status</p>
            </th>

        </tr>

        <?php while (($q = $querybis->fetch())) { ?>
            <?php

            $querycat = $database->prepare('SELECT * FROM `category` WHERE id = :subid');
            $querycat->execute([
                'subid' => $q['categoryId'],
            ]);
            while (($qs = $querycat->fetch())) {
                ?>


                <tr class="forum-topicview-row">

                    <td>
                        <p><a href="/?page=single-subject&subid=<?= $q['id']; ?>"><?= $q['title']; ?></a>
                        </p>
                        <p>
                        </p>
                    </td>

                    <td>
                        <p><?= $q['status']; ?></p>
                    </td>
                    <td>
                        <p><?= $q['create_date'] ?></p>
                    </td>
                    <td>
                        <p><?= $qs['title']; ?></p>
                    </td>

                    <td>
                        <form action="/?page=admin" method="POST">
                            <input type="hidden" name="subIdToDelete" value="<?= $q['id']; ?>">
                            <button type="submit" name="subToDelete" class="my-2 btn btn-danger">Supprimer le sujet et
                                ses messages
                            </button>
                        </form>
                    </td>
                    <td>
                        <form action="/?page=admin" method="POST">
                            <input type="hidden" name="subIdToUpdate" value="<?= $q['id']; ?>">

                            <div class="form-group">

                                <label for="status">Ouvert</label>
                                <input type="checkbox" name="status" value="ouvert" aria-label="ouvert">

                                <label for="ferme">Ferme</label>
                                <input type="checkbox" name="status" value="ferme" aria-label="ferme">

                            </div>
                            <input type="submit" name="newStatus" class="mt-3 btn btn-primary"
                                   value="Changer la valeur">
                        </form>
                    </td>
                </tr>

                </tr>


                <tr>


                </tr>

                </tr>
            <?php } ?>

        <?php } ?>
    </table>

</div>

