<?php
require_once '../bootstrap.php';
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);
error_log("Dati ricevuti: " . print_r($data, true));
$codCarrello = $data["codCarrello"] ?? null;
$codProdotto = $data["codProdotto"] ?? null;
$quantita = $data["quantita"] ?? null;
if (!empty($codCarrello) && !empty($codProdotto) && !empty($quantita)) {
    try {
        $success = $dbh->addProductToCart($codCarrello, $codProdotto, (int)$quantita);
        $totale = 0;
        $elementiCarrello = $dbh->getCartFromUser($_SESSION['username']);
        foreach ($elementiCarrello as $item) {
            $birra = $dbh->getBeerDetails($item['codProdotto']);
            $totale += $birra['prezzo'] * $item['quantita'];
            $dbh->updateTotalCart($totale, $_SESSION['username']);
        }
        echo json_encode(['success' => $success]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Parametri mancanti o non validi']);
}
