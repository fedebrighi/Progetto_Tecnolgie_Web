<main>
    <div class="container py-5">
        <!-- Titolo -->
        <div class="main-title text-center mb-5">
            <h1 class="display-1 fw-bold text-center">PHPint</h1>
            <p class="fs-2 fw-bold text-center">{WHEN CODING HITS HARD}</p>
        </div>

        <div class="row align-items-center">
            <!-- Colonna Carosello -->
            <div class="col-md-6 text-center mb-4 mb-md-0">
                <!-- Carousel -->
                <div id="beerCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                    <div class="carousel-inner">
                        <?php foreach ($templateParams["birre"] as $index => $birra): ?>
                            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                <img src="img/beers/<?php echo $birra["immagine"]; ?>"
                                    class="d-block w-100 img-fluid rounded" alt="<?php echo $birra["nome"]; ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#beerCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#beerCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <!-- Colonna Pulsanti -->
            <div class="col-md-6">
                <div class="d-grid gap-3">
                    <a href="paginainformativa.php" class="btn btn-custom btn-lg fw-bold">
                        <i class="bi bi-info-circle"></i> SCOPRI CHI SIAMO
                    </a>
                    <a <?php isActive("catalogo_prodotti.php"); ?> href="catalogo_prodotti.php"
                        class="btn btn-custom btn-lg fw-bold">
                        <i class="bi bi-basket"></i> SCOPRI I NOSTRI PRODOTTI
                    </a>
                    <a <?php isActive("carrello.php"); ?> href="carrello.php" class="btn btn-custom btn-lg fw-bold">
                        <i class="bi bi-cart-check"></i> CONTROLLA LO STATO DEL TUO CARRELLO
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Sezione Testimonianze -->
    <section class="bg-dark py-5">
        <div class="container text-center">
            <h2>COSA PENSANO I NOSTRI CLIENTI ?</h2>
            <div class="row g-4">
                <?php foreach ($templateParams["recensioni"] as $recensione): ?>
                    <div class="col-md-4">
                        <p>"<?php echo $recensione["testo"]; ?>"
                            <br />- <?php echo $recensione["username"]; ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <link href="css/carousel_style.css" rel="stylesheet">
</main>