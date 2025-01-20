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
        $query = "SELECT CL.codCarrello, CA.totale FROM CLIENTE CL, CARRELLO CA WHERE username = ? AND CL.codCarrello = CA.codCarrello";
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
                      FROM CARRELLO CA, COMPOSIZIONECARRELLO CC, PRODOTTO P, CLIENTE CL
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
        $query = "UPDATE CARRELLO SET totale = ? WHERE codCarrello = (SELECT codCarrello FROM CLIENTE WHERE username = ?)";
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
        $query = "INSERT INTO CLIENTE (nome, cognome, email, username, pw, dataNascita, citta, cap, indirizzo, telefono, codCarrello)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
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
        $query = "UPDATE CLIENTE
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

    public function salvaOrdine($username, $indirizzo, $citta, $cap, $note, $tipoSpedizione, $tipoPagamento, $totale, $prodotti)
    {
        $dataOrdine = date("Y-m-d");
        $dataPrevista = ($tipoSpedizione === "rapida") ? date("Y-m-d", strtotime("+5 days")) : date("Y-m-d", strtotime("+10 days"));
        $codiceOrdine = $this->getNextCod("ORDINE", "codiceOrdine"); // Genera un codice ordine unico
        $stato = "In Preparazione";
        try {
            // Inserisco le informazioni relative all'ordine
            $stmt = $this->db->prepare("
                INSERT INTO ORDINE (username, codiceOrdine, dataOrdine, dataPrevista, stato, totale, tipoPagamento, indirizzo, citta, cap, note, tipo)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt->bind_param("sisssdsssiss", $username, $codiceOrdine, $dataOrdine, $dataPrevista, $stato, $totale, $tipoPagamento, $indirizzo, $citta, $cap, $note, $tipoSpedizione);
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
    }


    public function isClientLogged($username): bool
    {
        $query = "SELECT 1 FROM CLIENTE WHERE username = ? LIMIT 1";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Restituisce true se viene trovato almeno un risultato, false altrimenti
        return $result->num_rows > 0;
    }


    public function getClientIfRegistered($username, $password)
    {
        $query = "SELECT * FROM CLIENTE WHERE username = ? AND pw = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getSellerIfRegistered($username, $password)
    {
        $query = "SELECT * FROM VENDITORE WHERE username = ? AND pw = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getClientByUsername($username)
    {
        $query = "SELECT * FROM CLIENTE WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function getSellerByUsername($username)
    {
        $query = "SELECT * FROM VENDITORE WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $username);
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
        error_log("inizio update");
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

        error_log("primi controlli passati");

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

        error_log("faccio l'esecuzione");
        return $stmt->execute();
    }


    public function getAllSalesInfo()
    {
        $query = "SELECT * FROM INFO_VENDITA";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
