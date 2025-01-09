<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PHPint - Carrello</title>
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

    <!-- Carrello -->
    <div class="container py-4">
        <!-- Scritta introduttiva -->
        <div class="text-center mb-4">
            <h2 class="text-warning">Ecco il tuo carrello!</h2>
            <p class="text-light">Controlla i prodotti selezionati e procedi al pagamento per completare l'acquisto.</p>
        </div>
        <div class="row gy-3">
            <?php
            $total = 0; // Inizializza il totale
            foreach ($templateParams["elementicarrello"] as $item):
                $birra = $dbh->getBeerDetails($item["codProdotto"]);
                $itemTotal = $birra["prezzo"] * $item["quantita"];
                $total += $itemTotal; // Somma il prezzo totale del prodotto
                ?>
                <div class="col-12 d-flex align-items-center border-bottom border-secondary pb-3">
                    <img src="img/beers/<?php echo $birra["immagine"] ?>" alt="<?php echo $birra["nome"] ?>"
                        class="img-fluid me-3" style="width: 80px;" />
                    <div class="flex-grow-1">
                        <h6 class="m-0"><?php echo $birra["nome"] ?></h6>
                        <p class="m-0">alc. <?php echo $birra["alc"] ?>% vol</p>
                        <p class="m-0 fw-bold"><?php echo $birra["prezzo"] ?> €</p>
                    </div>
                    <div class="d-flex flex-column align-items-center">
                        <input type="number" id="quantity<?php echo $item["quantita"]; ?>"
                            class="form-control mb-2 text-center" min="1" value="<?php echo $item["quantita"] ?>"
                            style="height: 40px;">
                        <button class="btn btn-warning btn-sm w-100 remove-from-cart"
                            data-id="<?php echo $item['codProdotto']; ?>">
                            Rimuovi dal carrello
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Sezione Totale -->
        <div class="mt-4 text-end">
            <h5 class="text-light">Totale: <span class="text-warning"><?= number_format($total, 2) ?> €</span></h5>
        </div>

        <!-- Pulsanti -->
        <div class="d-flex justify-content-between mt-4">
            <button class="btn btn-outline-light" type="button"
                onclick="window.location.href='catalogo_prodotti.php';">Continua a fare acquisti</button>
            <button class="btn btn-warning" type="button" onclick="window.location.href='checkout.php';">Procedi al
                pagamento</button>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark py-4">
        <div class="divider"></div>
        <div class="container text-center">
            <a href="paginainformativa.html" class="d-block mb-2">Contatti</a>
            <a href="paginainformativa.html" class="d-block mb-2">Chi siamo?</a>
            <a href="paginainformativa.html">Specifiche aziendali</a>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/rimuoviCarrello.js"></script>
</body>

</html>