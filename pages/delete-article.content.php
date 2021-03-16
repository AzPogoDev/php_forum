<?php
/** @var PDO $database */
$database = require_once dirname(__FILE__) . '/../utils/database.utils.php';

$query = $database->prepare('DELETE FROM `articles` WHERE id = :id');
$query->execute([
    'id' => $_GET['id'],
]);
?>

<div class="container my-5">
    <div class="row">
        <div class="col text-center">

            L'article a été effacé.

        </div>
    </div>
</div>
