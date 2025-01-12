<main>
    <div class="container py-5">
        <h2 class="text-warning text-center mb-4">Aggiungi Prodotto</h2>
        <?php if (!empty($message)): ?>
            <div class="alert alert-info">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>
        <form method="post" class="bg-dark p-4 border border-secondary rounded">
            <div class="mb-3">
                <label for="nomeProdotto" class="form-label text-light">Nome Prodotto</label>
                <input type="text" class="form-control" name="nomeProdotto" id="nomeProdotto"
                    placeholder="Inserisci il nome del prodotto" required>
            </div>
            <div class="mb-3">
                <label for="percentualeAlcolica" class="form-label text-light">Percentuale Alcolica (%)</label>
                <input type="number" class="form-control" name="percentualeAlcolica" id="percentualeAlcolica" placeholder="Inserisci la percentuale alcolica"
                    step="0.1" required>
            </div>
            <div class="mb-3">
                <label for="descrizioneProdotto" class="form-label text-light">Descrizione</label>
                <textarea class="form-control" name="descrizioneProdotto" id="descrizioneProdotto" rows="3"
                    placeholder="Inserisci una descrizione del prodotto" required></textarea>
            </div>
            <div class="mb-3">
                <label for="prezzoProdotto" class="form-label text-light">Prezzo (€)</label>
                <input type="number" class="form-control" name="prezzoProdotto" id="prezzoProdotto" placeholder="Inserisci il prezzo"
                    step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="spesaUnitaria" class="form-label text-light">Costo di produzione per pezzo (€)</label>
                <input type="number" class="form-control" name="spesaUnitaria" id="spesaUnitaria" placeholder="Inserisci la spesa unitaria"
                    step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="quantitaProdotto" class="form-label text-light">Quantità</label>
                <input type="number" class="form-control" name="quantitaProdotto" id="quantitaProdotto"
                    placeholder="Inserisci la quantità disponibile" required>
            </div>
            <div class="mb-3">
                <label for="immagineProdotto" class="form-label text-light">Immagine del Prodotto</label>
                <input type="file" class="form-control" name="immagineProdotto" id="immagineProdotto" accept="image/*" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-warning fw-bold">Aggiungi Prodotto</button>
            </div>
        </form>
    </div>
</main>