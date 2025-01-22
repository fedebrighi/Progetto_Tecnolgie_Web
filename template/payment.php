<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="border border-secondary rounded p-4">
                    <h1 class="text-center text-warning">Informazioni di Spedizione</h1>
                    <h2 class="text-center  fs-5">Completa con i tuoi dati per procedere alla spedizione e
                        al pagamento</h2>
                    <form method="POST" action="checkout.php">
                        <div class="mb-3">
                            <label for="indirizzo" class="form-label">Indirizzo:</label>
                            <input type="text" class="form-control" id="indirizzo" name="indirizzo"
                                placeholder="Inserisci il tuo indirizzo" required>
                        </div>
                        <div class="row mb-3">
                            <div class="col-8">
                                <label for="citta" class="form-label">Città:</label>
                                <input type="text" name="citta" class="form-control" id="citta"
                                    placeholder="Inserisci la città" required />
                            </div>
                            <div class="col-4">
                                <label for="cap" class="form-label">CAP:</label>
                                <input type="text" name="cap" class="form-control" id="cap" placeholder="CAP"
                                    pattern="^\d{5}$" maxlength="5" required />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Cellulare:</label>
                            <input type="text" name="telefono" class="form-control" id="telefono"
                                placeholder="Inserisci il tuo numero di telefono" pattern="^\d{10}$" maxlength="10"
                                required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tipo di spedizione:</label><br>
                            <input type="radio" id="standard" name="spedizione" value="standard" checked
                                onclick="updateTotal()">
                            <label for="standard">
                                <i class="bi bi-box"></i> Standard (7-10 giorni lavorativi)
                            </label><br>
                            <input type="radio" id="rapida" name="spedizione" value="rapida" onclick="updateTotal()">
                            <label for="rapida">
                                <i class="bi bi-lightning-charge"></i> Rapida (3-5 giorni, +€5)
                            </label>
                        </div>
                        <div class="mb-3">
                            <label for="note" class="form-label">Note per il corriere:</label>
                            <textarea class="form-control" id="note" name="note" rows="3"></textarea>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="pagamento" id="pagamentoCarta"
                                value="carta" checked onchange="toggleCardForm()">
                            <label for="pagamentoCarta" class="form-check-label">
                                <i class="bi bi-credit-card"></i> Carta di credito
                            </label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="pagamento" id="pagamentoApplePay"
                                value="applepay" onchange="toggleCardForm()">
                            <label for="pagamentoApplePay" class="form-check-label">
                                <i class="bi bi-apple"></i> ApplePay
                            </label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="pagamento" id="pagamentoGooglePay"
                                value="googlepay" onchange="toggleCardForm()">
                            <label for="pagamentoGooglePay" class="form-check-label">
                                <i class="bi bi-google"></i> GooglePay
                            </label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="pagamento" id="pagamentoPayPal"
                                value="paypal" onchange="toggleCardForm()">
                            <label for="pagamentoPayPal" class="form-check-label">
                                <i class="bi bi-paypal"></i> PayPal
                            </label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="pagamento" id="pagamentoContrassegno"
                                value="contrassegno" onchange="toggleCardForm()">
                            <label for="pagamentoContrassegno" class="form-check-label">
                                <i class="bi bi-truck"></i> Pagamento alla consegna
                            </label>
                        </div>
                        <div id="creditCardForm" style="display: none;">
                            <div class="mb-3">
                                <label for="cardNumber" class="form-label">Numero Carta:</label>
                                <input type="number" class="form-control" id="cardNumber" name="cardNumber" maxlength="16"
                                    placeholder="Inserisci il numero della carta">
                            </div>
                            <div class="mb-3">
                                <label for="expiryDate" class="form-label">Scadenza (MM/YYYY):</label>
                                <input type="text" class="form-control" id="expiryDate" name="expiryDate"
                                    placeholder="MM/YYYY">
                                <small id="expiryError" class="text-danger"></small>
                            </div>
                            <div class="mb-3">
                                <label for="cvv" class="form-label">CVV:</label>
                                <input type="number" class="form-control" id="cvv" name="cvv" maxlength="3"
                                    placeholder="CVV">
                            </div>
                        </div>
                        <div class="text-center my-4">
                            <h4 id="totale">Tot: <?php echo $templateParams["carrello"]["totale"] ?> €</h4>
                        </div>
                        <button type="submit" class="btn btn-warning w-100">Procedi al pagamento</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        const totaleBase = <?php echo $templateParams['carrello']['totale']; ?>;
    </script>
    <script src="js/checkdati.js"></script>
    <script src="js/spedizioneRapida.js"></script>
    <script src="js/spesaTotale.js"></script>
    <script src="js/cartaCredito.js"></script>
</body>