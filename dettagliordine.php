<?php
require_once 'bootstrap.php';


$templateParams["titolo"] = "PHPint - ORDINE #" . $_POST["codiceOrdine"];
$templateParams["infoordine"] = $dbh->getOrderByCod($_POST["codiceOrdine"]);
$templateParams["elementiordine"] = $dbh->getOrderElementsByCod($_POST["codiceOrdine"]);

require 'template/detail.php';
