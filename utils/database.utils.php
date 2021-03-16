<?php

try {
    $database = new PDO('mysql:dbname=php_forum_tp;host=localhost;charset=utf8', 'root');

    
} catch (Exception $exception) {
    var_dump($exception->getMessage());
    exit;
}

return $database;
