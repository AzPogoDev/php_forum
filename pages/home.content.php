<?php

/** @var PDO $database */
$database = require_once dirname(__FILE__) . '/../utils/database.utils.php';

$query = $database->prepare('SELECT * FROM `articles`');
$query->execute();
?>

<?php while (($row = $query->fetch())) { ?>

        <div class="container my-5">
            <div class="row">
                <div class="col-3">
                    <img alt="Illustration" src="<?php echo $row['illustration_image_url']; ?>" width="100%" />
                </div>
                <div class="col">
                    <a href="/?page=read-article&id=<?php echo $row['id']; ?>"><h2><?php echo $row['title']; ?></h2></a>
                    <small><?php echo nl2br($row['chapeau']); ?></small>
                </div>
            </div>
        </div>

<?php } ?>
