<?php

session_start();

require_once dirname(__FILE__) . '/includes/top.inc.php';

if (isset($_GET['page'])) {
    $pageFilename = dirname(__FILE__) . '/pages/' . $_GET['page'] . '.content.php';
    $pageFilenameForum = dirname(__FILE__) . '/pages/forum/' . $_GET['page'] . '.content.php';

    if (file_exists($pageFilename)) {
        require_once $pageFilename;

    } elseif (file_exists($pageFilenameForum)) {
        require_once $pageFilenameForum;
    } else {
        require_once dirname(__FILE__) . '/pages/404.content.php';
    }
} else {
    require_once dirname(__FILE__) . '/pages/home.content.php';
}

require_once dirname(__FILE__) . '/includes/bottom.inc.php';
