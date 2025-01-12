<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "PHPint - Aggiungi Birra";
$templateParams["nome"] = "addnewbeer.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['nomeProdotto'], $_POST['percentualeAlcolica'], $_POST['descrizioneProdotto'], $_POST['prezzoProdotto'], $_POST['quantitaProdotto'], $_POST['immagineProdotto'])) {
        die("Errore: Tutti i campi del modulo sono obbligatori!");
    }

    $nome = $_POST['nomeProdotto'];
    $alc = $_POST['percentualeAlcolica'];
    $descrizione = $_POST['descrizioneProdotto'];
    $prezzo = $_POST['prezzoProdotto'];
    $quantita = $_POST['quantitaProdotto'];
    $immagine = $_POST['immagineProdotto'];
    $spesaUnitaria = $_POST['spesaUnitaria'];

    $codProdotto = $dbh->getNextCodProdotto();

    if (!$dbh->saveNewSalesInfo($codProdotto, $spesaUnitaria)) {
        echo "Errore nella creazione del prodotto!";
    }
    // Salva la nuova birra
    if ($dbh->saveNewBeer($codProdotto, $codProdotto, $nome, $alc, $descrizione, $prezzo, $quantita, $immagine)) {
        header("Location: venditore.php"); // Reindirizza alla area venditore
        exit();
    } else {
        echo "Errore nella creazione del prodotto!";
    }
}
require 'template/base.php';
