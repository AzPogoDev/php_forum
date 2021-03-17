<?php

/** @var PDO $database */
$database = require_once dirname(__FILE__) . '/../utils/database.utils.php';

$query = $database->prepare('SELECT * FROM category');
$queryCount = $database->prepare('SELECT * FROM subject');

$queryCount->execute();
$query->execute();


?>

<div class="wrapper">

    <table>


        <tr>
            <th class="" style="text-align: left;"> Categories</th>

        </tr>
        <?php while (($q = $query->fetch())) { ?>


            <tr class="forum-topicview-row">
                <td><a about="__blank" data-bs-toggle="collapse" class="catLink"
                       aria-controls="collapseCat_<?= $q['id']; ?>">
                        <p>
                            <a href="/?page=single-category&name=<?= $q['title']; ?>&catid=<?= $q['id']; ?>"><?= $q['title']; ?></a>
                        </p>
                    </a></td>
            <tr>


            </tr>

            </tr>

        <?php } ?>
    </table>


</div>
