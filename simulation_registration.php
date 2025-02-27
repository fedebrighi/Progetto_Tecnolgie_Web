<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iscrizione Completata</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #212529;
            color: #FFCC99;
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
            color: #FFCC99;
        }

        a {
            font-size: 1.5rem;
            color: #FFCC99;
            text-decoration: underline;
        }
    </style>

    <script>
        setTimeout(function() {
            window.location.href = "homepage.php";
        }, 5000);
    </script>
</head>

<body>
    <div class="content">
        <div class="spinner-border text-warning" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <h1 class="text-warning mt-4">Iscrizione completata con successo!</h1>
        <p class="thank-you-message">Grazie per esserti iscritto al nostro sito.</p>
        <p>Se il reindirizzamento non avviene automaticamente, <a href="homepage.php" class="text-warning" style="color: #FFCC99">clicca qui</a>.</p>
    </div>
</body>

</html>