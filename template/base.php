<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $templateParams["titolo"]; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
        rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
</head>

<body class="bg-dark">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm border-bottom border-secondary">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center" href="homepage.html">
                <img src="img/logo.jpg" alt="PHPint Logo" width="40" class="me-2">
                <span class="fs-2 fw-bold">PHPint</span>
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
                    <?php if (!isset($_SESSION["username"])): ?>
                        <!-- Link Login -->
                        <li class="nav-item">
                            <a <?php isActive("login.php"); ?> class="nav-link text-secondary d-flex align-items-center"
                                href="login.php">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Login
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (isset($_SESSION["username"])): ?>
                        <!-- Area Personale -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-secondary d-flex align-items-center" href="#"
                                role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i> Area Personale
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end bg-dark border-secondary">
                                <li><a <?php isActive("utente.php"); ?> class="dropdown-item text-light"
                                        href="utente.php"><i class="bi bi-gear me-1"></i> Impostazioni</a></li>
                                <li><a <?php isActive("venditore.php"); ?> class="dropdown-item text-light"
                                        href="venditore.php"><i class="bi bi-archive me-1"></i> Storico Ordini</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a <?php isActive("logout.php"); ?> class="dropdown-item text-light"
                                        href="logout.php"><i class="bi bi-box-arrow-right me-1"></i> Logout</a></li>
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
                                    <h2 class="dropdown-header text-warning">Notifiche</h2>
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
                                    <hr class="dropdown-divider" />
                                </li>
                                <li><a class="dropdown-item text-light text-center" href="#">Visualizza tutte le
                                        notifiche</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <?php if (isset($templateParams["nome"])) {
        require($templateParams["nome"]);
    }
    ?>

<footer class="py-4" style="background-color: #FFCC99;">
    <div class="container">
        <div class="row text-center">
            <!-- Colonna Informazioni -->
            <div class="col-md-4 mb-3">
                <h5 class="fw-bold" style="color: #333333;">PHPINT</h5>
                <p style="color: #333333;">Via dell'Università, 18 - 47521 Cesena FC, Italia</p>
                <p style="color: #333333;">Email: supporto@phpint.it</p>
                <p style="color: #333333;">Tel: +39 349 313 0068</p>
            </div>

            <!-- Colonna Navigazione -->
            <div class="col-md-4 mb-3">
                <h5 class="fw-bold" style="color: #333333;">SU DI NOI</h5>
                <ul class="list-unstyled">
                    <li><a href="paginainformativa.html#chi-siamo" class="text-decoration-none" style="color: #333333;">Chi siamo?</a></li>
                    <li><a href="paginainformativa.html#certificazioni" class="text-decoration-none" style="color: #333333;">Certificazioni di Qualità</a></li>
                    <li><a href="paginainformativa.html#contatti" class="text-decoration-none" style="color: #333333;">Contattaci</a></li>
                </ul>
            </div>

            <!-- Colonna Social e Pagamenti -->
            <div class="col-md-4">
                <h5 class="fw-bold" style="color: #333333;">SEGUICI SU</h5>
                <div class="d-flex justify-content-center mb-3">
                    <a href="#" class="mx-2" style="color: #333333; font-size: 1.5rem;"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="mx-2" style="color: #333333; font-size: 1.5rem;"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="mx-2" style="color: #333333; font-size: 1.5rem;"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="mx-2" style="color: #333333; font-size: 1.5rem;"><i class="bi bi-youtube"></i></a>
                </div>
                <h5 class="fw-bold" style="color: #333333;">PAGAMENTI ACCETTATI</h5>
                <div class="d-flex justify-content-center">
                    <i class="bi bi-credit-card mx-2" style="color: #333333; font-size: 1.5rem;"></i>
                    <i class="bi bi-apple mx-2" style="color: #333333; font-size: 1.5rem;"></i>
                    <i class="bi bi-google mx-2" style="color: #333333; font-size: 1.5rem;"></i>
                    <i class="bi bi-paypal mx-2" style="color: #333333; font-size: 1.5rem;"></i>
                </div>
            </div>
        </div>
        <hr style="border-color: #333333; margin: 1rem 0;">
        <div class="text-center" style="color: #333333;">
            © 2025 <strong>PHPINT</strong>. Tutti i diritti non riservati.
        </div>
    </div>
</footer>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>