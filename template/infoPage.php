<!-- Contenuto principale -->
<div class="container py-5">
    <!-- Intestazione -->
    <div class="text-center mb-4">
        <img src="img/logo1.jpg" alt="PHPint Logo" class="img-fluid mb-3" style="width: 400px;">
        <h1 class="text-warning">Benvenuti su PHPint</h1>
        <p class="lead text-light">Il tuo negozio di fiducia per birre artigianali di qualità.</p>
    </div>

    <!-- Sezione Chi Siamo -->
    <section class="mb-5" id="chi-siamo">
        <div class="row align-items-center">
            <div class="col-md-12">
                <h2 class="text-warning">Chi Siamo</h2>
                <p>
                    PHPint è nato dalla passione per la birra artigianale e l'amore per la qualità. Da anni
                    selezioniamo le migliori birre artigianali da tutto il mondo per offrirti
                    un'esperienza unica e irripetibile. La nostra missione è portare il gusto autentico e
                    inconfondibile delle birre artigianali direttamente nelle case dei nostri clienti.
                </p>
                <p>
                    Collaboriamo con birrifici indipendenti che condividono i nostri valori di autenticità,
                    innovazione e rispetto per l'ambiente. Ogni birra del nostro catalogo è stata accuratamente
                    scelta per garantire la massima qualità e per soddisfare i palati più esigenti.
                </p>
                <p>
                    Oltre alla vendita di birre, ci impegniamo a educare i nostri clienti sulla cultura birraria,
                    offrendo consigli sugli abbinamenti, guide sulle diverse tipologie di birre e suggerimenti per
                    godere appieno di ogni sorso.
                </p>
            </div>
        </div>
    </section>


    <section class="py-5 bg-dark text-light" id="birre-evidenza">
        <div class="container">
            <h2 class="text-center text-warning mb-4">Birre in Evidenza</h2>
            <div class="row gy-4">
                <?php foreach ($templateParams["miglioriBirre"] as $item): ?>
                    <div class="col-md-4 d-flex">
                        <div class="card bg-dark border border-secondary text-light w-100">
                            <img src="img/beers/<?php echo htmlspecialchars($item["immagine"]); ?>"
                                class="card-img-top"
                                alt="<?php echo htmlspecialchars($item["nome"]); ?>">
                            <div class="card-body d-flex flex-column">
                                <!-- Nome e Stelline -->
                                <div class="d-flex align-items-center mb-2">
                                    <h5 class="card-title text-warning me-2 mb-0"><?php echo htmlspecialchars($item["nome"]); ?></h5>

                                    <!-- Stelline -->
                                    <div>
                                        <?php
                                        $media = $item["mediaValutazione"];
                                        $stellePiene = floor($media);
                                        $mezzeStelle = ($media - $stellePiene) >= 0.5 ? 1 : 0;
                                        $stelleVuote = 5 - ($stellePiene + $mezzeStelle);

                                        // Mostra stelle piene
                                        for ($i = 0; $i < $stellePiene; $i++) {
                                            echo '<i class="bi bi-star-fill text-warning"></i>';
                                        }
                                        // Mostra mezza stella
                                        if ($mezzeStelle) {
                                            echo '<i class="bi bi-star-half text-warning"></i>';
                                        }
                                        // Mostra stelle vuote
                                        for ($i = 0; $i < $stelleVuote; $i++) {
                                            echo '<i class="bi bi-star text-secondary"></i>';
                                        }
                                        ?>
                                    </div>
                                </div>

                                <p class="card-text">
                                    Alc. <?php echo htmlspecialchars(number_format($item["alc"], 1)); ?>% vol.
                                    <?php echo htmlspecialchars($item["descrizione"]); ?>
                                </p>
                                <p class="fw-bold">Prezzo: <?php echo number_format($item["prezzo"], 2, ',', ''); ?> €</p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>



    <!-- Certificazioni e Qualità -->
    <section class="py-5" id="certificazioni">
        <div class="container border border-secondary rounded p-4 bg-dark text-light">
            <h2 class="text-center text-warning mb-4">Certificazioni e Qualità</h2>
            <p class="text-center mb-4">
                Le nostre birre sono prodotte rispettando i più alti standard di qualità, utilizzando ingredienti
                100% naturali e seguendo processi certificati.
            </p>
            <div class="row gy-4 text-center">
                <div class="col-md-4">
                    <div class="p-3">
                        <h5 class="text-warning">Ingredienti Bio</h5>
                        <p>Solo materie prime biologiche e sostenibili.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3">
                        <h5 class="text-warning">Controllo Qualità</h5>
                        <p>Ogni lotto è testato per garantire la perfezione del prodotto.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3">
                        <h5 class="text-warning">Produzione Artigianale</h5>
                        <p>Realizzate con passione dai nostri mastri birrai.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Contatti diretti -->
    <section class="mb-5" id="contatti">
        <div class="container border border-secondary rounded p-4 bg-dark text-light">
            <h2 class="text-warning text-center mb-4">Contattaci</h2>
            <div class="row">
                <div class="col-md-6">
                    <h5 class="text-warning">Email e Telefono</h5>
                    <p><i class="bi bi-envelope"></i> Email: <a href="mailto:info@phpint.com"
                            class="text-warning">info@phpint.com</a></p>
                    <p><i class="bi bi-telephone"></i> Telefono: <a href="tel:+391234567890"
                            class="text-warning">+39 123 456 7890</a></p>
                </div>
                <div class="col-md-6">
                    <h5 class="text-warning">Modulo di Contatto</h5>
                    <form>
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome" placeholder="Inserisci il tuo nome">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email"
                                placeholder="Inserisci la tua email">
                        </div>
                        <div class="mb-3">
                            <label for="messaggio" class="form-label">Messaggio</label>
                            <textarea class="form-control" id="messaggio" rows="3"
                                placeholder="Scrivi il tuo messaggio"></textarea>
                        </div>
                        <button type="submit" class="btn btn-warning">Invia</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>


<!-- FAQ -->
<section class="mb-5" id="faq">
    <div class="container" style="max-width: 1300px;"> <!-- Contenitore centrale con larghezza limitata -->
        <h2 class="text-warning text-center mb-4">FAQ</h2>
        <div class="accordion" id="faqAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="faq1">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse1">
                        Quali metodi di pagamento accettate?
                    </button>
                </h2>
                <div id="collapse1" class="accordion-collapse collapse show">
                    <div class="accordion-body">
                        Accettiamo pagamenti tramite carte di credito, PayPal e bonifici bancari.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="faq2">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse2">
                        Quanto tempo impiega la spedizione?
                    </button>
                </h2>
                <div id="collapse2" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        I tempi di spedizione variano tra 2 e 5 giorni lavorativi.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="faq3">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse3">
                        Posso restituire un prodotto?
                    </button>
                </h2>
                <div id="collapse3" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        Certamente, puoi restituire un prodotto entro 14 giorni dalla consegna, a condizione che sia
                        integro e non aperto.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="faq4">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse4">
                        Offrite sconti per ordini all'ingrosso?
                    </button>
                </h2>
                <div id="collapse4" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        Sì, contattaci direttamente per discutere sconti personalizzati per ordini di grandi
                        dimensioni.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>