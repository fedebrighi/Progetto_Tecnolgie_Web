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
        $totale = $templateParams["carrello"]["totale"]; // Calcolato dal carrello
        try {
            // Chiama la funzione salvaOrdine
            $dbh->salvaOrdine(
                $username,
                $indirizzo,
                $citta,
                $cap,
                $note,
                $tipoSpedizione,
                $tipoPagamento,
                $totale,
                $templateParams["carrello"]["prodotti"]
            );

            // Reindirizza alla pagina di conferma
            header("Location: userarea.php");
            exit();
        } catch (Exception $e) {
            die("Errore durante il salvataggio dell'ordine: " . $e->getMessage());
        }
    }
}
require 'template/base.php';
?>