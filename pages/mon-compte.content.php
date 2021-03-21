<?php
/** @var PDO $database */
$database = require_once dirname(__FILE__) . '/../utils/database.utils.php';

$check = $database->prepare('SELECT * FROM user WHERE id = :uid');
$check->execute([
    'uid' =>  $_SESSION['user_id'],
]);
$data = $check->fetch();


?>

<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-2"></div>
        <div class="col-lg-6 col-md-8 login-box">
            <div class="col-lg-12 login-title">
                Mon Compte
            </div>

            <div class="col-lg-12 login-form">
                <div class="col-lg-12 login-form">
                    <div class="mon__compte d-flex align-items-center justify-content-center flex-column" style="color: white">
                        <div class="info">
                            pseudo : <?= $data['pseudo'] ?>
                        </div>
                        <div class="info">
                            Name : <?= $data['name'] ?>
                        </div>
                        <div class="info">
                            email : <?= $data['email'] ?>
                        </div>
                        <div class="info">
                            ROLE : <?= $data['role'] == 1 ? 'Administrateur' : 'utilisateurs' ; ?>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
</div>






