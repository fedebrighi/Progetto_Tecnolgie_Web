<main>
    <div class="container py-4">
        <div class="text-center mb-4">
            <h1 class="text-warning">SCOPRI LE NOSTRE BIRRE ARTIGIANALI!</h1>
            <p>Scegli la tua preferita e abbinala ai tuoi momenti speciali.</p>
        </div>
        <div class="mb-4">
            <button id="toggleFilterButton" class="btn w-100 d-flex align-items-center justify-content-center" type="button"
                data-bs-toggle="collapse" data-bs-target="#filterContainer" aria-expanded="false"
                aria-controls="filterContainer">
                <i class="bi bi-filter me-2"></i>
                Mostra i Filtri Disponibili (Prezzo, Alcol, Gluten Free)
            </button>
        </div>
        <div class="collapse" id="filterContainer">
            <div class="card card-body bg-dark border-0">
                <div class="row">
                    <div class="mb-4">
                        <input type="text" id="searchBar" class="form-control" placeholder="Cerca birra..."
                            oninput="filterProducts()" />
                    </div>
                    <div class="col-12 col-md-4 mb-3">
                        <label class="form-label">Prezzo (€):</label>
                        <div class="range-slider">
                            <input type="range" id="priceMin" class="form-range" min="0" max="5" step="0.01" value="0"
                                oninput="updatePriceLabel(); filterProducts();" />
                            <input type="range" id="priceMax" class="form-range" min="0" max="5" step="0.01" value="5"
                                oninput="updatePriceLabel(); filterProducts();" />
                            <div class="d-flex justify-content-between">
                                <span id="priceMinLabel">0.00 €</span>
                                <span id="priceMaxLabel">5.00 €</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 mb-3">
                        <label class="form-label">Alcol (%):</label>
                        <div class="range-slider">
                            <input type="range" id="alcoholMin" class="form-range" min="0" max="10" step="0.1" value="0"
                                oninput="updateAlcoholLabel(); filterProducts();" />
                            <input type="range" id="alcoholMax" class="form-range" min="0" max="10" step="0.1"
                                value="10" oninput="updateAlcoholLabel(); filterProducts();" />
                            <div class="d-flex justify-content-between">
                                <span id="alcoholMinLabel">0.0%</span>
                                <span id="alcoholMaxLabel">10.0%</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 d-flex align-items-center">
                        <input type="checkbox" id="glutenFreeFilter" class="form-check-input me-2"
                            onchange="filterProducts()" />
                        <label for="glutenFreeFilter" class="form-check-label">GLUTEN FREE</label>
                    </div>
                </div>
            </div>
        </div>
        <div id="productList" class="row row-cols-1 row-cols-md-2 g-4">
            <?php foreach ($templateParams["birre"] as $birra): ?>
                <div class="col product-item text-warning" data-name="<?php echo strtolower($birra["nome"]); ?>"
                    data-glutenfree="<?php echo $birra["glutenFree"] ? 'glutenFree' : 'withGluten'; ?>"
                    data-price="<?php echo $birra["prezzo"]; ?>" data-alcohol="<?php echo $birra["alc"]; ?>">
                    <div class="d-flex align-items-center border-bottom border-secondary pb-3">
                        <form action="prodotto_in_dettaglio.php" method="POST" class="d-inline">
                            <input type="hidden" name="codice" value="<?php echo $birra['codProdotto']; ?>" />
                            <button type="submit" style="border: none; background: none; padding: 0;">
                                <img src="img/beers/<?php echo $birra["immagine"]; ?>" alt="<?php echo $birra["nome"]; ?>"
                                    class="img-fluid me-3" style="width: 150px;" />
                            </button>
                        </form>
                        <div>
                            <h3 class="m-0 fs-5"><?php echo $birra["nome"]; ?></h3>
                            <p class="m-0 fs-6">alc. <?php echo $birra["alc"]; ?> % vol, </p>
                            <div>
                                <p class="m-0 fw-bold fs-5"><?php echo $birra["prezzo"]; ?> €</p>
                            </div>
                            </div>
                        <div class="ms-auto d-flex flex-column align-items-stretch">
                            <?php if (!isset($_SESSION["username"]) || $_SESSION["username"] != $_SESSION["venditore"]["username"]): ?>
                                <div class="d-flex align-items-center mb-2">
                                    <label for="quantity-<?php echo $birra['codProdotto']; ?>" class="me-2">Quantità:</label>
                                    <input type="number" id="quantity-<?php echo $birra['codProdotto']; ?>"
                                        class="form-control text-center" min="1" value="1"
                                        style="width: 40px; height: 25px; border-radius: 50px; padding: 2px;" />
                                </div>
                                <?php if (!empty($_SESSION["username"])): ?>
                                    <button class="btn btn-sm mb-2" style="height: 40px; font-weight: bold; padding: 0.5rem;"
                                        onclick="addToCart(<?php echo $templateParams['codCarrello']['codCarrello']; ?>,
                                            <?php echo $birra['codProdotto']; ?>,
                                            document.getElementById('quantity-<?php echo $birra['codProdotto']; ?>').value)">
                                        <i class="bi bi-cart-plus"></i>
                                    </button>
                                <?php else: ?>
                                    <button onclick="window.location.href='login.php';" class="btn btn-sm mb-2"
                                        style="height: 40px; font-weight: bold; padding: 0.5rem;">
                                        <i class="bi bi-cart-plus"></i>
                                    </button>
                                <?php endif; ?>
                            <?php endif; ?>
                            <form action="prodotto_in_dettaglio.php" method="POST" class="mb-2">
                                <input type="hidden" name="codice" value="<?php echo $birra['codProdotto']; ?>" />
                                <button type="submit" class="btn btn-sm mb-2"
                                    style="height: 40px; font-weight: bold; padding: 0.5rem; width: 100%;">
                                    <i class="bi bi-info-circle"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <link href="css/filter_style.css" rel="stylesheet">
    <script src="js/filtro.js"></script>
    <script src="js/aggiungiAlCarrello.js"></script>
</main>