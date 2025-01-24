<main>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="border border-secondary rounded p-4">
                    <h1 class="text-center text-warning">Informazioni di Spedizione</h1>
                    <h2 class="text-center fs-5">Completa con i tuoi dati per procedere alla
                        spedizione e
                        al pagamento</h2>
                    <form method="POST" action="checkout.php">
                        <fieldset class="mb-3">
                            <legend class="visually-hidden">Indirizzo di Spedizione</legend>
                            <label for="indirizzo" class="form-label">Indirizzo:</label>
                            <input type="text" class="form-control" id="indirizzo" name="indirizzo"
                                placeholder="Via Cesare Pavese 50" required>
                        </fieldset>

                        <fieldset class="mb-3">
                            <legend class="visually-hidden">Città e CAP</legend>
                            <div class="row">
                                <div class="col-8">
                                    <label for="citta" class="form-label">Città:</label>
                                    <input type="text" name="citta" class="form-control" id="citta" placeholder="Cesena"
                                        required>
                                </div>
                                <div class="col-4">
                                    <label for="cap" class="form-label">CAP:</label>
                                    <input type="text" name="cap" class="form-control" id="cap" placeholder="47521"
                                        pattern="^\d{5}$" maxlength="5" required>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="mb-3">
                            <legend class="visually-hidden">Contatto Telefonico</legend>
                            <label for="telefono" class="form-label">Cellulare:</label>
                            <input type="text" name="telefono" class="form-control" id="telefono"
                                placeholder="Inserisci il tuo numero di telefono" pattern="^\d{10}$" maxlength="10"
                                required>
                        </fieldset>

                        <fieldset class="mb-3">
                            <legend class="visually-hidden">Tipo di Spedizione</legend>
                            <div>
                                <input type="radio" id="standard" name="spedizione" value="standard" checked
                                    onclick="updateTotal()">
                                <label for="standard"><em class="bi bi-box"></em> Standard (7-10 giorni
                                    lavorativi)</label>
                            </div>
                            <div>
                                <input type="radio" id="rapida" name="spedizione" value="rapida"
                                    onclick="updateTotal()">
                                <label for="rapida"><em class="bi bi-lightning-charge"></em> Rapida (3-5 giorni,
                                    +€5)</label>
                            </div>
                        </fieldset>

                        <fieldset class="mb-3">
                            <legend class="visually-hidden">Note per il Corriere</legend>
                            <label for="note" class="form-label">Aggiungi eventuali note:</label>
                            <textarea class="form-control" id="note" name="note" rows="3"></textarea>
                        </fieldset>

                        <fieldset class="mb-3">
                            <legend class="visually-hidden">Metodo di Pagamento</legend>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="pagamento" id="pagamentoCarta"
                                    value="carta" checked onchange="toggleCardForm()">
                                <label for="pagamentoCarta" class="form-check-label"><em class="bi bi-credit-card"></em>
                                    Carta di credito</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="pagamento" id="pagamentoApplePay"
                                    value="applepay" onchange="toggleCardForm()">
                                <label for="pagamentoApplePay" class="form-check-label"><em class="bi bi-apple"></em>
                                    ApplePay</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="pagamento" id="pagamentoGooglePay"
                                    value="googlepay" onchange="toggleCardForm()">
                                <label for="pagamentoGooglePay" class="form-check-label"><em class="bi bi-google"></em>
                                    GooglePay</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="pagamento" id="pagamentoPayPal"
                                    value="paypal" onchange="toggleCardForm()">
                                <label for="pagamentoPayPal" class="form-check-label"><em class="bi bi-paypal"></em>
                                    PayPal</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="pagamento" id="pagamentoContrassegno"
                                    value="contrassegno" onchange="toggleCardForm()">
                                <label for="pagamentoContrassegno" class="form-check-label"><em
                                        class="bi bi-truck"></em> Pagamento alla consegna</label>
                            </div>
                        </fieldset>

                        <div id="creditCardForm" style="display: none;">
                            <fieldset class="mb-3">
                                <legend class="visually-hidden">Dati Carta di Credito</legend>
                                <div class="mb-3">
                                    <label for="cardNumber" class="form-label">Numero Carta:</label>
                                    <input type="number" class="form-control" id="cardNumber" name="cardNumber"
                                        placeholder="Inserisci il numero della carta" required
                                        oninput="this.value = this.value.slice(0, 16);">
                                    <small id="cardNumberError" class="text-danger"></small>
                                </div>
                                <div class="mb-3">
                                    <label for="expiryDate" class="form-label">Scadenza (MM/YYYY):</label>
                                    <input type="text" class="form-control" id="expiryDate" name="expiryDate"
                                        placeholder="MM/YYYY" pattern="^(0[1-9]|1[0-2])\/\d{4}$" required>
                                    <small id="expiryError" class="text-danger"></small>
                                </div>
                                <div class="mb-3">
                                    <label for="cvv" class="form-label">CVV:</label>
                                    <input type="number" class="form-control" id="cvv" name="cvv" placeholder="CVV"
                                        required oninput="this.value = this.value.slice(0, 3);">
                                    <small id="cvvError" class="text-danger"></small>
                                </div>
                            </fieldset>
                        </div>

                        <fieldset class="mb-3">
                            <legend class="visually-hidden">Codice Coupon</legend>
                            <label for="couponCode" class="form-label">Codice Coupon:</label>
                            <input type="text" class="form-control" id="couponCode" name="couponCode"
                                placeholder="Inserisci il codice coupon">
                            <button type="button" class="btn mt-2" id="applyCouponButton">Applica
                                Coupon</button>
                        </fieldset>

                        <div class="text-center my-4">
                            <h3 id="totale">Tot: <?php echo $templateParams["carrello"]["totale"]; ?> €</h3>
                        </div>
                        <button id="submitButton" type="submit" class="btn w-100">Procedi al pagamento</button>
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
    <script src="js/applicaCoupon.js"></script>
    <script src="js/spesaTotale.js"></script>
    <script src="js/cartaCredito.js"></script>
</main>