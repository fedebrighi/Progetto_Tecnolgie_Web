<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "PHPint - Preferiti";
$templateParams["nome"] = "infoPage.php";

$templateParams["miglioriBirre"] = $dbh->getBestBeers();

require 'template/base.php';
