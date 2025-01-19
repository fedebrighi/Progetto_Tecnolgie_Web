<?php
require_once "../bootstrap.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Recupera i dati JSON inviati dalla richiesta
    $input = json_decode(file_get_contents("php://input"), true);
    error_log("entro nell'isset");
    if (isset($input["codiceOrdine"]) && isset($input["nuovoStato"]) && isset($input["data"])) {
        $codiceOrdine = intval($input["codiceOrdine"]);
        $nuovoStato = $input["nuovoStato"];
        $data = $input["data"];
        $dataPrevista = $input["dataPrevista"];
        try {
            error_log("chiamo update status");
            // Aggiorna lo stato dell'ordine nel database
            $result = $dbh->updateOrderStatus($codiceOrdine, $nuovoStato, $data, $dataPrevista);

            if ($result) {
                echo json_encode(["success" => true]);
            } else {
                echo json_encode(["success" => false, "error" => "Impossibile aggiornare lo stato."]);
            }
        } catch (Exception $e) {
            error_log("Errore durante l'aggiornamento dello stato dell'ordine: " . $e->getMessage());
            echo json_encode(["success" => false, "error" => "Errore interno del server."]);
        }
    } else {
        error_log("non entrato nell'isset");
        echo json_encode(["success" => false, "error" => "Dati non validi."]);
    }
}
