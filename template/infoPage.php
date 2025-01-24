<main>
    <div class="container py-5">
        <div class="text-center mb-4">
            <img src="img/logo1.jpg" alt="PHPint Logo" class="img-fluid mb-3" style="width: 400px;">
            <h1 class="text-warning">BENVENUTO SU PHPint!</h1>
            <p class="leadD">Il tuo negozio di fiducia per birre artigianali di qualità.</p>
        </div>
        <section class="mb-5" id="chi-siamo">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <h2 class="text-warning text-center">CHI SIAMO?</h2>
                    <p>
                        PHPint nasce dalla passione di 3 studenti per la birra artigianale e l'amore per la qualità. Da
                        anni
                        selezioniamo le migliori birre artigianali da tutto il mondo per offrirti
                        un'esperienza unica e irripetibile. La nostra missione è portare il gusto autentico e
                        inconfondibile delle birre artigianali direttamente nelle case dei nostri clienti.
                    </p>
                    <p>
                        Collaboriamo con birrifici indipendenti che condividono i nostri valori di autenticità,
                        innovazione e rispetto per l'ambiente. Ogni birra del nostro catalogo è stata accuratamente
                        scelta per garantire la massima qualità e per soddisfare i palati più esigenti.
                    </p>
                </div>
            </div>
        </section>
        <section class="py-5 bg-dark" id="birre-evidenza">
            <div class="container">
                <h2 class="text-center text-warning mb-4">I NOSTRI BEST SELLERS</h2>
                <div class="row gy-4">
                    <?php foreach ($templateParams["miglioriBirre"] as $item): ?>
                        <div class="col-md-4 d-flex">
                            <div class="card bg-dark border border-secondary text-light w-100">
                                <img src="img/beers/<?php echo htmlspecialchars($item["immagine"]); ?>" class="card-img-top"
                                    alt="<?php echo htmlspecialchars($item["nome"]); ?>">
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex align-items-center mb-2">
                                        <h5 class="card-title text-warning me-2 mb-0">
                                            <?php echo htmlspecialchars($item["nome"]); ?>
                                        </h5>
                                        <div>
                                            <?php
                                                $media = $item["mediaValutazione"];
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
                                                    echo '<em class="bi bi-star text-secondary"></em>';
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <p class="card-text">
                                        Alc. <?php echo htmlspecialchars(number_format($item["alc"], 1)); ?>% vol.
                                        <?php echo htmlspecialchars($item["descrizione"]); ?>
                                    </p>
                                    <p class="fw-bold">Prezzo: <?php echo number_format($item["prezzo"], 2, ',', ''); ?> €
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <section class="py-5" id="certificazioni">
            <div class="container border border-secondary rounded p-4 bg-dark text-light">
                <h2 class="text-center text-warning mb-4">CERTIFICAZIONI E QUALITA'</h2>
                <p class="text-center mb-4">
                    Le nostre birre sono prodotte rispettando i più alti standard di qualità, utilizzando ingredienti
                    100% naturali e seguendo processi certificati.
                </p>
                <div class="row gy-4 text-center">
                    <div class="col-md-4">
                        <div class="p-3">
                            <h5 class="text-warning">INGREDIENTI BIO</h5>
                            <p>Solo materie prime biologiche e sostenibili.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3">
                            <h5 class="text-warning">CONTROLLO QUALITA'</h5>
                            <p>Ogni lotto è testato per garantire la perfezione del prodotto.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3">
                            <h5 class="text-warning">PRODUZIONE ARTIGIANALE</h5>
                            <p>Realizzate con passione dai nostri mastri birrai.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="mb-6" id="contatti">
            <div class="container d-flex justify-content-center align-items-center">
                <div class="col-md-6">
                    <div class="border border-secondary rounded p-4 bg-dark text-light">
                        <h2 class="text-warning text-center mb-4">CONTATTACI</h2>
                        <h5 class="text-warning">Modulo di Contatto:</h5>
                        <form id="contactForm">
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="nome" placeholder="Inserisci il tuo nome"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Inserisci la tua email"
                                    required>
                            </div>
                            <div class="mb-4">
                                <label for="messaggio" class="form-label">Messaggio</label>
                                <textarea class="form-control" id="messaggio" rows="3"
                                    placeholder="Scrivi il tuo messaggio" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-warning w-100">Invia</button>
                        </form>
                        <div id="confirmationMessage" class="alert alert-success mt-3 d-none text-center" role="alert">
                            Grazie per averci scritto, ti contatteremo presto!
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <section class="mb-5" id="faq">
        <div class="container" style="max-width: 1300px;">
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
                            Accettiamo pagamenti tramite carte di credito, PayPal, GooglePay, ApplePay e pagamenti alla consegna.
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
                            I tempi di spedizione variano tra 3 e 10 giorni lavorativi in base al tipo di spedizione scelto.
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
                            Offrite sconti o coupon?
                        </button>
                    </h2>
                    <div id="collapse4" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            Sì, con un ordine di almeno 20€ riceverai uno sconto del 20% su un nuovo ordine.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script>
    document.getElementById('contactForm').addEventListener('submit', function(event) {
        event.preventDefault();
        document.getElementById('confirmationMessage').classList.remove('d-none');
        document.getElementById('contactForm').reset();
        setTimeout(function() {
            window.location.reload();
        }, 2000);
    });
</script>