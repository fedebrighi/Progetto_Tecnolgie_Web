    <main>
        <div class="container py-3">
            <div class="text-center mb-5">
                <h1 class="fs-1 font-sans-serif">PHPint</h1>
                <p class="fs-4 font-sans-serif">{WHEN CODING HITS HARD}</p>
            </div>

            <div class="row align-items-center">
                <!-- Colonna Carosello -->
                <div class="col-md-6 text-center">
                    <!-- Carousel -->
                    <div id="beerCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                        <div class="carousel-inner">
                            <?php foreach ($templateParams["birre"] as $index => $birra): ?>
                                <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                    <img src="img/beers/<?php echo $birra["immagine"]; ?>" class="d-block w-100 img-fluid" alt="<?php echo $birra["nome"]; ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#beerCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#beerCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>

                <!-- Colonna Pulsanti -->
                <div class="col-md-6">
                    <div class="d-grid gap-3">
                        <a <?php isActive("catalogo_prodotti.php");?> href="catalogo_prodotti.php" class="btn btn-custom btn-lg fw-bold">
                            <i class="bi bi-basket"></i> SCOPRI I NOSTRI PRODOTTI
                        </a>
                        <a href="abbinamenti.html" class="btn btn-custom btn-lg fw-bold">
                            <i class="bi bi-info-circle"></i> VISUALIZZA I CONSIGLI PER LE BIRRE
                        </a>
                        <a href="carrello.html" class="btn btn-custom btn-lg fw-bold">
                            <i class="bi bi-cart-check"></i> CONTROLLA LO STATO DEL TUO CARRELLO
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sezione Testimonianze -->
        <section class="bg-dark py-3">
            <div class="container text-center">
                <h2 class="fs-3 mb-4">COSA DICONO I NOSTRI CLIENTI</h2>
                <div class="row">
                    <div class="col-md-4">
                        <p class="fs-5">"Birre fantastiche e servizio impeccabile! 🔥"</p>
                        <small>- Mattia</small>
                    </div>
                    <div class="col-md-4">
                        <p class="fs-5">"Il miglior negozio di birre artigianali che abbia mai trovato."</p>
                        <small>- Monia</small>
                    </div>
                    <div class="col-md-4">
                        <p class="fs-5">"Birre fantastiche, perfette da abbinare ad una buona pizza! 🍕🍺 Qualità top,
                            consigliatissimo!"</p>
                        <small>- Dave</small>
                    </div>
                </div>
            </div>
        </section>
    </main>