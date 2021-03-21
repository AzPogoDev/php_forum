<?php

/** @var PDO $database */
$database = require_once dirname(__FILE__) . '/../utils/database.utils.php';

$query = $database->prepare('SELECT * FROM `subject` WHERE categoryid = :catid');
$query->execute([
    'catid' => $_GET['catid'],
]);

$cateid = $_GET['catid'];
$catname = $_GET['name'];

if (isset($_POST['subSubmit'])) {
    if (isset($_POST['postTitle']) && !empty($_POST['postTitle']) && isset($_POST['postContent']) && !empty($_POST['postContent'])) {

        $queryInsert = $database->prepare('INSERT INTO `subject`(`categoryId`, `title`, `content`) VALUES (:categoryId,:title,:content)');
        $queryInsert->execute([
            'categoryId' => $_GET['catid'],
            'title' => $_POST['postTitle'],
            'content' => $_POST['postContent']
        ]);

        header("Location: ./?page=single-category&name=$catname&catid=$cateid");
    }
}


?>
<div class="wrapper">

    <table>


        <tr>
            <th class="" style="text-align: left;">Bienvenue sur la catégorie
                : <?= $_GET['name'] ?></th>
            <th>
                <p>Status</p>
            </th>

        </tr>

        <?php while (($q = $query->fetch())) { ?>


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
            <tr>


            </tr>

            </tr>

        <?php } ?>
    </table>
    <?php if (isset($_SESSION['user'])) : ?>
        <form class="mt-5" action="/?page=single-category&name=<?= $catname ?>&catid=<?= $cateid ?>" method="POST">

            <div class="form-group">
                <label for="postTitle">Nom du post</label>
                <input type="text" class="form-control" id="postTitle" name="postTitle"
                       placeholder="Nom du post">
                <label for="postContent">Contenue du post</label>
                <textarea class="form-control" placeholder="Content" name="postContent" id="postContent"></textarea>

            </div>

            <button type="submit" name="subSubmit" class="my-2 btn btn-primary">Créer un post</button>
        </form>
    <?php endif; ?>


</div>

