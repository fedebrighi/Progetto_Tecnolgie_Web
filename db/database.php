<?php

class DatabaseHelper
{

    private $db;
    public function getDb()
    {
        return $this->db;
    }

    public function __construct($servername, $username, $password, $dbname, $port)
    {
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function getAllBeers()
    {
        $query = "SELECT * FROM PRODOTTO";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getBeerDetails($idBirra)
    {
        $query = "SELECT * FROM PRODOTTO P WHERE P.codProdotto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $idBirra);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getCart($username)
    {
        $query = "SELECT CL.codCarrello, CA.totale FROM UTENTE CL, CARRELLO CA WHERE username = ? AND CL.codCarrello = CA.codCarrello";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getCartFromUser($username)
    {
        $query = "SELECT CA.codCarrello, CA.totale,
                             P.codProdotto, P.nome,
                             P.alc, CC.quantita
                      FROM CARRELLO CA, COMPOSIZIONECARRELLO CC, PRODOTTO P, UTENTE CL
                      WHERE CL.username = ?
                      AND CA.codCarrello = CL.codCarrello
                      AND CC.codCarrello = CA.codCarrello
                      AND CC.codProdotto = P.codProdotto ";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateTotalCart($tot, $username)
    {
        $query = "UPDATE CARRELLO SET totale = ? WHERE codCarrello = (SELECT codCarrello FROM UTENTE WHERE username = ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ds', $tot, $username);
        $success = $stmt->execute();
        return $success;
    }

    public function createEmptyCart(): string
    {
        do {
            $cartId = bin2hex(random_bytes(8)); // Genera un ID univoco
            $queryCheck = "SELECT COUNT(*) AS count FROM CARRELLO WHERE codCarrello = ?";
            $stmtCheck = $this->db->prepare($queryCheck);
            $stmtCheck->bind_param('s', $cartId);
            $stmtCheck->execute();
            $result = $stmtCheck->get_result();
            $row = $result->fetch_assoc();
            $exists = $row['count'] > 0;
        } while ($exists);

        $queryInsert = "INSERT INTO CARRELLO (codCarrello, totale) VALUES (?, 0)";
        $stmtInsert = $this->db->prepare($queryInsert);
        $stmtInsert->bind_param('s', $cartId);
        $stmtInsert->execute();

        return $cartId;
    }

    public function removeProductFromCart($codCarrello, $codProdotto): bool
    {
        $query = "DELETE FROM COMPOSIZIONECARRELLO WHERE codCarrello = ? AND codProdotto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $codCarrello, $codProdotto);
        $success = $stmt->execute();
        return $success;
    }

    public function addProductToCart($codCarrello, $codProdotto, $quantita): bool
    {
        $success = false; // Inizializza $success come false
        try {
            // Verifica se il prodotto è già presente nel carrello
            $query = "SELECT quantita FROM COMPOSIZIONECARRELLO WHERE codCarrello = ? AND codProdotto = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ii', $codCarrello, $codProdotto);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows == 0) {
                $query = "INSERT INTO COMPOSIZIONECARRELLO (codCarrello, codProdotto, quantita) VALUES (?, ?, ?)";
                $stmt = $this->db->prepare($query);
                $stmt->bind_param('iii', $codCarrello, $codProdotto, $quantita);
                $success = $stmt->execute();
            } else {
                $row = $result->fetch_assoc();
                $nuovaQuantita = $row['quantita'] + $quantita;
                $query = "UPDATE COMPOSIZIONECARRELLO SET quantita = ? WHERE codCarrello = ? AND codProdotto = ?";
                $stmt = $this->db->prepare($query);
                $stmt->bind_param('iii', $nuovaQuantita, $codCarrello, $codProdotto);
                $success = $stmt->execute();
            }
            if (!$success) {
                throw new Exception("Errore nell'esecuzione della query.");
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
        return $success;
    }

    public function updateCartQuantity($codCarrello, $codProdotto, $quantita)
    {
        $query = "UPDATE COMPOSIZIONECARRELLO SET quantita = ? WHERE codCarrello = ? AND codProdotto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iii', $quantita, $codCarrello, $codProdotto);
        $stmt->execute();
    }

    public function getUserFavorites($username)
    {
        $stmt = $this->db->prepare("SELECT * FROM prodotto JOIN PREFERITI ON prodotto.codProdotto = preferiti.codProdotto WHERE preferiti.username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function isProductFavorite($username, $codProdotto)
    {
        $stmt = $this->db->prepare("SELECT * FROM PREFERITI WHERE username = ? AND codProdotto = ?");
        $stmt->bind_param("si", $username, $codProdotto);
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }

    public function addFavorite($username, $codProdotto)
    {
        $stmt = $this->db->prepare("INSERT INTO PREFERITI (username, codProdotto) VALUES (?, ?)");
        $stmt->bind_param("si", $username, $codProdotto);
        $stmt->execute();
    }

    public function removeFavorite($username, $codProdotto)
    {
        $stmt = $this->db->prepare("DELETE FROM PREFERITI WHERE username = ? AND codProdotto = ?");
        $stmt->bind_param("si", $username, $codProdotto);
        $stmt->execute();
    }

    public function saveNewUser($nome, $cognome, $email, $username, $pw, $dataNascita, $citta, $cap, $indirizzo, $telefono): bool
    {
        $codCarrello = $this->createEmptyCart();
        $query = "INSERT INTO UTENTE (nome, cognome, email, username, pw, dataNascita, citta, cap, indirizzo, telefono, codCarrello, tipo)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'cliente')";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param(
            'sssssssisis',
            $nome,
            $cognome,
            $email,
            $username,
            $pw,
            $dataNascita,
            $citta,
            $cap,
            $indirizzo,
            $telefono,
            $codCarrello
        );

        return $stmt->execute(); // Restituisce true se l'inserimento ha avuto successo
    }

    public function updateUser($username, $nome, $cognome, $email, $pw, $indirizzo, $citta, $cap, $telefono, $dataNascita)
    {
        $query = "UPDATE UTENTE
              SET nome = ?, cognome = ?, email = ?, pw = ?, indirizzo = ?, citta = ?, cap = ?, telefono = ?, dataNascita = ?
              WHERE username = ?";
        $stmt = $this->db->prepare($query);

        $stmt->bind_param('ssssssiiss', $nome, $cognome, $email, $pw, $indirizzo, $citta, $cap, $telefono, $dataNascita, $username);
        $stmt->execute();
    }

    public function getNextCod($tableName, $columnName)
    {
        // Proteggi il nome della tabella e della colonna da SQL injection
        $tableName = $this->db->real_escape_string($tableName);
        $columnName = $this->db->real_escape_string($columnName);

        // Prepara la query dinamica
        $query = "SELECT MAX($columnName) AS maxCod FROM $tableName";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // Calcola il prossimo codice
        $nextCod = isset($row['maxCod']) ? $row['maxCod'] + 1 : 1;

        return $nextCod;
    }

    public function salvaOrdine($username, $indirizzo, $citta, $cap, $note, $tipoSpedizione, $tipoPagamento, $totale, $prodotti,$scontoUsato)
    {
        $dataOrdine = date("Y-m-d");
        $dataPrevista = ($tipoSpedizione === "rapida") ? date("Y-m-d", strtotime("+5 days")) : date("Y-m-d", strtotime("+10 days"));
        $codiceOrdine = $this->getNextCod("ORDINE", "codiceOrdine"); // Genera un codice ordine unico
        if ($tipoSpedizione === "rapida") {
            $totale += 5;
        }
        $stato = "In Preparazione";
        try {
            // Inserisco le informazioni relative all'ordine
            $stmt = $this->db->prepare("
                INSERT INTO ORDINE (username, codiceOrdine, dataOrdine, dataPrevista, stato, totale, tipoPagamento, indirizzo, citta, cap, note, tipo,scontoUsato)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)
            ");
            $stmt->bind_param("sisssdsssissi", $username, $codiceOrdine, $dataOrdine, $dataPrevista, $stato, $totale, $tipoPagamento, $indirizzo, $citta, $cap, $note, $tipoSpedizione, $scontoUsato);
            $stmt->execute();

            // Inserisco i prodotti ordinati
            foreach ($prodotti as $item) {
                $stmt = $this->db->prepare("
                    INSERT INTO composizioneOrdine (codProdotto, username, codiceOrdine, quantita)
                    VALUES (?,?,?,?)
                ");
                $stmt->bind_param("isii", $item["codProdotto"], $username, $codiceOrdine, $item["quantita"]);
                $stmt->execute();
            }

            // Svuoto il carrello
            $codCarrello = $this->getCart($username)["codCarrello"];
            $stmt = $this->db->prepare("
                    DELETE FROM composizioneCarrello WHERE codCarrello = ?");
            $stmt->bind_param("i", $codCarrello);
            $stmt->execute();
            $stmt = $this->db->prepare("UPDATE CARRELLO SET totale = 0 WHERE codCarrello = ?");
            $stmt->bind_param("i", $codCarrello);
            $stmt->execute();

            // Elimino i prodotti ordinati dal magazzino
            foreach ($prodotti as $item) {
                $stmt = $this->db->prepare("
                    UPDATE PRODOTTO
                    SET quantitaMagazzino = quantitaMagazzino - ?
                    WHERE codProdotto = ?
                ");
                $stmt->bind_param("ii", $item["quantita"], $item["codProdotto"]);
                $stmt->execute();
            }

            // Aggiorno le statistiche delle vendite
            foreach ($prodotti as $item) {
                $quantita = $item["quantita"];
                $ricavo = $this->getBeerDetails($item["codProdotto"])["prezzo"] * $quantita;
                $codProdotto = $item["codProdotto"];
                $stmt = $this->db->prepare("
                    UPDATE INFO_VENDITA
                    SET quantitaVendute = quantitaVendute + ?,
                        ricavo = ricavo + ?
                    WHERE codInfo = ?
                    ");
                $stmt->bind_param("isi", $quantita, $ricavo, $codProdotto);
                $stmt->execute();
            }
        } catch (Exception $e) {
            throw new Exception("Errore durante il salvataggio dell'ordine: " . $e->getMessage());
        }
        return $codiceOrdine;
    }


    public function isClientLogged($username): bool
    {
        $query = "SELECT 1 FROM UTENTE WHERE username = ? AND tipo = 'cliente' LIMIT 1";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Restituisce true se viene trovato almeno un risultato, false altrimenti
        return $result->num_rows > 0;
    }


    public function getUserIfRegistered($username, $password)
    {
        $query = "SELECT * FROM UTENTE WHERE username = ? AND pw = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getClientByUsername($username)
    {
        $query = "SELECT * FROM UTENTE WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function getSeller()
    {
        $query = "SELECT * FROM UTENTE WHERE tipo = 'venditore'";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getOrdersByClientUsername($username)
    {
        $query = "SELECT * FROM ORDINE WHERE username = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Restituisce tutti gli ordini come array associativo multidimensionale
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getOrderByCod($codiceOrdine)
    {
        $query = "SELECT * FROM ORDINE WHERE codiceOrdine = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $codiceOrdine);
        $stmt->execute();
        $result = $stmt->get_result();

        // Restituisce tutti gli ordini come array associativo multidimensionale
        return $result->fetch_assoc();
    }

    public function getAllOrders()
    {
        $query = "SELECT * FROM ORDINE";

        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        // Restituisce tutti gli ordini come array associativo multidimensionale
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getOrderElementsByCod($codiceOrdine)
    {
        $query = "SELECT * FROM composizioneOrdine WHERE codiceOrdine = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $codiceOrdine);
        $stmt->execute();
        $result = $stmt->get_result();

        // Restituisce tutti gli ordini come array associativo multidimensionale
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getNextCodProdotto()
    {
        $query = "SELECT MAX(codProdotto) AS maxCodProdotto FROM PRODOTTO";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // Calcola il nuovo codProdotto
        $nextCodProdotto = isset($row['maxCodProdotto']) ? $row['maxCodProdotto'] + 1 : 1;

        return $nextCodProdotto;
    }

    public function saveNewSalesInfo($codInfo, $spesaUnitaria): bool
    {
        $query = "INSERT INTO INFO_VENDITA (codInfo, quantitaVendute, spesaUnitaria, ricavo)
                  VALUES (?,0,?,0)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param(
            'id',
            $codInfo,
            $spesaUnitaria
        );

        return $stmt->execute(); // Restituisce true se l'inserimento ha avuto successo
    }

    public function saveNewBeer($codProdotto, $codInfo, $nome, $alc, $descrizione, $listaIngredienti, $prezzo, $quantita, $immagine, $glutenFree): bool
    {
        $query = "INSERT INTO PRODOTTO (codProdotto, codInfo, nome, alc, descrizione, listaIngredienti, prezzo, quantitaMagazzino, immagine, glutenFree)
                    VALUES (?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param(
            'iisdssdisi',
            $codProdotto,
            $codInfo,
            $nome,
            $alc,
            $descrizione,
            $listaIngredienti,
            $prezzo,
            $quantita,
            $immagine,
            $glutenFree
        );

        return $stmt->execute(); // Restituisce true se l'inserimento ha avuto successo
    }

    public function updateProduct($idProdotto, $nome, $alc, $prezzo, $descrizione, $listaIngredienti, $glutenFree)
    {
        $query = "UPDATE PRODOTTO
              SET nome = ?, alc = ?, prezzo = ?, descrizione = ?, listaIngredienti = ?, glutenFree = ?
              WHERE codProdotto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sddssii', $nome, $alc, $prezzo, $descrizione, $listaIngredienti, $glutenFree, $idProdotto);
        $stmt->execute();
    }

    public function deleteProduct($codProdotto): bool
    {
        $query = "DELETE FROM PRODOTTO WHERE codProdotto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $codProdotto);

        return $stmt->execute();
    }

    public function deleteProductFromCart($codProdotto)
    {
        $query = "SELECT * FROM COMPOSIZIONECARRELLO WHERE codProdotto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $codProdotto);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows != 0) {
            $query = "DELETE FROM COMPOSIZIONECARRELLO WHERE codProdotto = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('i', $codProdotto);
            $stmt->execute();
        }
    }

    public function deleteProductFromOrder($codProdotto)
    {
        $query = "SELECT * FROM COMPOSIZIONEORDINE WHERE codProdotto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $codProdotto);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows != 0) {
            $query = "DELETE FROM COMPOSIZIONEORDINE WHERE codProdotto = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('i', $codProdotto);
            $stmt->execute();
        }
    }

    public function deleteProductFromReview($codProdotto)
    {
        $query = "SELECT * FROM RECENSIONE WHERE codProdotto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $codProdotto);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows != 0) {
            $query = "DELETE FROM RECENSIONE WHERE codProdotto = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('i', $codProdotto);
            $stmt->execute();
        }
    }

    public function deleteSalesInfo($codInfo): bool
    {
        $query = "DELETE FROM INFO_VENDITA WHERE codInfo = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $codInfo);

        return $stmt->execute();
    }

    public function updateOrderStatus($codiceOrdine, $nuovoStato, $data, $dataPrevista): bool
    {
        $validStates = ["In Preparazione", "Spedito", "In Consegna", "Consegnato"];
        if (!in_array($nuovoStato, $validStates, true)) {
            return false; // Stato non valido
        }

        if (!DateTime::createFromFormat('Y-m-d', $data)) {
            return false; // Data non valida
        }

        if (!DateTime::createFromFormat('Y-m-d', $dataPrevista)) {
            return false; // Data prevista non valida
        }

        // Query per aggiornare lo stato, le date e la data prevista
        $query = "UPDATE ORDINE SET
              stato = ?,
              dataSpedizione = CASE WHEN ? = 'Spedito' THEN ? ELSE dataSpedizione END,
              dataArrivo = CASE WHEN ? = 'Consegnato' THEN ? ELSE dataArrivo END,
              dataPrevista = ?
              WHERE codiceOrdine = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param(
            "ssssssi",
            $nuovoStato,
            $nuovoStato,
            $data,
            $nuovoStato,
            $data,
            $dataPrevista,
            $codiceOrdine
        );

        return $stmt->execute();
    }

    public function getAllSalesInfo()
    {
        $query = "SELECT I.*, P.nome FROM INFO_VENDITA I, PRODOTTO P
                  WHERE P.codInfo = I.codInfo";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addReview($username, $codProdotto, $valutazione, $testo = null)
    {
        // Prepara la query SQL
        $query = "INSERT INTO RECENSIONE (valutazione, testo, codProdotto, username) VALUES (?, ?, ?, ?)";
        // Prepara lo statement
        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            throw new Exception("Errore nella preparazione dello statement: " . $this->db->error);
        }
        // Collega i parametri con type hint
        $stmt->bind_param("isis", $valutazione, $testo, $codProdotto, $username);
        // Esegui lo statement
        if (!$stmt->execute()) {
            throw new Exception("Errore durante l'esecuzione dello statement: " . $stmt->error);
        }
        // Verifica se è stata aggiunta almeno una riga
        $success = $stmt->affected_rows > 0;
        // Chiudi lo statement
        $stmt->close();
        return $success;
    }


    public function updateReview($codRecensione, $valutazione, $testo = null)
    {
        $stmt = $this->db->prepare("UPDATE RECENSIONE SET valutazione = ?, testo = ?, dataModifica = NOW(), modificata = TRUE WHERE codRecensione = ?");
        $stmt->bind_param("isi", $valutazione, $testo, $codRecensione);
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }

    public function getUserReviews($username)
    {
        $stmt = $this->db->prepare("SELECT R.codRecensione, R.valutazione, R.testo, P.nome AS nomeProdotto, R.dataCreazione, R.dataModifica, R.modificata
                                    FROM RECENSIONE R
                                    JOIN PRODOTTO P ON R.codProdotto = P.codProdotto
                                    WHERE R.username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getProdottiNonRecensiti($username)
    {
        $query = "
            SELECT DISTINCT p.codProdotto, p.nome
            FROM composizioneOrdine co
            JOIN prodotto p ON co.codProdotto = p.codProdotto
            LEFT JOIN recensione r ON co.codProdotto = r.codProdotto AND co.username = r.username
            WHERE co.username = ? AND r.codRecensione IS NULL
        ";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getRandomReviews($num)
    {
        $query = "SELECT * FROM RECENSIONE ORDER BY RAND() LIMIT ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $num);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    public function getReviewsByProduct($codProdotto)
    {
        $stmt = $this->db->prepare("
            SELECT r.valutazione, r.testo, r.username
            FROM RECENSIONE r
            WHERE r.codProdotto = ?
        ");
        $stmt->bind_param("i", $codProdotto);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function createNotification($mittente, $destinatario, $message, $ref, $cod)
    {
        $query = "INSERT INTO NOTIFICA (mittente, destinatario, messaggio, dataInvio, riferimento, codiceRiferimento)
                    VALUES (?, ?, ?, NOW(), ?,?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssssi", $mittente, $destinatario, $message, $ref, $cod);
        $stmt->execute();
    }

    public function getAllUsers()
    {
        $query = "SELECT * FROM UTENTE";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function createNotificationBroadcast($mittente, $message, $ref, $cod)
    {
        try {
            $utenti = $this->getAllUsers();
            $query = "INSERT INTO NOTIFICA (mittente, destinatario, messaggio, dataInvio, riferimento, codiceRiferimento)
                    VALUES (?, ?, ?, NOW(), ?,?)";
            $stmt = $this->db->prepare($query);
            foreach ($utenti as $utente) {
                $stmt->bind_param("ssssi", $mittente, $utente['username'], $message, $ref, $cod);
                $stmt->execute();
            }
            $stmt->close();
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

    public function getUnreadNotifications($username)
    {
        $stmt = $this->db->prepare("SELECT * FROM NOTIFICA WHERE destinatario = ? AND letto = FALSE");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getUnreadNotificationsNum($username)
    {
        $query = "SELECT COUNT(*) AS numero FROM NOTIFICA WHERE destinatario = ? AND letto = FALSE";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getClientUsernameFromOrder($codOrdine)
    {
        $query = "SELECT username FROM ORDINE WHERE codiceOrdine = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $codOrdine);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function markAsRead($idNotifica): bool
    {
        $query = "UPDATE NOTIFICA SET letto = TRUE WHERE idNotifica = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $idNotifica);
        return $stmt->execute();
    }

    public function addToStorage($codProdotto, $quantita): bool
    {
        $query = "
            UPDATE PRODOTTO
            SET quantitaMagazzino = quantitaMagazzino + ?
            WHERE codProdotto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $quantita, $codProdotto);
        return $stmt->execute();
    }

    public function getTopClients()
    {
        $query = "
        SELECT username, SUM(totale) AS totale_speso
        FROM ORDINE
        GROUP BY username
        HAVING totale_speso > 0
        ORDER BY totale_speso DESC
        LIMIT 3";

        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        return $users;
    }

    public function getBestBeers(): array
    {
        $query = "
            SELECT
                P.*,
                AVG(R.valutazione) AS mediaValutazione,
                COUNT(R.codRecensione) AS numeroRecensioni
            FROM
                PRODOTTO P
            JOIN
                RECENSIONE R ON R.codProdotto = P.codProdotto
            GROUP BY
                P.codProdotto
            ORDER BY
                mediaValutazione DESC,
                numeroRecensioni DESC
            LIMIT 3
        ";

        $stmt = $this->db->prepare($query);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        return [];
    }

    public function verifyAndApplyCoupon($username, $couponCode)
    {
        // Prepara la query per cercare il coupon non utilizzato per l'utente
        $query = "SELECT * FROM coupons WHERE coupon_code = ? AND username = ? AND is_used = 0";
        $stmt = $this->db->prepare($query);

        // Lega i parametri alla query
        $stmt->bind_param("ss", $couponCode, $username); // "ss" indica che entrambi sono stringhe

        // Esegui la query
        $stmt->execute();

        // Recupera il risultato della query
        $result = $stmt->get_result();

        // Se c'è una riga, ritorna l'importo dello sconto come intero
        if ($result->num_rows > 0) {
            $coupon = $result->fetch_assoc(); // Ottieni il primo (e unico) risultato
            return (int) $coupon['discount_amount']; // Restituisci lo sconto come intero
        } else {
            return 0; // Se non c'è un coupon valido, restituisci 0
        }
    }

    public function markCouponAsUsed($couponCode)
    {
        // Prepara la query per aggiornare il coupon come utilizzato
        $query = "UPDATE coupons SET is_used = 1 WHERE coupon_code = ?";
        $stmt = $this->db->prepare($query);

        // Lega il parametro alla query
        $stmt->bind_param("s", $couponCode); // "s" indica che il parametro è una stringa

        // Esegui la query e restituisci il risultato
        return $stmt->execute();
    }

    public function createDiscountCoupon($username, $totalAmount)
    {
        // Calcola il 20% dell'importo totale speso
        $discountAmount = $totalAmount * 0.20;

        // Genera un codice coupon univoco
        $couponCode = "DISCOUNT_" . strtoupper(bin2hex(random_bytes(5))); // Usa un codice casuale

        // Inserisci il coupon nel database
        $query = "INSERT INTO coupons (username, coupon_code, discount_amount, is_used)
              VALUES (?, ?, ?, 0)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$username, $couponCode, $discountAmount]);

        return $couponCode; // Restituisci il codice coupon per la conferma
    }

    public function getClientCoupons($username)
    {
        // Prepara la query per recuperare tutti i coupon per l'utente specificato
        $query = "SELECT * FROM coupons WHERE username = ?";

        // Prepara e esegue la query
        $stmt = $this->db->prepare($query);
        $stmt->execute([$username]);

        if ($stmt->execute()) {
            $coupons = $stmt->get_result();
            return $coupons->fetch_all(MYSQLI_ASSOC);
        }
        return;
    }








}
