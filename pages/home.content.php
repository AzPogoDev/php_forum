<?php

/** @var PDO $database */
$database = require_once dirname(__FILE__) . '/../utils/database.utils.php';

$query = $database->prepare('SELECT * FROM category');
$queryCount = $database->prepare('SELECT * FROM subject');

$querySub = $database->prepare('SELECT * FROM `subject` WHERE categoryid = :catid');


$queryCount->execute();
$query->execute();

$i = 0;


?>

<div class="wrapper">
    <h2 class="text-left my-3" style="font-size: 4rem">Catégories</h2>
    <?php while (($q = $query->fetch())) { ?>

        <?php

        $querySub->execute([
            'catid' => $q['id'],
        ]);

        ?>
        <?php $i++; ?>
        <table class="my-3">


            <tr>
                <th class="" style="text-align: left;"> <?= $q['title']; ?> </th>

                <th class="text-end">
                    <a class="btn btn-dark"
                       href="/?page=single-category&name=<?= $q['title']; ?>&catid=<?= $q['id']; ?>">Accéder a la
                        catégorie</a>
                </th>


            </tr>


            <tr class="forum-topicview-row">
                <td>
                    <a data-bs-toggle="collapse" href="#collapse_Cat<?= $q['id']; ?>" role="button"
                       aria-expanded="false" aria-controls="collapse_Cat<?= $q['id']; ?>">
                        <p class="d-flex justify-content-between align-items-center">
                            <?= $q['title']; ?>

                        </p>
                    </a>
                </td>

                <td class="text-end">
                    <a data-bs-toggle="collapse" href="#collapse_Cat<?= $q['id']; ?>" role="button"
                       aria-expanded="false" aria-controls="collapse_Cat<?= $q['id']; ?>">Voir les posts <i
                                class="far fa-arrow-alt-circle-down"></i>
                    </a>
                </td>

            <tr>
                <?php while (($post = $querySub->fetch())) { ?>
            <tr class="forum-topicview-row collapse<?= $i == 1 ? 'show' : '' ?>" id="collapse_Cat<?= $q['id']; ?>"
                style="border-bottom:1px solid black;">
                <td style="background:#949494;padding-left: 5vw;">
                    <a href="/?page=single-subject&subid=<?= $post['id']; ?>"><?= $post['title']; ?></a>
                    <!--                    <p style="color: #2d3638">--><? //= $post['title']; ?><!--</p>-->

                </td>
                <td style="background:#949494;padding-left: 5vw;" class="text-left">
                    <p>Status : <?= $post['status']; ?></p>
                </td>
                <!--                <td style="background:#949494;padding-left: 5vw;"></td>-->

            <tr>
                <?php } ?>


        </table>


    <?php } ?>

    <div class="recent__post">
        <h2 class="text-left my-3" style="font-size: 4rem"> Post récents </h2>
        <div class="card__loop d-flex justify-content-between">


            <?php
            $recentspost = $database->prepare('SELECT * FROM subject LIMIT 3');
            $recentspost->execute();
            while (($rp = $recentspost->fetch())) {
                ?>
                <div class="card">
                    <div class="card-body">
                        <div class="card-title"><?= $rp['title'] ?></div>
                        <div class="card-content"><?= $rp['title'] ?></div>
                    </div>
                </div>

            <?php } ?>
        </div>

    </div>


    <div class="weather">
        <h2 class="text-left my-3" style="font-size: 4rem"> <?php
            $query = @unserialize(file_get_contents('http://ip-api.com/php/'));
            $cityactual = strtolower($query['city']);
            ?></h2>
        <h3 style="font-size: 2rem">Voici la météo du jour a <?= $cityactual ?> :</h3>


        <?php

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://community-open-weather-map.p.rapidapi.com/weather?q=$cityactual&lat=0&lon=0&id=2172797&lang=fr&units=metric&mode=xml%2C%20html",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: community-open-weather-map.p.rapidapi.com",
                "x-rapidapi-key: ab87421a43msh7648e08e514b943p1d41c7jsn1d4bbcb507aa"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        $arrayrep = json_decode($response, true);

        ?>
        <table class="my-3">


            <tr style="border-bottom: 2px solid #0DB8DE;">
                <th class="" style="text-align: left;">Température Actuel</th>
                <th class="" style="text-align: left;">Température Min</th>
                <th class="" style="text-align: left;">Température Max</th>
                <th class="" style="text-align: left;">Humidité</th>
                <th class="" style="text-align: left;">Aspect</th>
            </tr>


            <tr class="forum-topicview-row">
                <th class="" style="text-align: left;"><?= $arrayrep['main']['temp'] ?>°</th>
                <th class="" style="text-align: left;"> <?= $arrayrep['main']['temp_min'] ?>°</th>
                <th class="" style="text-align: left;"> <?= $arrayrep['main']['temp_max'] ?>°</th>
                <th class="" style="text-align: left;"> <?= $arrayrep['main']['humidity'] ?> %</th>
                <th class="" style="text-align: left;"> <?= $arrayrep['weather']['0']['description'] ?></th>
            </tr>


        </table>


    </div>
</div>
