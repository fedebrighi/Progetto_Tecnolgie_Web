<?php
require_once 'bootstrap.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['codProdotto'])) {
    $codProdotto = intval($_POST['codProdotto']);

    try {
        // Elimina riferimenti al prodotto
        $dbh->deleteProductFromCart($codProdotto);
        $dbh->deleteProductFromOrder($codProdotto);
        $dbh->deleteProductFromReview($codProdotto);

        // Elimina il prodotto e le sue informazioni di vendita
        $productDeleted = $dbh->deleteProduct($codProdotto);
        $salesInfoDeleted = $dbh->deleteSalesInfo($codProdotto);

        if ($productDeleted && $salesInfoDeleted) {
            echo "success";
        } else {
            echo "error";
        }
    } catch (Exception $e) {
        // Registra l'errore e restituisci un messaggio
        error_log("Errore durante l'eliminazione del prodotto: " . $e->getMessage());
        echo "error";
    }
    exit; // Assicurati di terminare lo script
}
