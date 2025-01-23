<main class="bg-dark">
    <!-- Sezione Notifiche -->
    <div class="container py-5">
        <div class="text-center mb-4">
            <h2 class="text-warning">Le tue notifiche</h2>
            <p class="fs-5">Visualizza le notifiche ricevute e gestiscile facilmente.</p>
        </div>

        <?php if (empty($templateParams["notifiche"])): ?>
            <!-- Nessuna notifica -->
            <div class="text-center my-5">
                <i class="bi bi-bell-slash text-danger" style="font-size: 6rem;"></i> <!-- Icona notifiche vuote -->
                <h3 class="text-warning mt-4">Non hai nuove notifiche!</h3>
                <p class="fs-4">Torna più tardi per verificare se ci sono aggiornamenti.</p>
            </div>
        <?php else: ?>
            <!-- Elenco Notifiche -->
            <div class="row gy-3">
                <?php foreach ($templateParams["notifiche"] as $notifica): ?>
                    <div class="col-12 d-flex align-items-center border-bottom border-secondary pb-3"
                        data-id="<?php echo $notifica['idNotifica']; ?>">
                        <div class="flex-grow-1">
                            <p class="m-0 text-warning fw-bold">Da: <?php echo $notifica['mittente']; ?></p>
                            <p class="m-0">Messaggio: <?php echo $notifica['messaggio']; ?></p>
                            <small class="text-muted">Ricevuta: <?php echo $notifica['dataInvio']; ?></small>
                        </div>
                        <div class="d-flex flex-column align-items-center">
                            <button class="btn btn-sm mb-2"
                                onclick="segnaComeLetta(<?php echo $notifica['idNotifica']; ?>)">
                                <i class="bi bi-check-circle me-1"></i>Segna come letta
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <script src="js/gestioneNotifiche.js"></script>
</main>