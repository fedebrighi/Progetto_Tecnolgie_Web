<main>
    <div class="container py-4">
        <div class="text-center mb-4">
            <h2 class="text-warning">Le nostre birre presenti!</h2>
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
                            <label for="quantity-<?php echo $birra['codProdotto']; ?>" class="form-label text-center">Quantità in magazzino: <?php echo $birra["quantitaMagazzino"]; ?></label>
                            <button class="btn btn-warning btn-sm mb-2" style="height: 40px; font-weight: bold; padding: 0.5rem;" data-bs-toggle="modal" data-bs-target="#aggiuntaBirraModal">Aggiungi</button>

                            <!-- Modale per aggiungere birre in magazzino -->
                            <div class="modal fade" id="aggiuntaBirraModal" tabindex="-1" aria-labelledby="aggiuntaBirraLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content bg-dark text-light">
                                        <div class="modal-header border-secondary">
                                            <h5 class="modal-title text-warning" id="aggiuntaBirraModalLabel">Aggiungi <?php echo $birra["nome"]; ?></h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="aggiuntaBirraForm">
                                                <div class="mb-3 text-center d-flex justify-content-center align-items-center" style="padding: 20px;">
                                                    <p class="m-0 fs-5 me-3">Inserisci nel magazzino: </p>
                                                    <input type="number" id="quantity-<?php echo $birra['codProdotto']; ?>"
                                                        class="form-control mb-2 text-center d-inline-block align-self-start mt-2" min="1" value="1"
                                                        style="height: 40px; width: 100px;">
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer border-secondary">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                                            <button type="button" class="btn btn-warning" onclick="salvaAggiunta()">Aggiungi</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-warning btn-sm mb-2 w-100" style="height: 40px; font-weight: bold; padding: 0.5rem;" data-bs-toggle="modal" data-bs-target="#modificaProdottoModal">
                                Modifica
                            </button>

                            <!-- Modale per modificare il prodotto -->
                            <div class="modal fade" id="modificaProdottoModal" tabindex="-1" aria-labelledby="modificaProdottoLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content bg-dark text-light">
                                        <div class="modal-header border-secondary">
                                            <h5 class="modal-title text-warning" id="modificaProdottoModalLabel">Modifica Prodotto</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="modificaProdottoForm">
                                                <div class="mb-3">
                                                    <label for="modificaNome" class="form-label">Nome</label>
                                                    <input type="text" class="form-control" id="modificaNome" value="<?php echo $birra["nome"]; ?>" required />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="modificaAlc" class="form-label">Percentuale Alcolica (%)</label>
                                                    <input type="number" class="form-control" id="modificaAlc" value="<?php echo $birra["alc"]; ?>" required />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="modificaPrezzo" class="form-label">Prezzo</label>
                                                    <input type="number" class="form-control" id="modificaPrezzo" value="<?php echo $birra["prezzo"]; ?>" required />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="modificaDescrizione" class="form-label">Descrizione</label>
                                                    <textarea class="form-control" name="descrizioneProdotto" id="descrizioneProdotto" rows="3" required><?php echo htmlspecialchars($birra["descrizione"]); ?></textarea>

                                                </div>
                                                <div class="mb-3">
                                                    <label for="modificaImmagine" class="form-label">Immagine</label>
                                                    <input type="text" class="form-control" id="modificaImmagine" value="<?php echo $birra["immagine"]; ?>" required />
                                                </div>


                                        </div>
                                        </form>

                                        <div class="modal-footer border-secondary">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                                            <button type="button" class="btn btn-warning" onclick="salvaModificheProdotto()">Salva Modifiche</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>