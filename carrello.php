<?php
require_once 'bootstrap.php';

// Base Template
$templateParams["titolo"] = "PHPint - Carrello";

// Controlla se l'utente è loggato
if (isUserLoggedIn()) {
    $templateParams["username"] = $_SESSION["username"];
} else {
    header("Location: login.php");
    exit();
}

// Recupera i prodotti nel carrello
$templateParams["elementicarrello"] = $dbh->getCartFromUser($templateParams["username"]);

// Rimozione prodotto dal carrello
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'remove') {
    // Recupera l'ID del prodotto dalla richiesta
    $data = json_decode(file_get_contents('php://input'), true);
    $productId = $data['productId'] ?? null;

    if ($productId) {
        // Rimuovi il prodotto dal carrello
        $dbh->removeProductFromCart($templateParams["username"], $productId);

        // Ricalcola il totale
        $updatedCart = $dbh->getCartFromUser($templateParams["username"]);
        $total = 0;
        foreach ($updatedCart as $item) {
            $beerDetails = $dbh->getBeerDetails($item["codProdotto"]);
            $total += $beerDetails["prezzo"] * $item["quantita"];
        }

        // Rispondi con un JSON per il client
        header('Content-Type: application/json');
        echo json_encode([
            "success" => $success,
            "total" => number_format($total, 2)
        ]);
        exit();
    }
}

// Mostra il template del carrello
require 'template/cart.php';
?>
