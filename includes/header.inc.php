<header class="l-head">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="navi navbar" role="navigation">
                    <a href="/?page=home" class="logo">
                        H Forum
                    </a>
                    <ul class="menu nav nav-pills navbar-right">
                        <li class="menu__item is-itemHov"><a href="/?page=home">HOME</a></li>
                        <?php if (isset($_SESSION['user'])) : ?>
                            <li class="menu__item is-itemHov"><a href="/?page=admin">ADMIN</a></li>
                        <?php endif; ?>
                        <?php if (!isset($_SESSION['user'])) : ?>
                            <li class="menu__item is-itemHov"><a href="/?page=login">CONNEXION</a></li>
                        <?php endif; ?>
                    </ul>
                    <?php if (isset($_SESSION['user'])) : ?>
                    <form action="/?page=admin" method="POST">
                        <input type="hidden" name="userId" value=UserId">
                        <button type="submit" name="disconnect" class="my-2 btn btn-danger">Se déconnecter de : <?=
                            $_SESSION['user']; ?>

                        </button>
                        <?php endif; ?>
                    </form>
                </nav>
            </div>
        </div>
    </div>
</header>
<div class="website-content">

