<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $templateParams["titolo"]; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <link href="css/style.css" rel="stylesheet" />
</head>

<body class="bg-dark">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm border-bottom border-secondary">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center" href="homepage.html">
                <img src="img/logo.jpg" alt="PHPint Logo" width="40" class="me-2">
                <span class="fs-2 fw-bold text-warning">PHPint</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <!-- Link Home -->
                    <li class="nav-item">
                        <a <?php isActive("homepage.php"); ?> class="nav-link text-secondary d-flex align-items-center"
                            href="homepage.php">
                            <i class="bi bi-house me-1"></i> Home
                        </a>
                    </li>

                    <!-- Link Prodotti -->
                    <li class="nav-item">
                        <a <?php isActive("catalogo_prodotti.php"); ?>
                            class="nav-link text-secondary d-flex align-items-center" href="catalogo_prodotti.php">
                            <i class="bi bi-shop-window me-1"></i> Prodotti
                        </a>
                    </li>

                    <!-- Link Carrello -->
                    <li class="nav-item">
                        <a <?php isActive("carrello.php"); ?> class="nav-link text-secondary d-flex align-items-center"
                            href="carrello.php">
                            <i class="bi bi-cart3 me-1"></i> Carrello
                        </a>
                    </li>

                    <!-- Link Login -->
                    <li class="nav-item">
                        <a <?php isActive("login.php"); ?> class="nav-link text-secondary d-flex align-items-center"
                            href="login.php">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Login
                        </a>
                    </li>

                    <!-- Area Personale -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-secondary d-flex align-items-center" href="#"
                            role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i> Area Personale
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end bg-dark border-secondary">
                            <li><a <?php isActive("utente.php"); ?> class="dropdown-item text-light" href="utente.php"><i
                                        class="bi bi-gear me-1"></i> Impostazioni</a></li>
                            <li><a <?php isActive("venditore.php"); ?> class="dropdown-item text-light"
                                    href="venditore.php"><i class="bi bi-archive me-1"></i> Storico Ordini</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a <?php isActive("logout.php"); ?> class="dropdown-item text-light" href="logout.php"><i
                                        class="bi bi-box-arrow-right me-1"></i> Logout</a></li>
                        </ul>
                    </li>

                    <!-- Notifiche -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-secondary d-flex align-items-center" href="#"
                            role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-bell"></i>
                            <span class="badge bg-danger rounded-pill ms-1" id="notification-count">3</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end bg-dark border-secondary">
                            <li>
                                <h6 class="dropdown-header text-warning">Notifiche</h6>
                            </li>
                            <li>
                                <a class="dropdown-item text-light d-flex justify-content-between align-items-center"
                                    href="#">
                                    <span>Nuovo ordine ricevuto</span>
                                    <button class="btn btn-sm btn-success ms-2">Segna come letto</button>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item text-light d-flex justify-content-between align-items-center"
                                    href="#">
                                    <span>Promozione scaduta</span>
                                    <button class="btn btn-sm btn-success ms-2">Segna come letto</button>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item text-light d-flex justify-content-between align-items-center"
                                    href="#">
                                    <span>Prodotto esaurito</span>
                                    <button class="btn btn-sm btn-success ms-2">Segna come letto</button>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item text-light text-center" href="#">Visualizza tutte le
                                    notifiche</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <body class="bg-dark text-light">
    <div class="container py-5">
        <h1 class="text-center text-warning">Informazioni di spedizione</h1>
        <form method="post" action="simulation.php">
            <!-- Dati personali -->
            <div class="mb-3">
                <label for="indirizzo" class="form-label">Indirizzo:</label>
                <input type="text" class="form-control" id="indirizzo" name="indirizzo" placeholder="Inserisci il tuo indirizzo" required>
            </div>
            <div class="mb-3">
                <label for="citta" class="form-label">Città:</label>
                <input type="text" class="form-control" id="citta" name="citta" placeholder="Inserisci la città" required>
            </div>
            <div class="mb-3">
                <label for="cap" class="form-label">CAP:</label>
                <input type="text" class="form-control" id="cap" name="cap" placeholder="CAP" required>
            </div>
            <div class="mb-3">
                <label for="cellulare" class="form-label">Cellulare:</label>
                <input type="text" class="form-control" id="cellulare" name="cellulare" placeholder="Inserisci il tuo numero di cellulare" required>
            </div>

            <!-- Tipo di spedizione -->
            <div class="mb-3">
                <label class="form-label">Tipo di spedizione:</label><br>
                <input type="radio" id="standard" name="spedizione" value="standard" checked>
                <label for="standard">Standard</label><br>
                <input type="radio" id="rapida" name="spedizione" value="rapida">
                <label for="rapida">Rapida</label>
            </div>

            <!-- Note per il corriere -->
            <div class="mb-3">
                <label for="note" class="form-label">Note per il corriere:</label>
                <textarea class="form-control" id="note" name="note" rows="3"></textarea>
            </div>

            <!-- Metodo di pagamento -->
            <div class="form-check">
                        <input type="radio" class="form-check-input" name="pagamento" id="pagamentoCarta" checked />
                        <label for="pagamentoCarta" class="form-check-label">Carta di credito</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="pagamento" id="pagamentoApplePay" />
                        <label for="pagamentoApplePay" class="form-check-label">ApplePay</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="pagamento" id="pagamentoGooglePay" />
                        <label for="pagamentoGooglePay" class="form-check-label">GooglePay</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="pagamento" id="pagamentoPaypal" />
                        <label for="pagamentoPaypal" class="form-check-label">PayPal</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="pagamento" id="pagamentoContrassegno" />
                        <label for="pagamentoContrassegno" class="form-check-label">Pagamento alla consegna</label>
                    </div>
            <button type="submit" class="btn btn-warning w-100">Procedi al pagamento</button>
        </form>
    </div>
</body>

    <div class="divider"></div>
    <footer class="bg-dark py-2">
        <div class="container text-center">
            <a href="paginainformativa.html" class="d-block mb-2">Contatti</a>
            <a href="paginainformativa.html" class="d-block mb-2">Chi siamo?</a>
            <a href="paginainformativa.html">Specifiche aziendali</a>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/carousel.js"></script>
</body>

</html>
