<?php
require_once '../bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Leggi i dati inviati in formato JSON
    $input = json_decode(file_get_contents("php://input"), true);

    if (isset($input['codProdotto']) && isset($input['quantita'])) {
        $codProdotto = intval($input['codProdotto']);
        $quantita = intval($input['quantita']);

        try {
            // Aggiungi al magazzino usando la funzione dbh->addToStorage
            $success = $dbh->addToStorage($codProdotto, $quantita);

            if ($success) {
                echo json_encode(["success" => true]);
            } else {
                echo json_encode(["success" => false, "error" => "Errore durante l'aggiornamento del magazzino."]);
            }
        } catch (Exception $e) {
            error_log("Errore API aggiunta birra: " . $e->getMessage());
            echo json_encode(["success" => false, "error" => "Errore interno del server."]);
        }
    } else {
        echo json_encode(["success" => false, "error" => "Dati non validi."]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Metodo non supportato."]);
}
