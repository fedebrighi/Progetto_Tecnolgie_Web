<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "PHPint - Checkout";
$templateParams["nome"] = "payment.php";

if (isset($_SESSION["username"])) {
    // Carica il carrello dell'utente
    $templateParams["carrello"] = $dbh->getCart($_SESSION["username"]);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Ottieni i dati della richiesta POST
        $username = $_SESSION["username"];
        $indirizzo = $_POST["indirizzo"];
        $citta = $_POST["citta"];
        $cap = $_POST["cap"];
        $note = $_POST["note"] ?? null;
        $tipoSpedizione = $_POST["spedizione"];
        $tipoPagamento = $_POST["pagamento"];
        $totale = $templateParams["carrello"]["totale"];
        $prodotti = $dbh->getCartFromUser($username);
        $scontoUsato = 0;

        // Verifica se l'utente ha inserito un codice coupon
        $couponCode = $_POST['couponCode'] ?? ''; // codice del coupon inserito dall'utente

        // Se c'è un codice coupon, verifica se è valido e applicalo
        if (isset($_POST['couponCode'])) {
            $couponCode = $_POST['couponCode'];
            $username = $_SESSION["username"];
            $totale = $templateParams["carrello"]["totale"];
            error_log("Totale iniziale: " . $totale);

            // Verifica e applica il coupon
            $discountAmount = $dbh->verifyAndApplyCoupon($username, $couponCode);
            error_log("Sconto del coupon: " . $discountAmount);

            // Se il coupon è valido e c'è uno sconto
            if ($discountAmount != 0) {
                // Applica lo sconto al totale
                $scontoUsato = $discountAmount;
                $totale -= $discountAmount;
                error_log("Nuovo Totale: " . $totale);

                // Evita il totale negativo
                if ($totale < 0) {
                    $totale = 0;
                }

                $_SESSION["success_message"] = "Coupon applicato con successo! Hai risparmiato " . $discountAmount . " EUR.";
            }
        }

        // Verifica la disponibilità dei prodotti in magazzino
        foreach ($prodotti as $item) {
            $quantitaMagazzino = $dbh->getBeerDetails($item["codProdotto"])["quantitaMagazzino"];
            if ($item["quantita"] > $quantitaMagazzino) {
                $_SESSION["error_message"] = "La quantità richiesta per il prodotto '" . $dbh->getBeerDetails($item["codProdotto"])["nome"] . "' supera la disponibilità in magazzino.";
                header("Location: carrello.php");
                exit();
            }
        }

        try {
            // Salva l'ordine
            $codiceOrdine = $dbh->salvaOrdine(
                $username,
                $indirizzo,
                $citta,
                $cap,
                $note,
                $tipoSpedizione,
                $tipoPagamento,
                $totale,
                $prodotti,
                $scontoUsato
            );
            $dbh->markCouponAsUsed($couponCode);
            // Crea notifiche per il venditore e per l'utente
            $dbh->createNotification($_SESSION["username"], $_SESSION["venditore"]["username"], "Nuovo ordine ricevuto", "dettagliordine.php", $codiceOrdine);
            $dbh->createNotification($_SESSION["venditore"]["username"], $_SESSION["username"], "Grazie per aver effettuato l'ordine!", "dettagliordine.php", $codiceOrdine);
            if($totale > 20) {
                $couponCode = $dbh->createDiscountCoupon($username, $totale);
            }

            // Aggiungi un messaggio di conferma del coupon
            $_SESSION["success_message"] .= " Il tuo coupon di sconto del 10% è stato creato con successo! Codice: $couponCode";
            // Reindirizza alla pagina di conferma dell'ordine
            header("Location: simulation.php");
            exit();
        } catch (Exception $e) {
            die("Errore durante il salvataggio dell'ordine: " . $e->getMessage());
        }
    }
}

require 'template/base.php';
?>