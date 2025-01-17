<main>
    <!-- Intestazione -->
    <div class="container py-4">
        <div class="text-center mb-4">
            <?php $order = $templateParams["infoordine"]; ?>
            <h2 class="text-warning">Ordine # <?php echo $order["codiceOrdine"]; ?> </h2>

        </div>

        <!-- Sezione Dati Dell'Ordine -->
        <div class="border border-secondary rounded p-4 mb-5">
            <h4 class="text-warning mb-3"> Dati dell'ordine</h4>
            <p class="text-light"><strong> Data Ordine: <?php echo $order["dataOrdine"]; ?></strong> </p>
            <p class="text-light"><strong> Data di Spedizione: <?php echo $order["dataSpedizione"]; ?></strong></p>
            <p class="text-light"><strong> Data di Arrivo: <?php echo $order["dataArrivo"]; ?></strong></p>
            <p class="text-light"><strong> Pagamento utilizzato: <?php echo $order["tipoPagamento"]; ?></strong></p>
            <p class="text-light"><strong> Indirizzo: <?php echo $order["indirizzo"] . ", " . $order["citta"] . ", " . $order["cap"]; ?></strong></p>
            <p class="text-light"><strong> Tipo spedizione: <?php echo $order["tipo"]; ?></strong></p>
            <p class="text-light"><strong> Note: <?php echo $order["note"]; ?></strong></p>

            <div class="text-center">
                <h5 class="text-warning mb-3"><strong> Totale: <?php echo $order["totale"]; ?> €</strong></h5>
            </div>
        </div>
    </div>

    <!-- Ordine -->
    <div class="container py-4">
        <div class="row gy-3">
            <?php
            foreach ($templateParams["elementiordine"] as $item):
                $birra = $dbh->getBeerDetails($item["codProdotto"]);
            ?>
                <div class="col-12 d-flex align-items-center border-bottom border-secondary pb-3">
                    <img src="img/beers/<?php echo $birra["immagine"] ?>" alt="<?php echo $birra["nome"] ?>"
                        class="img-fluid me-3" style="width: 150px;" />
                    <div class="flex-grow-1">
                        <h6 class="m-0 fs-4"><?php echo $birra["nome"] ?></h6>
                        <p class="m-0 fs-5">alc. <?php echo $birra["alc"] ?>% vol</p>
                        <p class="m-0 fw-bold fs-5"><?php echo $birra["prezzo"] ?> €</p>
                    </div>
                    <div class="d-flex flex-column align-items-center">
                        <p class="m-0 fs-5">Quantità: <?php echo $item["quantita"] ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if ($templateParams["clienteLoggato"]): ?>
            <div class="d-flex justify-content-center mt-4">
                <button class="btn btn-outline-light" type="button"
                    onclick="window.location.href='catalogo_prodotti.php';">Continua a fare acquisti</button>
            </div>
        <?php endif; ?>

    </div>
</main>