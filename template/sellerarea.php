<main>
    <div class="container py-4">
        <div class="text-center mb-4">
            <h2 class="text-warning">Benvenuto!</h2>
            <p class="text-light">Gestisci i tuoi prodotti e monitora le vendite direttamente da questa pagina.</p>
        </div>

        <!-- Sezioni principali -->
        <div class="row gy-4">
            <!-- Gestione Prodotti -->
            <div class="col-md-6">
                <div class="border border-secondary rounded p-4 bg-dark">
                    <h4 class="text-warning mb-3">Gestione Prodotti</h4>
                    <p class="text-light">Aggiungi, modifica o elimina prodotti dal catalogo.</p>
                    <button class="btn btn-warning w-100 mb-2 fw-bold"
                        onclick="window.location.href='aggiungiprodotto.php'">Aggiungi Nuovo Prodotto</button>
                    <button class="btn btn-outline-light w-100 fw-bold"
                        onclick="window.location.href='gestioneprodotti.php'">Gestisci Prodotti</button>
                </div>
            </div>

            <!-- Monitoraggio Vendite -->
            <div class="col-md-6">
                <div class="border border-secondary rounded p-4 bg-dark">
                    <h4 class="text-warning mb-3">Monitoraggio Vendite</h4>
                    <p class="text-light">Consulta i dati delle vendite e analizza le statistiche.</p>
                    <button class="btn btn-warning w-100 fw-bold"
                        onclick="window.location.href='statistichevendite.php'">Visualizza Statistiche</button>
                </div>
            </div>
        </div>

        <!-- Storico Ordini -->
        <div class="row gy-4 mt-4">
            <div class="col-md-12">
                <div class="border border-secondary rounded p-4 bg-dark">
                    <h4 class="text-warning mb-3">Storico Ordini</h4>
                    <p class="text-light">Consulta lo storico degli ordini ricevuti.</p>
                    <button class="btn btn-outline-light w-100 fw-bold"
                        onclick="window.location.href='storicoordini.php'">Visualizza Ordini</button>
                </div>
            </div>
        </div>
    </div>
</main>