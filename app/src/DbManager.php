<?php
function getDB() {
    $dsn = "mysql:host=localhost; dbname=bbs; charset=utf8";
    $db_user = "root";
    $db_pass = "";

    $db = new PDO($dsn, $db_user, $db_pass);
    return $db;
}
?>
