<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "PHPint - Checkout";
$templateParams["nome"] = "payment.php";

if (isset($_SESSION["username"])) {
    $templateParams["carrello"] = $dbh->getCart($_SESSION["username"]);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $username = $_SESSION["username"];
        $indirizzo = $_POST["indirizzo"];
        $citta = $_POST["citta"];
        $cap = $_POST["cap"];
        $note = $_POST["note"] ?? null;
        $tipoSpedizione = $_POST["spedizione"];
        $tipoPagamento = $_POST["pagamento"];
        $totale = $templateParams["carrello"]["totale"];
        try {
            $dbh->salvaOrdine(
                $username,
                $indirizzo,
                $citta,
                $cap,
                $note,
                $tipoSpedizione,
                $tipoPagamento,
                $totale,
                $dbh->getCartFromUser($username)
            );
            $dbh->createNotification($_SESSION["username"], $_SESSION["venditore"]["username"], "Nuovo ordine ricevuto");
            header("Location: simulation.php");
            exit();
        } catch (Exception $e) {
            die("Errore durante il salvataggio dell'ordine: " . $e->getMessage());
        }
    }
}
require 'template/base.php';
?>