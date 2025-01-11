<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iscrizione Completata</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .loading-icon {
            font-size: 5rem;
            color: #ffc107;
            animation: spin 2s linear infinite;
            /* Applicazione animazione */
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .thank-you-message {
            margin-top: 20px;
            font-size: 1.5rem;
        }
    </style>
    <script>
        // Reindirizza alla pagina personale dopo 5 secondi
        setTimeout(function () {
            window.location.href = "utente.php";
        }, 3000);
    </script>
</head>

<body class="bg-dark text-light text-center">
    <div class="container py-5">
        <!-- Icona animata -->
        <div class="spinner-border text-warning" role="status" style="width: 5rem; height: 5rem;">
            <span class="visually-hidden">Loading...</span>
        </div>
        <h1 class="text-info mt-4">Iscrizione completata con successo!</h1>
        <p class="thank-you-message">Grazie per esserti iscritto al nostro sito. Sarai reindirizzato alla tua pagina personale tra pochi secondi.</p>
        <p>Se il reindirizzamento non avviene automaticamente, <a href="homepage.php" class="text-info">clicca qui</a>.</p>
    </div>
</body>

</html>
