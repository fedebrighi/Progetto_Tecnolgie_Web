<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "PHPint - Notifiche";
$templateParams["nome"] = "notifications.php";
$templateParams["notifiche"] = $dbh->getUnreadNotifications($_SESSION["username"]);

require 'template/base.php';
?>
