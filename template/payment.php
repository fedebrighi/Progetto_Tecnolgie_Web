
<body class="bg-dark text-light">
    <div class="container py-5">
        <h1 class="text-center text-warning">Informazioni di spedizione</h1>
        <form method="post" action="simulation.php">
            <!-- Dati personali -->
            <div class="mb-3">
                <label for="indirizzo" class="form-label">Indirizzo:</label>
                <input type="text" class="form-control" id="indirizzo" name="indirizzo" placeholder="Inserisci il tuo indirizzo" required>
            </div>
            <div class="mb-3">
                <label for="citta" class="form-label">Città:</label>
                <input type="text" class="form-control" id="citta" name="citta" placeholder="Inserisci la città" required>
            </div>
            <div class="mb-3">
                <label for="cap" class="form-label">CAP:</label>
                <input type="text" class="form-control" id="cap" name="cap" placeholder="CAP" required>
            </div>
            <div class="mb-3">
                <label for="cellulare" class="form-label">Cellulare:</label>
                <input type="text" class="form-control" id="cellulare" name="cellulare" placeholder="Inserisci il tuo numero di cellulare" required>
            </div>

            <!-- Tipo di spedizione -->
            <div class="mb-3">
                <label class="form-label">Tipo di spedizione:</label><br>
                <input type="radio" id="standard" name="spedizione" value="standard" checked>
                <label for="standard">Standard</label><br>
                <input type="radio" id="rapida" name="spedizione" value="rapida">
                <label for="rapida">Rapida</label>
            </div>

            <!-- Note per il corriere -->
            <div class="mb-3">
                <label for="note" class="form-label">Note per il corriere:</label>
                <textarea class="form-control" id="note" name="note" rows="3"></textarea>
            </div>

            <!-- Metodo di pagamento -->
            <div class="form-check">
                        <input type="radio" class="form-check-input" name="pagamento" id="pagamentoCarta" checked />
                        <label for="pagamentoCarta" class="form-check-label">Carta di credito</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="pagamento" id="pagamentoApplePay" />
                        <label for="pagamentoApplePay" class="form-check-label">ApplePay</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="pagamento" id="pagamentoGooglePay" />
                        <label for="pagamentoGooglePay" class="form-check-label">GooglePay</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="pagamento" id="pagamentoPaypal" />
                        <label for="pagamentoPaypal" class="form-check-label">PayPal</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="pagamento" id="pagamentoContrassegno" />
                        <label for="pagamentoContrassegno" class="form-check-label">Pagamento alla consegna</label>
                    </div>
            <button type="submit" class="btn btn-warning w-100">Procedi al pagamento</button>
        </form>
    </div>
</body>
