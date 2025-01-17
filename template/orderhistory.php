<main><!-- Ordini Recenti -->
    <div class="border border-secondary rounded p-4">
        <h4 class="text-warning mb-3">Ordini Recenti</h4>
        <ul class="list-group bg-dark">
            <?php foreach ($templateParams["ordini"] as $order): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center bg-dark text-light">
                    Ordine #<?php echo $order["codiceOrdine"]; ?> - Totale: <?php echo $order["totale"]; ?>€
                    <form action="dettagliordine.php" method="POST">
                        <input type="hidden" name="codiceOrdine" value="<?php echo $order["codiceOrdine"]; ?>">
                        <button type="submit" class="btn btn-primary btn-sm">Dettagli</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</main>