<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $templateParams["titolo"]; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
        rel="stylesheet" />
    <link href="css/base_style.css" rel="stylesheet" />
</head>

<body class="bg-dark">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm border-bottom border-secondary">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center" href="paginainformativa.html">
                <img src="img/logo1.jpg" alt="PHPint Logo" width="130" class="me-2">
                <span class="fs-2 fw-bold">PHPint</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <!-- Link Home -->
                    <li class="nav-item text-center">
                        <a <?php isActive("homepage.php"); ?>
                            class="nav-link text-secondary d-flex flex-column align-items-center" href="homepage.php">
                            <i class="bi bi-house"></i>
                            <span>Home</span>
                        </a>
                    </li>

                    <!-- Link Prodotti -->
                    <li class="nav-item text-center">
                        <a <?php isActive("catalogo_prodotti.php"); ?>
                            class="nav-link text-secondary d-flex flex-column align-items-center"
                            href="catalogo_prodotti.php">
                            <i class="bi bi-shop-window"></i>
                            <span>Prodotti</span>
                        </a>
                    </li>

                    <!-- Link Carrello -->
                    <li class="nav-item text-center">
                        <a <?php isActive("carrello.php"); ?>
                            class="nav-link text-secondary d-flex flex-column align-items-center" href="carrello.php">
                            <i class="bi bi-cart3"></i>
                            <span>Carrello</span>
                        </a>
                    </li>

                    <!-- Link Preferiti -->
                    <li class="nav-item text-center">
                        <a <?php isActive("preferiti.php"); ?>
                            class="nav-link text-secondary d-flex flex-column align-items-center" href="preferiti.php">
                            <i class="bi bi-heart"></i>
                            <span>Preferiti</span>
                        </a>

                        <?php if (!isset($_SESSION["username"])): ?>
                            <!-- Link Login -->
                    <li class="nav-item text-center">
                        <a <?php isActive("login.php"); ?>
                            class="nav-link text-secondary d-flex flex-column align-items-center" href="login.php">
                            <i class="bi bi-box-arrow-in-right"></i>
                            <span>Login</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (isset($_SESSION["username"])): ?>
                    <!-- Area Personale -->
                    <li class="nav-item dropdown text-center">
                        <a class="nav-link dropdown-toggle text-secondary d-flex flex-column align-items-center"
                            href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person"></i>
                            <span>Area Personale</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end bg-dark border-secondary">
                            <?php if ($_SESSION["username"] == $_SESSION["venditore"]["username"]): ?>
                                <li><a <?php isActive("venditore.php"); ?> class="dropdown-item text-light text-center"
                                        href="venditore.php"><i class="bi bi-archive"></i><span>Management</span></a></li>
                            <?php else: ?>
                                <li><a <?php isActive("utente.php"); ?> class="dropdown-item text-light text-center"
                                        href="utente.php"><i class="bi bi-person-circle"></i><span>Profilo</span></a></li>
                            <?php endif; ?>
                            <hr class="dropdown-divider">
                            <li><a <?php isActive("logout.php"); ?> class="dropdown-item text-light text-center"
                                    href="logout.php"><i class="bi bi-box-arrow-right"></i><span>Logout</span></a></li>
                        </ul>
                    </li>

                        <!-- Notifiche -->
                        <li class="nav-item">
                            <a class="nav-link text-secondary d-flex align-items-center position-relative" href="notifiche.php">
                                <i class="bi bi-bell"></i>
                                <span class="badge bg-danger rounded-pill position-absolute top-0 start-100 translate-middle" style="display: none;">0</span>
                            </a>
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
                    <p style="color: #333333;">Via Famiglia Aspini 2 - 47122 Forlì FC, Italia</p>
                    <p style="color: #333333;">Email: supporto@phpint.it</p>
                    <p style="color: #333333;">Tel: +39 349 313 0068</p>
                </div>

                <!-- Colonna Navigazione -->
                <div class="col-md-4 mb-3">
                    <h5 class="fw-bold" style="color: #333333;">SU DI NOI</h5>
                    <ul class="list-unstyled">
                        <li><a href="paginainformativa.php#chi-siamo" class="text-decoration-none"
                                style="color: #333333;">Chi siamo?</a></li>
                        <li><a href="paginainformativa.php#certificazioni" class="text-decoration-none"
                                style="color: #333333;">Certificazioni di Qualità</a></li>
                        <li><a href="paginainformativa.php#contatti" class="text-decoration-none"
                                style="color: #333333;">Contattaci</a></li>
                    </ul>
                </div>

                <!-- Colonna Social e Pagamenti -->
                <div class="col-md-4">
                    <h5 class="fw-bold" style="color: #333333;">SEGUICI SU</h5>
                    <div class="d-flex justify-content-center mb-3">
                        <a href="#" class="mx-2" style="color: #333333; font-size: 1.5rem;"><i
                                class="bi bi-facebook"></i></a>
                        <a href="#" class="mx-2" style="color: #333333; font-size: 1.5rem;"><i
                                class="bi bi-instagram"></i></a>
                        <a href="#" class="mx-2" style="color: #333333; font-size: 1.5rem;"><i
                                class="bi bi-twitter"></i></a>
                        <a href="#" class="mx-2" style="color: #333333; font-size: 1.5rem;"><i
                                class="bi bi-youtube"></i></a>
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
            <hr style="border-color: #333333; ">
            <div class="text-center" style="color: #333333;">
                © 2025 <strong>PHPINT</strong>. Tutti i diritti non riservati.
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/gestioneNotifiche.js"></script>
</body>

</html>