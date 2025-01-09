<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $templateParams["titolo"];?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <link href="css/style.css" rel="stylesheet" />
</head>

<body class="bg-dark text-custom">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm border-bottom border-secondary">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="homepage.php">
                <img src="img/logo.jpg" alt="PHPint Logo" width="40" class="me-2">
                <span class="fs-2 fw-bold text-warning">PHPint</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
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
                        <a <?php isActive("utente.php"); ?>
                            class="nav-link dropdown-toggle text-secondary d-flex align-items-center" href="#"
                            role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i> Area Personale
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end bg-dark border-secondary">
                            <li><a class="dropdown-item text-light" href="utente.php"><i class="bi bi-gear me-1"></i>
                                    Impostazioni</a></li>
                            <li><a class="dropdown-item text-light" href="venditore.php"><i
                                        class="bi bi-archive me-1"></i> Storico Ordini</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item text-light" href="logout.php"><i
                                        class="bi bi-box-arrow-right me-1"></i> Logout</a></li>
                        </ul>
                    </li>
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
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="border border-secondary rounded p-4">
                    <h2 class="text-center mb-4">Registrati</h2>
                    <?php if (!empty($message)): ?>
                        <div class="alert alert-info">
                            <?= htmlspecialchars($message) ?>
                        </div>
                    <?php endif; ?>
                    <form method="post">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome:</label>
                            <input type="text" name="nome" class="form-control" id="nome"
                                placeholder="Inserisci il tuo nome" required />
                        </div>
                        <div class="mb-3">
                            <label for="cognome" class="form-label">Cognome:</label>
                            <input type="text" name="cognome" class="form-control" id="cognome"
                                placeholder="Inserisci il tuo cognome" required />
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" name="email" class="form-control" id="email"
                                placeholder="Inserisci la tua email" required />
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username:</label>
                            <input type="text" name="username" class="form-control" id="username"
                                placeholder="Inserisci un username" required />
                        </div>
                        <div class="mb-3 position-relative">
                            <label for="password" class="form-label">Password:</label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control pe-5" id="password"
                                    placeholder="Inserisci una password" required />
                                <!-- Icona per mostrare/nascondere la password -->
                                <span class="input-group-text bg-white">
                                    <i class="bi bi-eye toggle-password" style="cursor: pointer;"></i>
                                </span>
                                <!-- Pulsante per generare una password casuale -->
                                <span class="input-group-text bg-white">
                                    <i class="bi bi-shuffle generate-password" style="cursor: pointer;"
                                        title="Genera password casuale"></i>
                                </span>
                            </div>
                            <!-- Indicatore della forza della password -->
                            <small id="passwordStrength" class="form-text mt-2"></small>
                        </div>

                        <!-- Messaggio di errore -->
                        <div class="alert alert-danger d-none" id="passwordError">
                            La password deve essere almeno "Forte" per procedere con la registrazione.
                        </div>

                        <div class="mb-3">
                            <label for="dataNascita" class="form-label">Data di Nascita:</label>
                            <input type="date" name="dataNascita" class="form-control" id="dataNascita" required />
                        </div>
                        <div class="alert alert-danger d-none" id="dataNascitaError">
                            Devi essere maggiorenne per registrarti!
                        </div>
                        <div class="row mb-3">
                            <div class="col-8">
                                <label for="citta" class="form-label">Città:</label>
                                <input type="text" name="citta" class="form-control" id="citta"
                                    placeholder="Inserisci la città" required />
                            </div>
                            <div class="col-4">
                                <label for="cap" class="form-label">CAP:</label>
                                <input type="text" name="cap" class="form-control" id="cap" placeholder="CAP"
                                    required />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="indirizzo" class="form-label">Indirizzo:</label>
                            <input type="text" name="indirizzo" class="form-control" id="indirizzo"
                                placeholder="Inserisci il tuo indirizzo" required />
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Telefono:</label>
                            <input type="tel" name="telefono" class="form-control" id="telefono"
                                placeholder="Inserisci il tuo numero di telefono" required />
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-warning w-100 fw-bold"
                                id="submitButton">Registrati!</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Divider aggiunto -->
    <div class="divider"></div>

    <!-- Footer -->
    <footer class="bg-dark py-4">
        <div class="container text-center">
            <a href="paginainformativa.html" class="d-block mb-2">Contatti</a>
            <a href="paginainformativa.html" class="d-block mb-2">Chi siamo?</a>
            <a href="paginainformativa.html">Specifiche aziendali</a>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/maggiorenne.js"></script>
</body>

</html>