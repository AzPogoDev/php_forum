<?php
/** @var PDO $database */
$database = require_once dirname(__FILE__) . '/../utils/database.utils.php';

$query = $database->prepare('SELECT * FROM `articles` WHERE id = :id');
$query->execute([
    'id' => $_GET['id'],
]);

$row = $query->fetch();
?>

<div class="container my-5">
    <div class="row">
        <div class="col">
            <h1><?php echo $row['title']; ?></h1>
            <div><?php echo nl2br($row['content']); ?></div>
        </div>
    </div>
</div>
