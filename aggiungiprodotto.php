<?php
require_once 'bootstrap.php';

//Base Template
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

    $codProdotto = $dbh->getNextCodProdotto();

    if (!$dbh->saveNewSalesInfo($codProdotto, $spesaUnitaria)) {
        echo "Errore nella creazione del prodotto!";
    }
    // Salva la nuova birra
    if ($dbh->saveNewBeer($codProdotto, $codProdotto, $nome, $alc, $descrizione, $listaIngredienti, $prezzo, $quantita, $immagine, $glutenFree)) {
        echo "<script>alert('Prodotto creato con successo!'); window.location.href = 'venditore.php';</script>";
        exit();
    } else {
        echo "Errore nella creazione del prodotto!";
        $dbh->deleteSalesInfo($codProdotto);
    }
}
require 'template/base.php';
