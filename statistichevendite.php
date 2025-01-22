<?php
require_once 'bootstrap.php';


$templateParams["titolo"] = "PHPint - Statistiche";
$templateParams["nome"] = "generalstats.php";
$templateParams["info"] = $dbh->getAllSalesInfo();
$templateParams["clienti"] = $dbh->getTopClients();
$templateParams["miglioriBirre"] = $dbh->getBestBeers();

require 'template/base.php';
