<?php

if (isset($_POST['articleForm'])) {
    if (isset($_POST['articleFormTitle']) && !empty($_POST['articleFormTitle']) &&
        isset($_POST['articleFormIllustrationImageUrl']) && !empty($_POST['articleFormIllustrationImageUrl']) &&
        isset($_POST['articleFormChapeau']) && !empty($_POST['articleFormChapeau']) &&
        isset($_POST['articleFormContent']) && !empty($_POST['articleFormContent'])) {

        /** @var PDO $database */
        $database = require_once dirname(__FILE__) . '/../utils/database.utils.php';

        $query = $database->prepare('INSERT INTO `articles` (`title`, `illustration_image_url`, `chapeau`, `content`, `created_at`) VALUES(:title, :illustration_image_url, :chapeau, :content, NOW())');
        $res = $query->execute([
            'title' => $_POST['articleFormTitle'],
            'illustration_image_url' => $_POST['articleFormIllustrationImageUrl'],
            'chapeau' => $_POST['articleFormChapeau'],
            'content' => $_POST['articleFormContent'],
        ]);
    }

}

?>

<div class="container my-5">
    <div class="row">
        <div class="col">
            <form action="/?page=create-article" method="post">
                <div class="mb-3">
                    <label for="articleFormTitle" class="form-label">Titre</label>
                    <input type="text" class="form-control" id="articleFormTitle" name="articleFormTitle">
                </div>
                <div class="mb-3">
                    <label for="articleFormIllustrationImageUrl" class="form-label">URL de l'image d'illustration</label>
                    <input type="url" class="form-control" id="articleFormIllustrationImageUrl" name="articleFormIllustrationImageUrl">
                </div>
                <div class="mb-3">
                    <label for="articleFormChapeau" class="form-label">Chapeau</label>
                    <textarea class="form-control" id="articleFormChapeau" rows="3" name="articleFormChapeau"></textarea>
                </div>
                <div class="mb-3">
                    <label for="articleFormContent" class="form-label">Contenu</label>
                    <textarea class="form-control" id="articleFormContent" rows="10" name="articleFormContent"></textarea>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success" name="articleForm">
                        Créer
                    </button>
                </div>
            </form>


        </div>
    </div>
</div>
