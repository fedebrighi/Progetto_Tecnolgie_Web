<body>
    <!-- Carrello -->
    <div class="container py-4">
        <!-- Scritta introduttiva -->
        <div class="text-center mb-4">
            <h2 class="text-warning">Ecco il tuo carrello!</h2>
            <p class="text-light">Controlla i prodotti selezionati e procedi al pagamento per completare l'acquisto.</p>
        </div>
        <div class="row gy-3">
            <?php
            $total = 0; // Inizializza il totale
            foreach ($templateParams["elementicarrello"] as $item):
                $birra = $dbh->getBeerDetails($item["codProdotto"]);
                $itemTotal = $birra["prezzo"] * $item["quantita"];
                $total += $itemTotal; // Somma il prezzo totale del prodotto
                ?>
                <div class="col-12 d-flex align-items-center border-bottom border-secondary pb-3">
                    <img src="img/beers/<?php echo $birra["immagine"] ?>" alt="<?php echo $birra["nome"] ?>"
                        class="img-fluid me-3" style="width: 80px;" />
                    <div class="flex-grow-1">
                        <h6 class="m-0"><?php echo $birra["nome"] ?></h6>
                        <p class="m-0">alc. <?php echo $birra["alc"] ?>% vol</p>
                        <p class="m-0 fw-bold"><?php echo $birra["prezzo"] ?> €</p>
                    </div>
                    <div class="d-flex flex-column align-items-center">
                        <input type="number" id="quantity<?php echo $item["quantita"]; ?>"
                            class="form-control mb-2 text-center" min="1" value="<?php echo $item["quantita"] ?>"
                            style="height: 40px;">
                        <button class="btn btn-warning btn-sm w-100 remove-from-cart"
                            data-id="<?php echo $item['codProdotto']; ?>">
                            Rimuovi dal carrello
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Sezione Totale -->
        <div class="mt-4 text-end">
            <h5 class="text-light">Totale: <span class="text-warning"><?= number_format($total, 2) ?> €</span></h5>
        </div>

        <!-- Pulsanti -->
        <div class="d-flex justify-content-between mt-4">
            <button class="btn btn-outline-light" type="button"
                onclick="window.location.href='catalogo_prodotti.php';">Continua a fare acquisti</button>

            <?php if (!empty($templateParams["elementicarrello"])): ?>
                <button class="btn btn-warning" type="button" onclick="window.location.href='checkout.php';">Procedi al
                    pagamento</button>
            <?php else: ?>
                <button class="btn btn-secondary" type="button" disabled>Carrello vuoto</button>
            <?php endif; ?>
        </div>
    </div>
    <script src="js/rimuoviCarrello.js"></script>
</body>