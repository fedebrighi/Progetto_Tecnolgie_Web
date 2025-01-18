<main class="bg-dark text-light">
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
                <div class="col-12 d-flex align-items-center border-bottom border-secondary pb-3 carrello-item"
                    data-id="<?php echo $item['codProdotto']; ?>">
                    <img src="img/beers/<?php echo $birra["immagine"] ?>" alt="<?php echo $birra["nome"] ?>"
                        class="img-fluid me-3" style="width: 80px;" />
                    <div class="flex-grow-1">
                        <h6 class="m-0"><?php echo $birra["nome"] ?></h6>
                        <p class="m-0">alc. <?php echo $birra["alc"] ?>% vol</p>
                        <p class="m-0 fw-bold prezzo"><?php echo $birra["prezzo"] ?> €</p>
                    </div>
                    <div class="d-flex flex-column align-items-center">
                        <div class="d-flex align-items-center mb-2">
                            <label for="quantita-<?php echo $item['codProdotto']; ?>" class="me-2">Quantità:</label>
                            <input type="number" id="quantita-<?php echo $item['codProdotto']; ?>" class="form-control form-control-sm text-center quantita" 
                                min="1" value="<?php echo $item['quantita']; ?>" style="width: 40px; height: 25px; border-radius: 50px; padding: 2px;"
                                onchange="aggiornaQuantitaCartAPI(<?php echo $item['codProdotto']; ?>, this.value)">
                        </div>
                        <button class="btn btn-warning btn-sm w-100 remove-from-cart"
                            onclick="removeFromCart(<?php echo $templateParams['codCarrello']['codCarrello']; ?>,<?php echo $item['codProdotto']; ?>)">
                            Rimuovi
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Sezione Totale -->
        <div class="mt-4 text-end">
            <h5 class="text-light">Totale: <span id="totale-carrello"
                    class="text-warning"><?php echo number_format($total, 2); ?> €</span></h5>
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
    <script src="js/rimuoviDalCarrello.js"></script>
    <script src="js/spesaTotale.js"></script>
</main>