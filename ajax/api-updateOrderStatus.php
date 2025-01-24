<?php
require_once "../bootstrap.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $input = json_decode(file_get_contents("php://input"), true);
    if (isset($input["codiceOrdine"]) && isset($input["nuovoStato"]) && isset($input["data"])) {
        $codiceOrdine = intval($input["codiceOrdine"]);
        $nuovoStato = $input["nuovoStato"];
        $data = $input["data"];
        $dataPrevista = $input["dataPrevista"];
        $cliente = $dbh->getClientUsernameFromOrder($codiceOrdine);
        try {
            $result = $dbh->updateOrderStatus($codiceOrdine, $nuovoStato, $data, $dataPrevista);
            $dbh->createNotification($_SESSION["username"], $cliente["username"], "Stato ordine aggiornato", "dettagliordine.php", $codiceOrdine);
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
        echo json_encode(["success" => false, "error" => "Dati non validi."]);
    }
}
