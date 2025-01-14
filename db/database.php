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

    public function getIngredients($idBirra)
    {
        $query = "SELECT ingrediente FROM INGREDIENTI I WHERE I.codProdotto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $idBirra);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
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

    public function updateTotalCart($tot, $username) {
        $query = "UPDATE CARRELLO SET totale = ? WHERE codCarrello = (SELECT codCarrello FROM CLIENTE WHERE username = ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('is', $tot, $username);
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

    public function updateCartQuantity($codCarrello, $codProdotto, $quantita) {
        $query = "UPDATE COMPOSIZIONECARRELLO SET quantita = ? WHERE codCarrello = ? AND codProdotto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iii', $quantita, $codCarrello, $codProdotto);
        $stmt->execute();
    }


    public function saveNewUser($nome, $cognome, $email, $username, $pw, $dataNascita, $citta, $cap, $indirizzo, $telefono): bool
    {
        $codCarrello = $this->createEmptyCart();
        $query = "INSERT INTO CLIENTE (nome, cognome, email, username, pw, dataNascita, citta, cap, indirizzo, telefono, codCarrello)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param(
            'sssssssssss',
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

    public function saveNewBeer($codProdotto, $codInfo, $nome, $alc, $descrizione, $prezzo, $quantita, $immagine): bool
    {
        $query = "INSERT INTO PRODOTTO (codProdotto, codInfo, nome, alc, descrizione, prezzo, quantitaMagazzino, immagine)
                  VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param(
            'iisdsdis',
            $codProdotto,
            $codInfo,
            $nome,
            $alc,
            $descrizione,
            $prezzo,
            $quantita,
            $immagine
        );

        return $stmt->execute(); // Restituisce true se l'inserimento ha avuto successo
    }
}
