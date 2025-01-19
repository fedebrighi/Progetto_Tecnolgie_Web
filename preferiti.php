<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "PHPint - Preferiti";
$templateParams["nome"] = "template/like.php";

if (isset($_SESSION["username"])) {
    $templateParams["preferiti"] = $dbh->getUserFavorites($_SESSION["username"]);
} else {
    $templateParams["preferiti"] = [];
}

require 'template/base.php';
?>
