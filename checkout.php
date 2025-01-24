<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "PHPint - Checkout";
$templateParams["nome"] = "payment.php";

if (isset($_SESSION["username"])) {
    $templateParams["carrello"] = $dbh->getCart($_SESSION["username"]);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
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

        $couponCode = $_POST['couponCode'] ?? '';

        if (isset($_POST['couponCode'])) {
            $couponCode = $_POST['couponCode'];
            $username = $_SESSION["username"];
            $totale = $templateParams["carrello"]["totale"];
            error_log("Totale iniziale: " . $totale);
            $discountAmount = $dbh->verifyAndApplyCoupon($username, $couponCode);
            error_log("Sconto del coupon: " . $discountAmount);

            if ($discountAmount != 0) {

                $scontoUsato = $discountAmount;
                $totale -= $discountAmount;
                error_log("Nuovo Totale: " . $totale);

                if ($totale < 0) {
                    $totale = 0;
                }

                $_SESSION["success_message"] = "Coupon applicato con successo! Hai risparmiato " . $discountAmount . " EUR.";
            }
        }

        foreach ($prodotti as $item) {
            $quantitaMagazzino = $dbh->getBeerDetails($item["codProdotto"])["quantitaMagazzino"];
            if ($item["quantita"] > $quantitaMagazzino) {
                $_SESSION["error_message"] = "La quantità richiesta per il prodotto '" . $dbh->getBeerDetails($item["codProdotto"])["nome"] . "' supera la disponibilità in magazzino.";
                header("Location: carrello.php");
                exit();
            }
        }

        try {
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
            $dbh->createNotification($_SESSION["username"], $_SESSION["venditore"]["username"], "Nuovo ordine ricevuto", "dettagliordine.php", $codiceOrdine);
            $dbh->createNotification($_SESSION["venditore"]["username"], $_SESSION["username"], "Grazie per aver effettuato l'ordine!", "dettagliordine.php", $codiceOrdine);
            if($totale > 20) {
                $couponCode = $dbh->createDiscountCoupon($username, $totale);
            }
            $_SESSION["success_message"] .= " Il tuo coupon di sconto del 10% è stato creato con successo! Codice: $couponCode";
            header("Location: simulation.php");
            exit();
        } catch (Exception $e) {
            die("Errore durante il salvataggio dell'ordine: " . $e->getMessage());
        }
    }
}

require 'template/base.php';
?>