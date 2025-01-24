<?php
session_start();
define("UPLOAD_DIR", "./img/");
require_once("utils/functions.php");
require_once("db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "er_2phpint", 3306);
if (isset($_SESSION["username"])) {
    $notifiche = $dbh->getUnreadNotificationsNum($_SESSION["username"]);
}
