<main class="bg-dark">
    <div class="container py-5">
        <h2 class="text-warning text-center mb-4">STATISTICHE DELLE VENDITE</h2>
        <?php
        $totaleVendite = 0;
        $prodottiVenduti = 0;
        foreach ($templateParams["info"] as $prodotto):
            $prodottiVenduti += $prodotto["quantitaVendute"];
            $totaleVendite += $prodotto["ricavo"];
        endforeach; ?>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="d-flex flex-column align-items-center justify-content-center bg-dark border border-secondary p-4 rounded h-100">
                    <h4 class="text-warning">Totale Vendite</h4>
                    <p class="fs-4">€<?php echo $totaleVendite; ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex flex-column align-items-center justify-content-center bg-dark border border-secondary p-4 rounded h-100">
                    <h4 class="text-warning">Prodotti Venduti</h4>
                    <p class="fs-4"><?php echo $prodottiVenduti; ?></p>
                </div>
            </div>
        </div>
        <div class="mt-5">
            <h4 class="text-warning mb-3">Grafico Vendite per Prodotto</h4>
            <canvas id="graficoVendite" width="400" height="200"></canvas>
        </div>
        <div class="mt-5">
            <h4 class="text-warning mb-3">Migliori Clienti</h4>
            <table class="table table-dark table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Utente</th>
                        <th scope="col">Totale Speso</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($templateParams["clienti"] as $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user["username"]); ?></td>
                            <td>€<?php echo number_format($user["totale_speso"], 2, ',', '.'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="mt-5">
            <h4 class="text-warning mb-3">Migliori Birre</h4>
            <table class="table table-dark table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Immagine</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Media Recensioni</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($templateParams["miglioriBirre"] as $birra): ?>
                        <tr>
                            <td>
                                <img src="img/beers/<?php echo htmlspecialchars($birra["immagine"]); ?>"
                                    alt="<?php echo htmlspecialchars($birra["nome"]); ?>"
                                    style="width: 100px; height: auto;">
                            </td>
                            <td><?php echo htmlspecialchars($birra["nome"]); ?></td>
                            <td>
                                <?php
                                $media = $birra["mediaValutazione"];
                                $stellePiene = floor($media);
                                $mezzeStelle = ($media - $stellePiene) >= 0.5 ? 1 : 0;
                                $stelleVuote = 5 - ($stellePiene + $mezzeStelle);
                                for ($i = 0; $i < $stellePiene; $i++) {
                                    echo '<em class="bi bi-star-fill text-warning"></em>';
                                }
                                if ($mezzeStelle) {
                                    echo '<em class="bi bi-star-half text-warning"></em>';
                                }
                                for ($i = 0; $i < $stelleVuote; $i++) {
                                    echo '<em class="bi bi-star text-warning"></em>';
                                }
                                ?>
                                <?php echo number_format($birra["mediaValutazione"], 2, ',', '.'); ?>
                                (<?php echo $birra["numeroRecensioni"]; ?>)
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="mt-5">
            <h4 class="text-warning mb-3">Vendite per Prodotto</h4>
            <table class="table table-dark table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Prodotto</th>
                        <th scope="col">Quantità Venduta</th>
                        <th scope="col">Entrate (€)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($templateParams["info"] as $prodotto): ?>
                        <tr>
                            <td><?php echo $prodotto["nome"]; ?></td>
                            <td><?php echo htmlspecialchars($prodotto["quantitaVendute"]); ?></td>
                            <td>€<?php echo number_format($prodotto["ricavo"], 2, ',', '.'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="js/stats.js"></script>
    <script>
        const salesData = <?php echo json_encode($templateParams["info"]); ?>;
        const prodotti = salesData.map(item => ({
            nome: item.nome,
            quantita: item.quantitaVendute
        }));
        creaGraficoVendite('graficoVendite', prodotti);
    </script>
</main>