<body class="bg-dark">
    <div class="container py-5">
        <h2 class="text-warning text-center mb-4">Statistiche Vendite</h2>
        <?php
        $totaleVendite = 0;
        $prodottiVenduti = 0;
        foreach ($templateParams["info"] as $prodotto):
            $prodottiVenduti += $prodotto["quantitaVendute"];
            $totaleVendite += $prodotto["ricavo"];
        endforeach; ?>
        <div class="row">
            <div class="col-md-6">
                <div class="bg-dark text-light border border-secondary p-4 rounded">
                    <h4 class="text-warning">Totale Vendite</h4>

                    <p class="fs-4">€<?php echo $totaleVendite; ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="bg-dark text-light border border-secondary p-4 rounded">
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
                <tbody>
                    <?php foreach ($templateParams["info"] as $prodotto): ?>
                        <tr>
                            <td><?php echo $dbh->getBeerDetails($prodotto["codInfo"])["nome"]; ?></td>
                            <td><?php echo htmlspecialchars($prodotto["quantitaVendute"]); ?></td>
                            <td>€<?php echo number_format($prodotto["ricavo"], 2, ',', '.'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="js/stats.js"></script>

</body>