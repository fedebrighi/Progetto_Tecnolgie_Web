<main>
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-12 col-md-5 text-center">
                <img src="img/beers/<?php echo $templateParams["birra"]["immagine"]?>" alt="<?php echo $templateParams["birra"]["codProdotto"]?>" class="img-fluid mb-3" />
            </div>
            <div class="col-12 col-md-7">
                <h2><?php echo $templateParams["birra"]["nome"]?></h2>
                <p class="">ALC. <?php echo $templateParams["birra"]["alc"]?> % vol</p>
                <p>
                <?php echo $templateParams["birra"]["descrizione"]?>
                </p>
                <p><strong>INGREDIENTI: <?php foreach($templateParams["ingredienti"] as $ingr):
                        echo $ingr["ingrediente"].", ";
                    endforeach;?></strong></p>
                <div class="d-flex align-items-center mt-3">
                    <label for="quantity" class="form-label m-3">Quantità</label>
                    <input type="number" id="quantity" class="form-control me-3" style="width: 80px;" min="1" value="1" />
                    <button class="btn btn-warning btn-sm mb-2" style="height: 40px; font-weight: bold; padding: 0.5rem;" onclick="addToCart(<?php echo $templateParams['codCarrello']['codCarrello']; ?>, <?php echo $templateParams['birra']['codProdotto']; ?>, 1)"> Aggiungi </button>
                </div>
            </div>
    </div>
</main>

<script src="js/aggiungiAlCarrello.js"></script>