<?php
require_once 'bootstrap.php';

// Reindirizza il venditore alla pagina venditore
if ($dbh->getSeller()["username"] === $_SESSION["username"]) {
    header("Location: venditore.php");
    exit();
}

// Verifica se l'utente è loggato
if (!isUserLoggedIn()) {
    header("Location: homepage.php");
    exit();
}


// Base Template
$templateParams["titolo"] = "PHPint - Area Personale";
$templateParams["nome"] = "userarea.php";

// Recupera i dati del cliente e degli ordini
$templateParams["cliente"] = $dbh->getClientByUsername($_SESSION["username"]);
$templateParams["ordini"] = $dbh->getOrdersByClientUsername($_SESSION["username"]);
$templateParams["prodottiNonRecensiti"] = $dbh->getProdottiNonRecensiti($_SESSION["username"]);
$templateParams["coupons"] = $dbh->getClientCoupons($_SESSION["username"]);


// Gestione recensioni
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["codProdotto"], $_POST["valutazione"])) {
    $codProdotto = $_POST["codProdotto"];
    $valutazione = intval($_POST["valutazione"]); // Converte la valutazione in intero
    $testo = isset($_POST["testo"]) ? trim($_POST["testo"]) : null; // Rimuove spazi inutili
    $username = $_SESSION["username"];


    // Validazione input
    if ($valutazione < 1 || $valutazione > 5) {
        $templateParams["errore"] = "La valutazione deve essere compresa tra 1 e 5.";
    } else {
        try {
            $dbh->addReview($username, $codProdotto, $valutazione, $testo);
            $templateParams["successo"] = "Recensione aggiunta con successo!";
        } catch (Exception $e) {
            $templateParams["errore"] = "Errore durante l'aggiunta della recensione: " . $e->getMessage();
        }
    }
}

// Includi il template di base
require 'template/base.php';
?>
