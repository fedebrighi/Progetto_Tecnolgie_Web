<main>
    <div class="container py-4">
        <div class="text-center mb-4">
            <h2 class="text-warning">Scopri le nostre birre artigianali!</h2>
            <p class="text-light">Scegli la tua preferita e abbinala ai tuoi momenti speciali.</p>
        </div>

        <div class="row row-cols-1 row-cols-md-2 g-4">
            <?php foreach ($templateParams["birre"] as $birra): ?>
            <div class="col">
                <div class="d-flex align-items-center border-bottom border-secondary pb-3">
                    <a href="prodotto_in_dettaglio.php?id=<?php echo $birra['codProdotto']; ?>">
                        <img src="img/beers/<?php echo $birra["immagine"]; ?>" alt="<?php echo $birra["nome"]; ?>" class="img-fluid me-3" style="width: 150px;">
                    </a>
                    <div>
                        <h6 class="m-0 fs-4"><?php echo $birra["nome"]; ?></h6>
                        <p class="m-0 fs-5">alc. <?php echo $birra["alc"]; ?> % vol</p>
                        <p class="m-0 fw-bold fs-5"><?php echo $birra["prezzo"]; ?> €</p>
                    </div>
                    <div class="ms-auto d-flex flex-column align-items-stretch">
                        <label for="quantity-<?php echo $birra['codProdotto']; ?>" class="form-label text-center">Quantità:</label>
                        <input type="number" id="quantity-<?php echo $birra['codProdotto']; ?>" class="form-control mb-2 text-center" min="1" value="1" style="height: 40px;">
                        <button class="btn btn-warning btn-sm mb-2" style="height: 40px; font-weight: bold; padding: 0.5rem;" onclick="addToCart(<?php echo $templateParams['codCarrello']['codCarrello']; ?>, <?php echo $birra['codProdotto']; ?>, 1)"> Aggiungi </button>
                        <a href="prodotto_in_dettaglio.php?id=<?php echo $birra['codProdotto']; ?>" class="btn btn-warning btn-sm text-center" style="height: 40px; font-weight: bold; padding: 0.5rem;">Scopri</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>

<script src="js/aggiungiAlCarrello.js"></script>
