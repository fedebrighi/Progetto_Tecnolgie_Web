<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $templateParams["titolo"];?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
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
                        <a <?php isActive("homepage.php");?> class="nav-link text-secondary d-flex align-items-center" href="homepage.php">
                            <i class="bi bi-house me-1"></i> Home
                        </a>
                    </li>

                    <!-- Link Prodotti -->
                    <li class="nav-item">
                        <a <?php isActive("catalogo_prodotti.php");?> class="nav-link text-secondary d-flex align-items-center" href="catalogo_prodotti.php">
                            <i class="bi bi-shop-window me-1"></i> Prodotti
                        </a>
                    </li>

                    <!-- Link Carrello -->
                    <li class="nav-item">
                        <a <?php isActive("carrello.php");?> class="nav-link text-secondary d-flex align-items-center" href="carrello.php">
                            <i class="bi bi-cart3 me-1"></i> Carrello
                        </a>
                    </li>

                    <!-- Link Login -->
                    <li class="nav-item">
                        <a <?php isActive("login.php");?>  class="nav-link text-secondary d-flex align-items-center" href="login.php">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Login
                        </a>
                    </li>

                    <!-- Area Personale -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-secondary d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i> Area Personale
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end bg-dark border-secondary">
                            <li><a <?php isActive("utente.php");?> class="dropdown-item text-light" href="utente.php"><i class="bi bi-gear me-1"></i> Impostazioni</a></li>
                            <li><a <?php isActive("venditore.php");?> class="dropdown-item text-light" href="venditore.php"><i class="bi bi-archive me-1"></i> Storico Ordini</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a <?php isActive("logout.php");?> class="dropdown-item text-light" href="logout.php"><i class="bi bi-box-arrow-right me-1"></i> Logout</a></li>
                        </ul>
                    </li>

                    <!-- Notifiche -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-secondary d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-bell"></i>
                            <span class="badge bg-danger rounded-pill ms-1" id="notification-count">3</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end bg-dark border-secondary">
                            <li><h6 class="dropdown-header text-warning">Notifiche</h6></li>
                            <li>
                                <a class="dropdown-item text-light d-flex justify-content-between align-items-center" href="#">
                                    <span>Nuovo ordine ricevuto</span>
                                    <button class="btn btn-sm btn-success ms-2">Segna come letto</button>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item text-light d-flex justify-content-between align-items-center" href="#">
                                    <span>Promozione scaduta</span>
                                    <button class="btn btn-sm btn-success ms-2">Segna come letto</button>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item text-light d-flex justify-content-between align-items-center" href="#">
                                    <span>Prodotto esaurito</span>
                                    <button class="btn btn-sm btn-success ms-2">Segna come letto</button>
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-light text-center" href="#">Visualizza tutte le notifiche</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="text-warning">Benvenuto su PHPint!</h1>
            <p class="text-light">Accedi per scoprire il mondo delle birre artigianali.</p>
        </div>

        <?php if (isset($templateParams["errorelogin"]) && !empty($templateParams["errorelogin"])): ?>
            <div class="alert alert-danger text-center" role="alert">
                <?php echo $templateParams["errorelogin"]; ?>
            </div>
        <?php endif; ?>
        <!-- Sezione Login -->
        <div class="row">
            <!-- Login Cliente -->
            <div class="col-md-6">
                <div class="border border-secondary rounded p-4">
                    <h2 class="text-center text-warning mb-4">Accesso per cliente</h2>
                    <form method="POST" action="login.php">
                        <div class="mb-3">
                            <label for="username" class="form-label text-light">Username:</label>
                            <input type="text" class="form-control" id="username" name="username"
                                placeholder="Inserisci il tuo username" />
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label text-light">Password:</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Inserisci la tua password" />
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-warning w-100 fw-bold">Accedi!</button>
                            
                        </div>
                    </form>
                </div>
            </div>

            <!-- Login Venditore -->
            <div class="col-md-6">
                <div class="border border-secondary rounded p-4">
                    <h2 class="text-center text-warning mb-4">Accesso per venditore</h2>
                    <form method="POST" action="login.php">
                        <div class="mb-3">
                            <label for="username" class="form-label text-light">Username:</label>
                            <input type="text" class="form-control" id="username" name="username"
                                placeholder="Inserisci il tuo username" />
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label text-light">Password:</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Inserisci la tua password" />
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-warning w-100 fw-bold">Accedi!</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Registrazione -->
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <aside class="border border-secondary rounded p-4 text-center">
                    <h2 class="text-warning mb-4"><i class="bi bi-person-plus"></i> Prima volta sul sito?</h2>
                    <form>
                        <button type="button" class="btn btn-warning w-100 fw-bold"
                            onclick="window.location.href='regCliente.html';">Registrati!</button>
                    </form>
                </aside>
            </div>
        </div>

    </div>

    
    <div class="divider"></div>
    <footer class="bg-dark py-2">
        <div class="container text-center">
            <a href="paginainformativa.html" class="d-block mb-2">Contatti</a>
            <a href="paginainformativa.html" class="d-block mb-2">Chi siamo?</a>
            <a href="paginainformativa.html">Specifiche aziendali</a>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
