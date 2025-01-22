<main>
    <!-- Intestazione -->
    <div class="container py-4">
        <div class="text-center mb-4">
            <h1 class="text-warning">PROFILO UTENTE</h1>
            <?php $user = $templateParams["cliente"] ?>
            <p>Benvenuto,
                <strong><?php echo $user["nome"] . " " . $user["cognome"] . "!"; ?></strong>
            </p>
        </div>

        <!-- Sezione Dati Personali -->
        <div class="border rounded p-4 mb-5">
            <h2 class="text-warning mb-3"> I tuoi dati personali</h2>
            <div class="mb-2">
                <strong>Email:</strong> <?php echo $user["email"]; ?>
            </div>
            <div class="mb-2">
                <strong>Data di nascita:</strong> <?php echo $user["dataNascita"]; ?>
            </div>
            <div class="mb-2">
                <strong>Indirizzo:</strong>
                <?php echo $user["indirizzo"] . ", " . $user["citta"] . ", " . $user["cap"]; ?>
            </div>
            <div class="mb-2">
                <strong>Telefono:</strong> <?php echo $user["telefono"]; ?>
            </div>

            <div class="text-center">
                <button type="button" class="btn btn-warning fw-bold" data-bs-toggle="modal"
                    data-bs-target="#modificaInfoUtenteModal">
                    Modifica Dati
                </button>

                <!-- Modale per modificare info utente -->
                <div class="modal fade" id="modificaInfoUtenteModal" tabindex="-1"
                    aria-labelledby="modificaInfoUtenteLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content bg-dark">
                            <div class="modal-header">
                                <h5 class="modal-title text-warning" id="modificaInfoUtenteModalLabel">Modifica
                                    Informazioni</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="modificaInfoUtenteForm">
                                    <div class="mb-2">
                                        <label for="modificaNome" class="form-label  text-warning fs-6">Nome</label>
                                        <input type="text" class="form-control" id="modificaNome"
                                            value="<?php echo $user["nome"]; ?>" required />
                                    </div>
                                    <div class="mb-2">
                                        <label for="modificaCognome"
                                            class="form-label  text-warning fs-6">Cognome</label>
                                        <input type="text" class="form-control" id="modificaCognome"
                                            value="<?php echo $user["cognome"]; ?> " required />
                                    </div>
                                    <div class="mb-2">
                                        <label for="modificaEmail" class="form-label  text-warning fs-6">Email</label>
                                        <input type="text" class="form-control" id="modificaEmail"
                                            value="<?php echo $user["email"]; ?> " required />
                                    </div>
                                    <div class="mb-2">
                                        <label for="modificaPassword"
                                            class="form-label text-warning fs-6">Password</label>
                                        <div class="input-group">
                                            <input type="password" name="modificaPassword" class="form-control pe-5"
                                                id="password" value="<?php echo $user["pw"]; ?>" required />
                                            <!-- Icona per vedere/nascondere la password -->
                                            <span class="input-group-text bg-white">
                                                <i class="bi bi-eye toggle-password" style="cursor: pointer;"></i>
                                            </span>
                                            <!-- Pulsante per generare una password casuale -->
                                            <span class="input-group-text bg-white">
                                                <i class="bi bi-shuffle generate-password" style="cursor: pointer;"
                                                    title="Genera password casuale"></i>
                                            </span>
                                        </div>
                                        <!-- Indicatore della forza della password -->
                                        <div class="mt-2">
                                            <small id="passwordStrength" class="form-text"></small>
                                        </div>
                                    </div>

                                    <div class="mb-2">
                                        <label for="modificaIndirizzo"
                                            class="form-label text-warning fs-6">Indirizzo</label>
                                        <input type="text" class="form-control" id="modificaIndirizzo"
                                            value="<?php echo $user["indirizzo"]; ?>" required />
                                    </div>
                                    <div class="mb-2">
                                        <label for="modificaCitta" class="form-label text-warning fs-6">Città</label>
                                        <input type="text" class="form-control" id="modificaCitta"
                                            value="<?php echo $user["citta"]; ?>" required />
                                    </div>
                                    <div class="mb-2">
                                        <label for="modificaCAP" class="form-label text-warning fs-6">CAP</label>
                                        <input type="number" class="form-control" id="modificaCAP"
                                            value="<?php echo $user["cap"]; ?>" required />
                                    </div>
                                    <div class="mb-2">
                                        <label for="modificaTelefono"
                                            class="form-label text-warning fs-6">Telefono</label>
                                        <input type="number" class="form-control" id="modificaTelefono"
                                            value="<?php echo $user["telefono"]; ?>" required />
                                    </div>
                                    <div class="mb-2">
                                        <label for="dataNascita" class="form-label text-warning fs-6">Data di
                                            Nascita:</label>
                                        <input type="date" name="dataNascita" class="form-control" id="dataNascita"
                                            required />
                                    </div>
                                    <div class="alert alert-danger d-none" id="dataNascitaError">
                                        Devi essere maggiorenne per registrarti!
                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn" data-bs-dismiss="modal">Annulla</button>
                                <button type="button" class="btn btn-warning" onclick="salvaModifiche()">Salva
                                    Modifiche</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ordini Recenti -->
        <div class="border rounded p-4">
            <h4 class="text-warning mb-3">Ordini Recenti</h4>
            <ul class="list-group bg-dark">
                <?php foreach ($templateParams["ordini"] as $order): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center bg-dark text-white">
                        Ordine #<?php echo $order["codiceOrdine"]; ?> - Totale: <?php echo $order["totale"]; ?>€
                        <form action="dettagliordine.php" method="POST">
                            <input type="hidden" name="codiceOrdine" value="<?php echo $order["codiceOrdine"]; ?>">
                            <button type="submit" class="btn btn-sm">Dettagli</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Lascia una Recensione -->
        <div class="border rounded p-4 mt-5">
            <h4 class="text-warning mb-3">Lascia una Recensione</h4>
            <?php if (!empty($templateParams["prodottiNonRecensiti"])): ?>
                <p>Scegli un prodotto acquistato e lascia una recensione!</p>
                <div id="conferma-recensione"></div> <!-- Spazio per il messaggio di conferma -->
                <form id="recensioneForm">
                    <div class="mb-3">
                        <label for="prodotto" class="form-label text-warning">Seleziona un prodotto</label>
                        <select id="prodotto" name="codProdotto" class="form-select" required>
                            <?php foreach ($templateParams["prodottiNonRecensiti"] as $prodotto): ?>
                                <option value="<?php echo htmlspecialchars($prodotto["codProdotto"]); ?>">
                                    <?php echo htmlspecialchars($prodotto["nome"]); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="valutazione" class="form-label text-warning">Valutazione</label>
                        <div id="rating" class="d-flex gap-2">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <label>
                                    <input type="radio" id="valutazione-<?php echo $i; ?>" name="valutazione"
                                        value="<?php echo $i; ?>" hidden>
                                    <i class="bi bi-star text-secondary fs-4 star-icon" data-value="<?php echo $i; ?>"></i>
                                </label>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="testo" class="form-label text-warning">Commento (opzionale)</label>
                        <textarea id="testo" name="testo" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-warning">Invia Recensione</button>
                </form>
            <?php else: ?>
                <p>Non ci sono prodotti disponibili per la recensione.</p>
            <?php endif; ?>
        </div>
    </div>
    </div>
    <link href="css/password_style.css" rel="stylesheet" />
    <script src="js/modificaUtente.js"></script>
    <script src="js/gestionePassword.js"></script>
    <script src="js/recensioni.js"></script>
</main>