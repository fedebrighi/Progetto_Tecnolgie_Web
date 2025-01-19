<main class="bg-dark">
    <div class="container py-5">
        <h1 class="text-warning text-center mb-4">Le tue Birre Preferite</h1>
        <div class="row gy-4">
            <?php if (empty($templateParams["preferiti"])): ?>
                <p class="text-light text-center">Non hai ancora aggiunto nessuna birra ai tuoi preferiti.</p>
            <?php else: ?>
                <?php foreach ($templateParams["preferiti"] as $birra): ?>
                    <div class="col-md-4 text-center">
                        <a href="prodotto_in_dettaglio.php?id=<?php echo $birra['codProdotto']; ?>">
                            <img src="img/beers/<?php echo $birra["immagine"]; ?>" alt="<?php echo $birra["nome"]; ?>"
                                class="img-fluid rounded">
                        </a>
                        <h5 class="text-warning mt-2"><?php echo $birra["nome"]; ?></h5>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <script src="js/favourites.js"></script>
</main>