<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "PHPint - Aggiungi Birra";
$templateParams["nome"] = "addnewbeer.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['nomeProdotto'], $_POST['percentualeAlcolica'], $_POST['descrizioneProdotto'], $POST['listaIngredienti'], $_POST['prezzoProdotto'], $_POST['quantitaProdotto'], $_POST['immagineProdotto'])) {
        echo "Errore nella creazione del prodotto!";
    }

    $nome = $_POST['nomeProdotto'];
    $alc = $_POST['percentualeAlcolica'];
    $descrizione = $_POST['descrizioneProdotto'];
    $listaIngredienti = $_POST['listaIngredienti'];
    $prezzo = $_POST['prezzoProdotto'];
    $quantita = $_POST['quantitaProdotto'];
    $immagine = $_FILES["immagineProdotto"]["name"];
    $spesaUnitaria = $_POST['spesaUnitaria'];
    $glutenFree = $_POST['glutenFree'];
    if ($glutenFree != 1) {
        $glutenFree = 0;
    }

    $codProdotto = $dbh->getNextCod('PRODOTTO', 'codProdotto');

    if (!$dbh->saveNewSalesInfo($codProdotto, $spesaUnitaria)) {
        echo "Errore nella creazione del prodotto!";
    }

    if ($dbh->saveNewBeer($codProdotto, $codProdotto, $nome, $alc, $descrizione, $listaIngredienti, $prezzo, $quantita, $immagine, $glutenFree)) {
        $dbh->createNotificationBroadcast($_SESSION["username"], "Nuova birra aggiunta al catalogo!", "prodotto_in_dettaglio.php", $codProdotto);
        header("Location: venditore.php");
        exit();
    } else {
        echo "Errore nella creazione del prodotto!";
        $dbh->deleteSalesInfo($codProdotto);
    }
}
require 'template/base.php';
