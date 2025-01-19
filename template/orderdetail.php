<main>
    <!-- Intestazione -->
    <div class="container py-4">
        <div class="text-center mb-4">
            <?php $order = $templateParams["infoordine"]; ?>
            <h2 class="text-warning">Ordine # <?php echo $order["codiceOrdine"]; ?> </h2>

        </div>

        <!-- Sezione Dati Dell'Ordine -->
        <div class="border border-secondary rounded p-4 mb-5">
            <h4 class="text-warning mb-3"> Dati dell'ordine</h4>
            <p class="text-light"><strong> Data Ordine: <?php echo $order["dataOrdine"]; ?></strong> </p>
            <?php if (isset($order["dataSpedizione"])): ?>
                <p class="text-light"><strong> Data di Spedizione: <?php echo $order["dataSpedizione"]; ?></strong></p>
            <?php endif; ?>

            <?php if (isset($order["dataArrivo"])): ?>
                <p class="text-light"><strong> Data di Arrivo: <?php echo $order["dataArrivo"]; ?></strong></p>
            <?php elseif (isset($order["dataPrevista"])): ?>
                <p class="text-light"><strong> Data di Arrivo Prevista: <?php echo $order["dataPrevista"]; ?></strong></p>
            <?php endif; ?>

            <p class="text-light"><strong> Pagamento utilizzato: <?php echo $order["tipoPagamento"]; ?></strong></p>
            <p class="text-light"><strong> Indirizzo: <?php echo $order["indirizzo"] . ", " . $order["citta"] . ", " . $order["cap"]; ?></strong></p>
            <p class="text-light"><strong> Tipo spedizione: <?php echo $order["tipo"]; ?></strong></p>
            <p class="text-light"><strong> Note: <?php echo $order["note"]; ?></strong></p>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#trackingModal-<?php echo $order['codiceOrdine']; ?>">Stato</button>

            <div class="text-center">
                <h5 class="text-warning mb-3"><strong> Totale: <?php echo $order["totale"]; ?> €</strong></h5>
            </div>
        </div>
    </div>

    <!-- Modale Tracking -->
    <div class="modal fade" id="trackingModal-<?php echo $order['codiceOrdine']; ?>" tabindex="-1" aria-labelledby="trackingModalLabel-<?php echo $order['codiceOrdine']; ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header">
                    <h5 class="modal-title" id="trackingModalLabel-<?php echo $order['codiceOrdine']; ?>">Stato dell'Ordine #<?php echo $order['codiceOrdine']; ?></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <!-- Timeline Icone -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="text-center">
                            <i class="bi bi-box-seam fs-2 <?php echo $order['stato'] === 'In Preparazione' || $order['stato'] === 'Spedito' || $order['stato'] ===  'In Consegna' || $order['stato'] === 'Consegnato' ? 'text-primary' : 'text-secondary'; ?>"></i>
                            <p class="mt-2">In preparazione</p>
                        </div>
                        <div class="text-center">
                            <i class="bi bi-truck fs-2 <?php echo $order['stato'] === 'Spedito' || $order['stato'] ===  'In Consegna' || $order['stato'] === 'Consegnato' ? 'text-primary' : 'text-secondary'; ?>"></i>
                            <p class="mt-2">Spedito</p>
                        </div>
                        <div class="text-center">
                            <i class="bi bi-person-check fs-2 <?php echo $order['stato'] === 'Consegnato' ? 'text-primary' : 'text-secondary'; ?>"></i>
                            <p class="mt-2">Consegnato</p>
                        </div>
                    </div>
                    <!-- Barra di progresso -->
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php
                                                                                                if ($order['stato'] === 'In Preparazione') echo '33%';
                                                                                                elseif ($order['stato'] === 'Spedito' || $order['stato'] ===  'In Consegna') echo '66%';
                                                                                                elseif ($order['stato'] === 'Consegnato') echo '100%';
                                                                                                else echo '0%';
                                                                                                ?>;" aria-valuenow="<?php
                                                                                                                    if ($order['stato'] === 'In Preparazione') echo '33';
                                                                                                                    elseif ($order['stato'] === 'Spedito' || $order['stato'] ===  'In Consegna') echo '66';
                                                                                                                    elseif ($order['stato'] === 'Consegnato') echo '100';
                                                                                                                    else echo '0';
                                                                                                                    ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <!-- Messaggio di stato -->
                    <p class="mt-3">
                        <?php
                        if ($order['stato'] === 'In Preparazione') {
                            echo "Il tuo pacco è in fase di preparazione!";
                        } elseif ($order['stato'] === 'Spedito') {
                            echo "Il tuo pacco è stato spedito e arriverà presto!";
                        } elseif ($order['stato'] ===  'In Consegna') {
                            echo "Il tuo pacco è in consegna, arriverà oggi o domani!";
                        } elseif ($order['stato'] === 'Consegnato') {
                            echo "Il tuo pacco è stato consegnato!";
                        }
                        ?>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Chiudi</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Ordine -->
    <div class="container py-4">
        <div class="row gy-3">
            <?php
            foreach ($templateParams["elementiordine"] as $item):
                $birra = $dbh->getBeerDetails($item["codProdotto"]);
            ?>
                <div class="col-12 d-flex align-items-center border-bottom border-secondary pb-3">
                    <img src="img/beers/<?php echo $birra["immagine"] ?>" alt="<?php echo $birra["nome"] ?>"
                        class="img-fluid me-3" style="width: 150px;" />
                    <div class="flex-grow-1">
                        <h6 class="m-0 fs-4"><?php echo $birra["nome"] ?></h6>
                        <p class="m-0 fs-5">alc. <?php echo $birra["alc"] ?>% vol</p>
                        <p class="m-0 fw-bold fs-5"><?php echo $birra["prezzo"] ?> €</p>
                    </div>
                    <div class="d-flex flex-column align-items-center">
                        <p class="m-0 fs-5">Quantità: <?php echo $item["quantita"] ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>


        <?php if ($templateParams["clienteLoggato"]): ?>
            <div class="d-flex justify-content-center mt-4">
                <button class="btn btn-outline-light" type="button"
                    onclick="window.location.href='catalogo_prodotti.php';">Continua a fare acquisti</button>
            </div>
        <?php else: ?>
            <?php if ($order["dataArrivo"] === NULL): ?>
                <!-- Pulsante Modifica Stato -->
                <div class="text-center mt-4">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modificaStatoModal-<?php echo $order['codiceOrdine']; ?>">Modifica Stato</button>
                </div>

                <!-- Modale -->
                <div class="modal fade" id="modificaStatoModal-<?php echo $order['codiceOrdine']; ?>" tabindex="-1" aria-labelledby="modificaStatoModalLabel-<?php echo $order['codiceOrdine']; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content bg-dark text-light">
                            <div class="modal-header border-secondary">
                                <h5 class="modal-title text-warning" id="modificaStatoModalLabel-<?php echo $order['codiceOrdine']; ?>">Seleziona il nuovo stato:</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                            <label class="form-check-label" for="inConsegna-<?php echo $order['codiceOrdine']; ?>">In consegna</label>
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
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                                <button type="button" class="btn btn-primary conferma-stato-button" id="confermaStatoButton-<?php echo $order['codiceOrdine']; ?>" data-ordine-id="<?php echo $order['codiceOrdine']; ?>">Conferma Stato</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <script src="js/modificaStato.js"></script>
</main>