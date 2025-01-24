<main>
    <div class="container py-4">
        <div class="text-center mb-4">
            <?php $order = $templateParams["infoordine"]; ?>
            <h2 class="text-warning">Ordine # <?php echo $order["codiceOrdine"]; ?> </h2>

        </div>

        <!-- Sezione Dati Dell'Ordine -->
        <div class="border border-secondary rounded p-4 mb-5">
            <h4 class="text-warning mb-3"> I dati dell'ordine:</h4>
            <div class="mb-2">
                <strong>Data Ordine:</strong> <?php echo $order["dataOrdine"]; ?>
            </div>
            <?php if (isset($order["dataSpedizione"])): ?>
                <div class="mb-2">
                    <strong>Data di Spedizione:</strong> <?php echo $order["dataSpedizione"]; ?>
                </div>
            <?php endif; ?>
            <?php if (isset($order["dataArrivo"])): ?>
                <div class="mb-2">
                    <strong>Data di Arrivo:</strong> <?php echo $order["dataArrivo"]; ?>
                </div>
            <?php elseif (isset($order["dataPrevista"])): ?>
                <div class="mb-2">
                    <strong>Data di Arrivo Prevista:</strong> <?php echo $order["dataPrevista"]; ?>
                </div>
            <?php endif; ?>
            <div class="mb-2">
                <strong>Pagamento utilizzato:</strong> <?php echo $order["tipoPagamento"]; ?>
            </div>
            <div class="mb-2">
                <strong>Indirizzo:</strong>
                <?php echo $order["indirizzo"] . ", " . $order["citta"] . ", " . $order["cap"]; ?>
            </div>
            <div class="mb-2">
                <strong>Tipo spedizione:</strong> <?php echo $order["tipo"]; ?>
            </div>
            <?php if ($order["scontoUsato"] > 0): ?>
                <div class="mb-2">
                    <strong>Coupon Applicato:</strong> <?php echo $order["scontoUsato"]; ?> €</strong></h5>
                </div>
            <?php endif; ?>
            <?php if ($order["note"] != ""): ?>
                <div class="mb-2">
                    <strong>Note:</strong> <?php echo $order["note"]; ?>
                </div>
            <?php endif; ?>
            <div class="mb-2">
                <button class="btn " data-bs-toggle="modal"
                    data-bs-target="#trackingModal-<?php echo $order['codiceOrdine']; ?>">Visualizza lo Stato dell'Ordine</button>
            </div>
            <div class="text-center">
                <h5 class="text-warning mb-3"><strong> Totale: <?php echo $order["totale"]; ?> €</strong></h5>
            </div>
        </div>
    </div>

    <!-- Modale Tracking -->
    <div class="modal fade" id="trackingModal-<?php echo $order['codiceOrdine']; ?>" tabindex="-1"
        aria-labelledby="trackingModalLabel-<?php echo $order['codiceOrdine']; ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark">
                <div class="modal-header">
                    <h5 class="modal-title" id="trackingModalLabel-<?php echo $order['codiceOrdine']; ?>">Stato
                        dell'Ordine #<?php echo $order['codiceOrdine']; ?></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="text-center">
                            <i
                                class="bi bi-box-seam fs-2 <?php echo $order['stato'] === 'In Preparazione' || $order['stato'] === 'Spedito' || $order['stato'] === 'In Consegna' || $order['stato'] === 'Consegnato' ? 'text-primary' : 'text-secondary'; ?>"></i>
                            <p class="mt-2">In preparazione</p>
                        </div>
                        <div class="text-center">
                            <i
                                class="bi bi-truck fs-2 <?php echo $order['stato'] === 'Spedito' || $order['stato'] === 'In Consegna' || $order['stato'] === 'Consegnato' ? 'text-primary' : 'text-secondary'; ?>"></i>
                            <p class="mt-2">Spedito</p>
                        </div>
                        <div class="text-center">
                            <i
                                class="bi bi-person-check fs-2 <?php echo $order['stato'] === 'Consegnato' ? 'text-primary' : 'text-secondary'; ?>"></i>
                            <p class="mt-2">Consegnato</p>
                        </div>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php
                                if ($order['stato'] === 'In Preparazione')
                                    echo '33%';
                                elseif ($order['stato'] === 'Spedito' || $order['stato'] === 'In Consegna')
                                    echo '66%';
                                elseif ($order['stato'] === 'Consegnato')
                                    echo '100%';
                                else
                                    echo '0%';
                                ?>;" aria-valuenow="<?php
                                    if ($order['stato'] === 'In Preparazione')
                                        echo '33';
                                    elseif ($order['stato'] === 'Spedito' || $order['stato'] === 'In Consegna')
                                        echo '66';
                                    elseif ($order['stato'] === 'Consegnato')
                                        echo '100';
                                    else
                                        echo '0';
                                    ?>"
                            aria-valuemin="0" aria-valuemax="100">
                        </div>
                    </div>
                    <p class="mt-3">
                        <?php
                        if ($order['stato'] === 'In Preparazione') {
                            echo "Il tuo pacco è in fase di preparazione!";
                        } elseif ($order['stato'] === 'Spedito') {
                            echo "Il tuo pacco è stato spedito e arriverà presto!";
                        } elseif ($order['stato'] === 'In Consegna') {
                            echo "Il tuo pacco è in consegna, arriverà oggi o domani!";
                        } elseif ($order['stato'] === 'Consegnato') {
                            echo "Il tuo pacco è stato consegnato!";
                        }
                        ?>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">Chiudi</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container py-4">
        <div class="row gy-3">
            <?php foreach ($templateParams["elementiordine"] as $item):
                $birra = $dbh->getBeerDetails($item["codProdotto"]);
            ?>
                <div
                    style="display: flex; align-items: center; gap: 1rem; border-bottom: 1px solid #6c757d; padding-bottom: 1rem;">
                    <img src="img/beers/<?php echo $birra["immagine"] ?>" alt="<?php echo $birra["nome"] ?>"
                        style="width: 150px; height: auto; display: block;" />
                    <div style="flex-grow: 1;">
                        <h6 style="margin: 0; font-size: 1.25rem;"><?php echo $birra["nome"] ?></h6>
                        <p style="margin: 0; font-size: 1rem;">alc. <?php echo $birra["alc"] ?>% vol</p>
                        <p style="margin: 0; font-weight: bold; font-size: 1rem;"><?php echo $birra["prezzo"] ?> €</p>
                    </div>
                    <div style="display: flex; flex-direction: column; align-items: center; flex-shrink: 0;">
                        <p style="margin: 0; font-size: 1rem;">Quantità: <?php echo $item["quantita"] ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if ($templateParams["clienteLoggato"]): ?>
            <div class="d-flex justify-content-center mt-4">
                <button class="btn" type="button"
                    onclick="window.location.href='catalogo_prodotti.php';">Continua a fare acquisti</button>
            </div>
        <?php else: ?>
            <?php if ($order["dataArrivo"] === NULL): ?>
                <div class="text-center mt-4">
                    <button class="btn " data-bs-toggle="modal"
                        data-bs-target="#modificaStatoModal-<?php echo $order['codiceOrdine']; ?>">Modifica Stato</button>
                </div>
                <div class="modal fade" id="modificaStatoModal-<?php echo $order['codiceOrdine']; ?>" tabindex="-1"
                    aria-labelledby="modificaStatoModalLabel-<?php echo $order['codiceOrdine']; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content bg-dark">
                            <div class="modal-header border-secondary">
                                <h5 class="modal-title text-warning"
                                    id="modificaStatoModalLabel-<?php echo $order['codiceOrdine']; ?>">Seleziona il nuovo stato:
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="modificaStatoForm-<?php echo $order['codiceOrdine']; ?>">
                                    <?php if ($order["stato"] === "In Preparazione"): ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio"
                                                name="stato-<?php echo $order['codiceOrdine']; ?>"
                                                id="spedito-<?php echo $order['codiceOrdine']; ?>" value="Spedito">
                                            <label class="form-check-label"
                                                for="spedito-<?php echo $order['codiceOrdine']; ?>">Spedito</label>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($order["stato"] === "Spedito"): ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio"
                                                name="stato-<?php echo $order['codiceOrdine']; ?>"
                                                id="inConsegna-<?php echo $order['codiceOrdine']; ?>" value="In Consegna">
                                            <label class="form-check-label"
                                                for="inConsegna-<?php echo $order['codiceOrdine']; ?>">In consegna</label>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($order["stato"] === "Spedito" || $order["stato"] === "In Consegna"): ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio"
                                                name="stato-<?php echo $order['codiceOrdine']; ?>"
                                                id="consegnato-<?php echo $order['codiceOrdine']; ?>" value="Consegnato">
                                            <label class="form-check-label"
                                                for="consegnato-<?php echo $order['codiceOrdine']; ?>">Consegnato</label>
                                        </div>
                                    <?php endif; ?>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn" data-bs-dismiss="modal">Annulla</button>
                                <button type="button" class="btn conferma-stato-button"
                                    id="confermaStatoButton-<?php echo $order['codiceOrdine']; ?>"
                                    data-ordine-id="<?php echo $order['codiceOrdine']; ?>">Conferma Stato</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <script src="js/modificaStato.js"></script>
</main>