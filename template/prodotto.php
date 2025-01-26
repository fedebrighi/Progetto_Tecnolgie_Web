<main>
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-12 col-md-5 text-center">
                <img src="img/beers/<?php echo $templateParams["birra"]["immagine"] ?>"
                    alt="<?php echo $templateParams["birra"]["codProdotto"] ?>"
                    class="img-fluid mb-3 position-sticky top-0" />
            </div>

            <div class="col-12 col-md-7">
                <h1><?php echo $templateParams["birra"]["nome"] ?></h1>
                <p>ALC. <?php echo $templateParams["birra"]["alc"] ?> % vol</p>
                <p><?php echo $templateParams["birra"]["descrizione"] ?></p>
                <h2><strong>INGREDIENTI: <span
                            style="font-size: 0.8em;"><?php echo $templateParams["birra"]["listaIngredienti"]; ?></span></strong>
                </h2>
                <p>Prezzo: €<?php echo $templateParams["birra"]["prezzo"] ?></p>

                <div class="d-flex flex-column gap-3 mt-4">
                    <?php if (empty($_SESSION["username"])): ?>
                        <button onclick="window.location.href='login.php';" class="btn mt-3"
                            style="font-weight: bold; padding: 0.5rem; width: 100%;">
                            <em class="bi bi-cart me-2"></em> Aggiungi al Carrello
                        </button>
                    <?php elseif ($templateParams["isClientLogged"]):  ?>
                        <div class="d-flex align-items-center">
                            <label for="quantity-<?php echo $templateParams['birra']['codProdotto']; ?>"
                                class="form-label mb-0 me-2 fs-3">Quantità da aggiungere al tuo carrello:</label>
                            <input type="number" id="quantity-<?php echo $templateParams['birra']['codProdotto']; ?>"
                                class="form-control" style="width: 70px; height: 35px; border-radius: 5px;" min="1"
                                value="1" />
                        </div>
                        <button class="btn mt-3" style="font-weight: bold; padding: 0.5rem; width: 100%;"
                            onclick="addToCart(<?php echo $templateParams['codCarrello']['codCarrello']; ?>,
                            <?php echo $templateParams['birra']['codProdotto']; ?>,
                            document.getElementById('quantity-<?php echo $templateParams['birra']['codProdotto']; ?>').value)">
                            <em class="bi bi-cart me-2"></em> Aggiungi al Carrello
                        </button>

                    <?php endif; ?>

                    <?php if (empty($_SESSION["username"])): ?>
                        <button onclick="window.location.href='login.php';" class="btn mt-3"
                            style="font-weight: bold; padding: 0.5rem; width: 100%;">
                            <em class="bi bi-heart me-2"></em> Aggiungi ai Preferiti
                        </button>
                    <?php elseif ($templateParams["isClientLogged"]): ?>
                        <button id="btn-favorite-<?php echo $templateParams['birra']['codProdotto']; ?>" class="btn mt-3"
                            style="font-weight: bold; padding: 0.5rem; width: 100%;"
                            onclick="toggleFavorite(<?php echo $templateParams['birra']['codProdotto']; ?>)">
                            <em id="icon-favorite-<?php echo $templateParams['birra']['codProdotto']; ?>"
                                class="bi <?php echo (isset($templateParams["preferiti"]) && in_array($templateParams["birra"]["codProdotto"], $templateParams["preferiti"])) ? 'bi-heart-fill' : 'bi-heart'; ?>"></em>
                            <span id="favorite-text-<?php echo $templateParams['birra']['codProdotto']; ?>">
                                <?php echo (isset($templateParams["preferiti"]) && in_array($templateParams["birra"]["codProdotto"], $templateParams["preferiti"])) ? 'Rimuovi dai preferiti' : 'Aggiungi ai preferiti'; ?>
                            </span>
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="mt-5 border border-secondary rounded p-4">
            <h2 class="text-warning">SEZIONE RECENSIONI SU QUESTO PRODOTTO: </h2>
            <?php if (!empty($templateParams["recensioni"])): ?>
                <ul class="list-unstyled">
                    <?php foreach ($templateParams["recensioni"] as $recensione): ?>
                        <li class="border-bottom pb-3 mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <em
                                        class="bi <?php echo $i <= $recensione["valutazione"] ? 'bi-star-fill text-warning' : 'bi-star text-secondary'; ?>"></em>
                                <?php endfor; ?>
                            </div>
                            <p class="mb-2"><?php echo htmlspecialchars($recensione["testo"] ?: "Nessun commento."); ?></p>
                            <small class="text-muted">Da <?php echo htmlspecialchars($recensione["username"]); ?></small>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Non ci sono recensioni per questa birra. Sii il primo a lasciare una recensione!</p>
            <?php endif; ?>
        </div>
    </div>
</main>

<script src="js/aggiungiAlCarrello.js"></script>
<script src="js/favourites.js"></script>