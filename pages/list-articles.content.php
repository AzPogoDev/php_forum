<?php

/** @var PDO $database */
$database = require_once dirname(__FILE__) . '/../utils/database.utils.php';

$query = $database->prepare('SELECT * FROM `articles`');
$query->execute();
?>

<div class="container my-5">
    <div class="row">
        <div class="col">

            <a href="/?page=create-article" class="btn btn-success float-end">Créer un nouvel article</a>

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Date de création</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php while (($row = $query->fetch())) { ?>

                    <tr>
                        <th scope="row"><?php echo $row['id']; ?></th>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                        <td>
                            <a href="/?page=update-article&id=<?php echo $row['id']; ?>" class="btn btn-warning">Modifier</a>
                            <a href="/?page=delete-article&id=<?php echo $row['id']; ?>" class="btn btn-danger">Effacer</a>
                        </td>
                    </tr>

                <?php } ?>

                </tbody>
            </table>

        </div>
    </div>
</div>

