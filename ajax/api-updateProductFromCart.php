<?php
require_once '../bootstrap.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$codProdotto = $data['codProdotto'] ?? null;
$quantita = $data['quantita'] ?? null;

if (!empty($codProdotto) && is_numeric($quantita)) {
    try {
        // Aggiorna la quantità nel database
        $dbh->updateCartQuantity($_SESSION['codCarrello'], $codProdotto, $quantita);

        // Ricalcola il totale del carrello
        $elementiCarrello = $dbh->getCart($_SESSION['codCarrello']);
        $totale = 0;
        foreach ($elementiCarrello as $item) {
            $birra = $dbh->getBeerDetails($item['codProdotto']);
            $totale += $birra['prezzo'] * $item['quantita'];
        }

        echo json_encode(['success' => true, 'totale' => number_format($totale, 2)]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Parametri non validi']);
}
