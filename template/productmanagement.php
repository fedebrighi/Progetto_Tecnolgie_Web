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
                            <h3 class="m-0 fs-5 text-warning"><?php echo $birra["nome"]; ?></h3>
                            <p class="m-0 fs-6">alc. <?php echo $birra["alc"]; ?> % vol</p>
                            <p class="m-0 fw-bold fs-6"><?php echo $birra["prezzo"]; ?> €</p>
                        </div>
                        <div class="ms-auto d-flex flex-column align-items-stretch">
                            <label for="quantity-<?php echo $birra['codProdotto']; ?>" class="form-label text-center">Quantità in magazzino: <?php echo $birra["quantitaMagazzino"]; ?></label>
                            <button class="btn btn-sm mb-2" style="height: 40px; font-weight: bold; padding: 0.5rem;"
                                data-bs-toggle="modal" data-bs-target="#aggiuntaBirraModal-<?php echo $birra['codProdotto']; ?>">Aggiungi</button>
                            <div class="modal fade" id="aggiuntaBirraModal-<?php echo $birra['codProdotto']; ?>" tabindex="-1" aria-labelledby="aggiuntaBirraModalLabel-<?php echo $birra['codProdotto']; ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content bg-dark">
                                        <div class="modal-header border-secondary">
                                            <h5 class="modal-title text-warning" id="aggiuntaBirraModalLabel-<?php echo $birra['codProdotto']; ?>">Aggiungi <?php echo $birra["nome"]; ?></h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="aggiuntaBirraForm-<?php echo $birra['codProdotto']; ?>">
                                                <div class="mb-3 text-center d-flex justify-content-center align-items-center" style="padding: 20px;">
                                                    <p class="m-0 fs-5 me-3">Inserisci nel magazzino: </p>
                                                    <input type="number" id="quantity-<?php echo $birra['codProdotto']; ?>"
                                                        class="form-control mb-2 text-center d-inline-block align-self-start mt-2" min="1" value="1"
                                                        style="height: 40px; width: 100px;">
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer border-secondary">
                                            <button type="button" class="btn" data-bs-dismiss="modal">Annulla</button>
                                            <button type="button" class="btn" onclick="salvaAggiunta('<?php echo $birra['codProdotto']; ?>')">Aggiungi</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-sm mb-2 w-100" style="height: 40px; font-weight: bold; padding: 0.5rem;"
                                data-bs-toggle="modal" data-bs-target="#modificaProdottoModal-<?php echo $birra['codProdotto']; ?>">Modifica</button>
                            <div class="modal fade" id="modificaProdottoModal-<?php echo $birra['codProdotto']; ?>" tabindex="-1" aria-labelledby="modificaProdottoModalLabel-<?php echo $birra['codProdotto']; ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content bg-dark">
                                        <div class="modal-header border-secondary">
                                            <h5 class="modal-title text-warning" id="modificaProdottoModalLabel-<?php echo $birra['codProdotto']; ?>">Modifica <?php echo $birra["nome"]; ?></h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="modificaProdottoForm-<?php echo $birra['codProdotto']; ?>">
                                                <div class="mb-2">
                                                    <label for="modificaNome-<?php echo $birra['codProdotto']; ?>" class="form-label text-warning fs-5">Nome:</label>
                                                    <input type="text" class="form-control" id="modificaNome-<?php echo $birra['codProdotto']; ?>" value="<?php echo $birra["nome"]; ?>" required>
                                                </div>
                                                <div class="mb-2">
                                                    <label for="modificaAlc-<?php echo $birra['codProdotto']; ?>" class="form-label text-warning fs-5">Percentuale Alcolica (%):</label>
                                                    <input type="number" class="form-control" id="modificaAlc-<?php echo $birra['codProdotto']; ?>" value="<?php echo $birra["alc"]; ?>" required>
                                                </div>
                                                <div class="mb-2">
                                                    <label for="modificaPrezzo-<?php echo $birra['codProdotto']; ?>" class="form-label text-warning fs-5">Prezzo (€):</label>
                                                    <input type="number" class="form-control" id="modificaPrezzo-<?php echo $birra['codProdotto']; ?>" value="<?php echo $birra["prezzo"]; ?>" required>
                                                </div>
                                                <div class="mb-2">
                                                    <label for="descrizioneProdotto-<?php echo $birra['codProdotto']; ?>" class="form-label text-warning fs-5">Descrizione:</label>
                                                    <textarea class="form-control" name="descrizioneProdotto" id="descrizioneProdotto-<?php echo $birra['codProdotto']; ?>" rows="3" required><?php echo htmlspecialchars($birra["descrizione"]); ?></textarea>
                                                </div>
                                                <div class="mb-2">
                                                    <label for="modificaListaIngredienti-<?php echo $birra['codProdotto']; ?>" class="form-label text-warning fs-5">Lista Ingredienti:</label>
                                                    <input type="text" class="form-control" id="modificaListaIngredienti-<?php echo $birra['codProdotto']; ?>" value="<?php echo $birra["listaIngredienti"]; ?>" required>
                                                </div>
                                                <div class="mb-2">
                                                    <label for="modificaImmagine-<?php echo $birra['codProdotto']; ?>" class="form-label text-warning fs-5">Immagine:</label>
                                                    <input type="file" class="form-control" id="modificaImmagine-<?php echo $birra['codProdotto']; ?>" required>
                                                </div>
                                                <div class="mb-2">
                                                    <label class="form-label text-warning fs-5">Senza Glutine:</label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="glutenFree-<?php echo $birra['codProdotto']; ?>" id="glutenFree-<?php echo $birra['codProdotto']; ?>" value="1">
                                                        <label class="form-check-label" for="glutenFree-<?php echo $birra['codProdotto']; ?>">Sì</label>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer border-secondary">
                                            <button type="button" class="btn" data-bs-dismiss="modal">Annulla</button>
                                            <button type="button" class="btn" onclick="confermaEliminazione(() => eliminaProdotto(<?php echo $birra['codProdotto']; ?>))">Elimina</button>
                                            <button type="button" class="btn" onclick="salvaModificheProdotto()">Salva Modifiche</button>
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
    <script src="js/confermaEliminazione.js"></script>
    <script src="js/modificaProdotto.js"></script>
    <script src="js/salvaAggiunta.js"></script>
</main>
