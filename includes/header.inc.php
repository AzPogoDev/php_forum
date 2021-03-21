<header class="l-head">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="navi navbar" role="navigation">
                    <a href="/?page=home" class="logo">
                        H Forum
                    </a>
                    <ul class="menu nav nav-pills navbar-right align-items-center">
                        <li class="menu__item is-itemHov"><a href="/?page=home">HOME</a></li>
                        <?php if (isset($_SESSION['user']) && $_SESSION['user_admin'] == true ) : ?>
                            <li class="menu__item is-itemHov"><a href="/?page=admin">ADMIN</a></li>
                            <li class="menu__item is-itemHov"><a href="/?page=mon-compte">MON COMPTE</a></li>

                        <?php endif; ?>
                        <?php if (isset($_SESSION['user']) && $_SESSION['user_admin'] == false) : ?>

                            <li class="menu__item is-itemHov"><a href="/?page=mon-compte">MON COMPTE</a></li>

                        <?php endif; ?>
                        <?php if (!isset($_SESSION['user'])) : ?>
                            <li class="menu__item is-itemHov"><a href="/?page=login">CONNEXION</a></li>
                        <?php endif; ?>
                        <li class="menu__item is-itemHov"><a href="#" data-bs-toggle="modal" class="modallink"
                                                             data-bs-target="#exampleModal">
                                CHUCK NORRIS
                            </a></li>


                    </ul>
                    <?php if (isset($_SESSION['user'])) : ?>


                        <form action="/?page=admin" method="POST">
                            <input type="hidden" name="userId" value=UserId">
                            <button type="submit" name="disconnect" class="my-2 btn btn-danger">Se déconnecter de : <?=
                                $_SESSION['user']; ?>

                            </button>

                        </form>
                    <?php endif; ?>
                </nav>
            </div>
        </div>
    </div>
</header>
<?php

include './partial/modal.php';
?>
<div class="website-content">

