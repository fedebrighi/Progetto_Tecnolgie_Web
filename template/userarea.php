<!-- Intestazione -->
<div class="container py-4">
    <div class="text-center mb-4">
        <h2 class="text-warning">Profilo Utente</h2>
        <?php $user = $templateParams["cliente"] ?>
        <p class="text-light">Benvenuto, <strong><?php echo $user["nome"] . " " . $user["cognome"]; ?></strong>!</p>
    </div>

    <!-- Sezione Dati Personali -->
    <div class="border border-secondary rounded p-4 mb-5">
        <h4 class="text-warning mb-3"> I tuoi dati personali</h4>
        <p class="text-light"><strong> Email:</strong> <?php echo $user["email"]; ?></p>
        <p class="text-light"><strong> Data di nascita:</strong> <?php echo $user["dataNascita"]; ?></p>
        <p class="text-light"><strong> Indirizzo:</strong>
            <?php echo $user["indirizzo"] . ", " . $user["citta"] . ", " . $user["cap"]; ?></p>
        <p class="text-light"><strong> Telefono:</strong> <?php echo $user["telefono"]; ?> </p>
        <div class="text-center">
            <button class="btn btn-warning fw-bold">Modifica Dati</button>
        </div>
    </div>

    <!-- Ordini Recenti -->
    <div class="border border-secondary rounded p-4">
        <h4 class="text-warning mb-3">Ordini Recenti</h4>
        <ul class="list-group bg-dark">
            <?php foreach ($templateParams["ordini"] as $order): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center bg-dark text-light">
                    Ordine #<?php echo $order["codiceOrdine"]; ?> - Totale: <?php echo $order["totale"]; ?>€
                    <form action="dettagliordine.php" method="GET">
                        <input type="hidden" name="codiceOrdine" value="<?php echo $order["codiceOrdine"]; ?>">
                        <button type="submit" class="btn btn-primary btn-sm">Dettagli</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>