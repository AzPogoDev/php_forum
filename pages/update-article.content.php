<?php

/** @var PDO $database */
$database = require_once dirname(__FILE__) . '/../utils/database.utils.php';

if (isset($_POST['articleForm'])) {
    if (isset($_POST['articleFormTitle']) && !empty($_POST['articleFormTitle']) &&
        isset($_POST['articleFormIllustrationImageUrl']) && !empty($_POST['articleFormIllustrationImageUrl']) &&
        isset($_POST['articleFormChapeau']) && !empty($_POST['articleFormChapeau']) &&
        isset($_POST['articleFormContent']) && !empty($_POST['articleFormContent'])) {

        $query = $database->prepare('UPDATE `articles` SET `title` = :title, `illustration_image_url` = :illustration_image_url, `chapeau` = :chapeau, `content` = :content WHERE `id` = :id');
        $res = $query->execute([
            'id' => $_GET['id'],
            'title' => $_POST['articleFormTitle'],
            'illustration_image_url' => $_POST['articleFormIllustrationImageUrl'],
            'chapeau' => $_POST['articleFormChapeau'],
            'content' => $_POST['articleFormContent'],
        ]);
    }
}

$query = $database->prepare('SELECT * FROM `articles` WHERE id = :id');
$query->execute([
    'id' => $_GET['id'],
]);

$article = $query->fetch();

?>

<div class="container my-5">
    <div class="row">
        <div class="col">
            <form action="/?page=update-article&id=<?php echo $article['id']; ?>" method="post">
                <div class="mb-3">
                    <label for="articleFormTitle" class="form-label">Titre</label>
                    <input type="text" class="form-control" id="articleFormTitle" name="articleFormTitle" value="<?php echo $article['title']; ?>">
                </div>
                <div class="mb-3">
                    <label for="articleFormIllustrationImageUrl" class="form-label">URL de l'image d'illustration</label>
                    <input type="url" class="form-control" id="articleFormIllustrationImageUrl" name="articleFormIllustrationImageUrl" value="<?php echo $article['illustration_image_url']; ?>">
                </div>
                <div class="mb-3">
                    <label for="articleFormChapeau" class="form-label">Chapeau</label>
                    <textarea class="form-control" id="articleFormChapeau" rows="3" name="articleFormChapeau"><?php echo $article['chapeau']; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="articleFormContent" class="form-label">Contenu</label>
                    <textarea class="form-control" id="articleFormContent" rows="10" name="articleFormContent"><?php echo $article['content']; ?></textarea>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success" name="articleForm">
                        Modifier
                    </button>
                </div>
            </form>


        </div>
    </div>
</div>
