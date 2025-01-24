<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "PHPint - Home";
$templateParams["nome"] = "home.php";
$templateParams["birre"] = $dbh->getAllBeers();
$templateParams["recensioni"] = $dbh->getRandomReviews(3);

require 'template/base.php';
?>
