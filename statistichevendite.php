<?php
require_once 'bootstrap.php';


$templateParams["titolo"] = "PHPint - Statistiche";
$templateParams["nome"] = "generalstats.php";
$templateParams["info"] = $dbh->getAllSalesInfo();

require 'template/base.php';
