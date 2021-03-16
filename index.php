<?php

session_start();

require_once dirname(__FILE__) . '/includes/top.inc.php';

if (isset($_GET['page'])) {
    $pageFilename = dirname(__FILE__) . '/pages/' . $_GET['page'] . '.content.php';

    if (file_exists($pageFilename)) {
        require_once $pageFilename;
    } else {
        require_once dirname(__FILE__) . '/pages/404.content.php';
    }
} else {
    require_once dirname(__FILE__) . '/pages/home.content.php';
}

require_once dirname(__FILE__) . '/includes/bottom.inc.php';
