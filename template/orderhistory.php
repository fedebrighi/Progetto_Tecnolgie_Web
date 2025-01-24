<main>
    <div class="container mt-4">
        <div class="border rounded p-4 shadow-sm bg-dark">
            <h4 class="text-warning mb-4">Ordini Recenti</h4>
            <ul class="list-group">
                <?php foreach ($templateParams["ordini"] as $order): ?>
                    <li class="list-group-item bg-dark  d-flex justify-content-between align-items-center ">
                        <span>
                            <strong>Ordine #<?php echo $order["codiceOrdine"]; ?></strong><br />
                            <small>Totale: <?php echo $order["totale"]; ?>€</small>
                        </span>
                        <div class="d-flex flex-column flex-md-row align-items-center">
                            <?php if ($order["dataArrivo"] === NULL): ?>
                                <button
                                    class="btn btn-sm me-md-2 mb-2 mb-md-0"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modificaStatoModal-<?php echo $order['codiceOrdine']; ?>">
                                    Modifica Stato
                                </button>
                                <div class="modal fade" id="modificaStatoModal-<?php echo $order['codiceOrdine']; ?>" tabindex="-1" aria-labelledby="modificaStatoModalLabel-<?php echo $order['codiceOrdine']; ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-dark text-white">
                                            <div class="modal-header border-secondary">
                                                <h5 class="modal-title text-warning" id="modificaStatoModalLabel-<?php echo $order['codiceOrdine']; ?>">
                                                    Seleziona il nuovo stato:
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Chiudi"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="modificaStatoForm-<?php echo $order['codiceOrdine']; ?>">
                                                    <?php if ($order["stato"] === "In Preparazione"): ?>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="stato-<?php echo $order['codiceOrdine']; ?>" id="spedito-<?php echo $order['codiceOrdine']; ?>" value="Spedito">
                                                            <label class="form-check-label" for="spedito-<?php echo $order['codiceOrdine']; ?>">Spedito</label>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if ($order["stato"] === "Spedito"): ?>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="stato-<?php echo $order['codiceOrdine']; ?>" id="inConsegna-<?php echo $order['codiceOrdine']; ?>" value="In Consegna">
                                                            <label class="form-check-label" for="inConsegna-<?php echo $order['codiceOrdine']; ?>">In Consegna</label>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if ($order["stato"] === "Spedito" || $order["stato"] === "In Consegna"): ?>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="stato-<?php echo $order['codiceOrdine']; ?>" id="consegnato-<?php echo $order['codiceOrdine']; ?>" value="Consegnato">
                                                            <label class="form-check-label" for="consegnato-<?php echo $order['codiceOrdine']; ?>">Consegnato</label>
                                                        </div>
                                                    <?php endif; ?>
                                                </form>
                                            </div>
                                            <div class="modal-footer border-secondary">
                                                <button type="button" class="btn" data-bs-dismiss="modal">Annulla</button>
                                                <button
                                                    type="button"
                                                    class="btn conferma-stato-button"
                                                    id="confermaStatoButton-<?php echo $order['codiceOrdine']; ?>"
                                                    data-ordine-id="<?php echo $order['codiceOrdine']; ?>"
                                                    data-tipo-spedizione="<?php echo htmlspecialchars($order['tipo']); ?>">
                                                    Conferma Stato
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <form action="dettagliordine.php" method="POST" class="ms-md-2">
                                <input type="hidden" name="codice" value="<?php echo $order["codiceOrdine"]; ?>">
                                <button type="submit" class="btn btn-sm ">Dettagli</button>
                            </form>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <script src="js/modificaStato.js"></script>
</main>