<?php
require_once '../bootstrap.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents("php://input"), true);
    if (isset($input['codProdotto'])) {
        $codProdotto = intval($input['codProdotto']);
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
    } else {
        echo "error";
    }
    exit;
}
