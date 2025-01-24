<main class="bg-dark">
    <!-- Sezione Notifiche -->
    <div class="container py-5">
        <div class="text-center mb-4">
            <h2 class="text-warning">LE TUE NOTIFICHE</h2>
            <p class="fs-5">Visualizza le notifiche ricevute e gestiscile facilmente.</p>
        </div>
        <?php if (empty($templateParams["notifiche"])): ?>
            <div class="text-center my-5">
                <i class="bi bi-bell-slash text-danger" style="font-size: 6rem;"></i> <!-- Icona notifiche vuote -->
                <h3 class="text-warning mt-4">Non hai nuove notifiche!</h3>
                <p class="fs-4">Torna più tardi per verificare se ci sono aggiornamenti.</p>
            </div>
        <?php else: ?>
            <div class="row gy-3">
                <?php foreach ($templateParams["notifiche"] as $notifica): ?>
                    <div class="col-12">
                        <div class="border border-secondary rounded p-3 bg-dark" data-id="<?php echo $notifica['idNotifica']; ?>">
                            <p class="m-0 text-warning fw-bold">Da: <?php echo $notifica['mittente']; ?></p>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <p class="m-0" style="overflow: hidden; text-overflow: ellipsis; max-width: 70%;">Messaggio: <?php echo $notifica['messaggio']; ?></p>
                                <div class="d-flex flex-column">
                                    <form action="<?php echo $notifica["riferimento"]; ?>" method="POST" class="mb-2">
                                        <input type="hidden" name="codice" value="<?php echo $notifica["codiceRiferimento"]; ?>">
                                        <button type="submit" class="btn btn-sm bi bi-info-circle" style="width: 100%;"></button>
                                    </form>
                                    <button class="btn btn-sm" onclick="segnaComeLetta(<?php echo $notifica['idNotifica']; ?>)">
                                        <i class="bi bi-check-circle me-1"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <small style="color: #ffcc99;">Ricevuta: <?php echo $notifica['dataInvio']; ?></small>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <script src="js/gestioneNotifiche.js"></script>
</main>
