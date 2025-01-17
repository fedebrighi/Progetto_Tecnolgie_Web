<?php
require_once 'bootstrap.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['codProdotto'])) {
    $codProdotto = intval($_POST['codProdotto']);

    try {
        $dbh->deleteProductFromCart($codProdotto);
        $dbh->deleteProductFromOrder($codProdotto);
        $dbh->deleteProductFromReview($codProdotto);

        $productDeleted = $dbh->deleteProduct($codProdotto);
        $salesInfoDeleted = $dbh->deleteSalesInfo($codProdotto);

        if ($productDeleted && $salesInfoDeleted) {
            echo "success";
        } else {
            echo "error";
        }
    } catch (Exception $e) {

        error_log("Errore durante l'eliminazione del prodotto: " . $e->getMessage());
        echo "error";
    }
    exit;
}
