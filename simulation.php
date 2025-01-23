<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento Completato</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #212529; /* Sfondo scuro */
            color: #FFCC99; /* Testo chiaro */
            margin: 0;
        }

        .content {
            text-align: center;
            font-size: 1.5rem;
        }

        .spinner-border {
            width: 6rem;
            height: 6rem;
        }

        h1 {
            font-size: 3rem;
        }

        .thank-you-message {
            font-size: 1.8rem;
            margin-top: 20px;
        }

        a {
            font-size: 1.5rem;
            color: #ffc107;
            text-decoration: underline;
        }

        a:hover {
            color: #e0a800;
        }
    </style>
    <script>
        // Reindirizza alla homepage dopo 5 secondi
        setTimeout(function () {
            window.location.href = "utente.php";
        }, 5000);
    </script>
</head>

<body>
    <div class="content">
        <!-- Icona animata -->
        <div class="spinner-border text-warning" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <h1 class="text-warning mt-4">Pagamento completato con successo!</h1>
        <p class="thank-you-message">Grazie per aver acquistato da PHPint! Verrai reindirizzato alla tua area personale tra poco.</p>
        <p>Se il reindirizzamento non avviene automaticamente, <a href="homepage.php" class="text-warning">clicca qui</a>.</p>
    </div>
</body>

</html>
