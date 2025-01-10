<?php
require_once 'bootstrap.php';


$templateParams["titolo"] = "PHPint - ORDINE #" . $_GET["codiceOrdine"];
$templateParams["infoordine"] = $dbh->getOrderByCod($_GET["codiceOrdine"]);
$templateParams["elementiordine"] = $dbh->getOrderElementsByCod($_GET["codiceOrdine"]);

require 'template/detail.php';
?>