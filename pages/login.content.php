<?php
/** @var PDO $database */
$database = require_once dirname(__FILE__) . '/../utils/database.utils.php';

$check = $database->prepare('SELECT * FROM user');
$check->execute();


while ($q = $check->fetch()) {

    if (isset($_POST['loginsubmit'])) {

        if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {

            $pseudo = htmlspecialchars($_POST['pseudo']);
            $password = htmlspecialchars($_POST['password']);


            $row = $check->rowCount();


            if ($q['password'] == $_POST['password'] && $q['pseudo'] == $_POST['pseudo'] && $q['role'] == 1) {
                $_SESSION['user'] = $q['pseudo'];
                $_SESSION['user_id'] = $q['id'];
                $_SESSION['user_admin'] = true;


                header("Location: ./?page=admin");
                die();

            }else if($q['password'] == $_POST['password'] && $q['pseudo'] == $_POST['pseudo'] && $q['role'] == 0){
                $_SESSION['user'] = $q['pseudo'];
                $_SESSION['user_id'] = $q['id'];
                $_SESSION['user_admin'] = false;


                header("Location: ./?page=home");
                die();
            }


        }
    }
}


?>

<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-2"></div>
        <div class="col-lg-6 col-md-8 login-box">
            <div class="col-lg-12 login-title">
                ADMIN PANEL
            </div>

            <div class="col-lg-12 login-form">
                <div class="col-lg-12 login-form">
                    <form method="POST" action="/?page=login">

                        <div class="form-group">
                            <label class="form-control-label">USERNAME</label>
                            <input type="text" name="pseudo" id="pseudo" class="form-control">
                        </div>
                        <div class="form-group">
                            <label lass="form-control-label" style="color: #6C6C6C;">PASSWORD</label>
                            <input name="password" id="password" type="password" class="form-control" i>
                        </div>

                        <div class="col-lg-12 loginbttm">
                            <div class="col-lg-6 login-btm login-text">
                                <!-- Error Message -->
                            </div>
                            <div class="col-lg-6 login-btm login-button">
                                <button type="submit" name="loginsubmit" class="btn btn-outline-primary">LOGIN</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
</div>






