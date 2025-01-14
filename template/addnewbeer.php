<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div>
                    <h2 class="text-warning text-center mb-4">Informazioni del Prodotto</h2>
                    <p class="text-center text-light">Completa i campi per aggiungere un nuovo prodotto al catalogo</p>

                    <!-- Messaggio informativo -->
                    <?php if (!empty($message)): ?>
                        <div class="alert alert-info text-center">
                            <?= htmlspecialchars($message) ?>
                        </div>
                    <?php endif; ?>

                    <!-- Modulo -->
                    <form method="post" class="bg-dark p-4 border border-secondary rounded" enctype="multipart/form-data">
                        <!-- Nome del Prodotto -->
                        <div class="mb-3">
                            <label for="nomeProdotto" class="form-label text-warning">Nome Prodotto:</label>
                            <input type="text" class="form-control" name="nomeProdotto" id="nomeProdotto"
                                placeholder="Inserisci il nome del prodotto" required>
                        </div>

                        <!-- Percentuale Alcolica -->
                        <div class="mb-3">
                            <label for="percentualeAlcolica" class="form-label text-warning">Percentuale Alcolica (%):</label>
                            <input type="number" class="form-control" name="percentualeAlcolica" id="percentualeAlcolica"
                                placeholder="Inserisci la percentuale alcolica" step="0.1" required>
                        </div>

                        <!-- Descrizione -->
                        <div class="mb-3">
                            <label for="descrizioneProdotto" class="form-label text-warning">Descrizione:</label>
                            <textarea class="form-control" name="descrizioneProdotto" id="descrizioneProdotto" rows="3"
                                placeholder="Inserisci una descrizione del prodotto" required></textarea>
                        </div>

                        <!-- Lista Ingredienti -->
                        <div class="mb-3">
                            <label for="listaIngredienti" class="form-label text-warning">Lista Ingredienti:</label>
                            <input type="text" class="form-control" name="listaIngredienti" id="listaIngredienti"
                                placeholder="Inserisci la lista degli ingredienti del prodotto" required>
                        </div>

                        <!-- Prezzo -->
                        <div class="mb-3">
                            <label for="prezzoProdotto" class="form-label text-warning">Prezzo (€):</label>
                            <input type="number" class="form-control" name="prezzoProdotto" id="prezzoProdotto"
                                placeholder="Inserisci il prezzo" step="0.01" required>
                        </div>

                        <!-- Costo Produzione -->
                        <div class="mb-3">
                            <label for="spesaUnitaria" class="form-label text-warning">Costo di produzione per pezzo (€):</label>
                            <input type="number" class="form-control" name="spesaUnitaria" id="spesaUnitaria"
                                placeholder="Inserisci la spesa unitaria" step="0.01" required>
                        </div>

                        <!-- Quantità -->
                        <div class="mb-3">
                            <label for="quantitaProdotto" class="form-label text-warning">Quantità:</label>
                            <input type="number" class="form-control" name="quantitaProdotto" id="quantitaProdotto"
                                placeholder="Inserisci la quantità disponibile" required>
                        </div>

                        <!-- Immagine -->
                        <div class="mb-3">
                            <label for="immagineProdotto" class="form-label text-warning">Immagine del Prodotto:</label>
                            <input type="file" class="form-control" name="immagineProdotto" id="immagineProdotto" accept="image/*" required>
                        </div>

                        <!-- Pulsante per inviare -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-warning fw-bold" style="width: 100%;">Aggiungi Prodotto</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>