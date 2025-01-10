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
        $query = "SELECT codProdotto, nome, alc, prezzo, immagine FROM PRODOTTO";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getBeerDetails($idBirra)
    {
        $query = "SELECT codProdotto, nome, alc, descrizione, prezzo, immagine FROM PRODOTTO P WHERE P.codProdotto = ?";
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

    public function getCartFromUser($id)
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
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
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

    public function saveNewUser($nome, $cognome, $email, $username, $pw, $dataNascita, $citta, $cap, $indirizzo, $telefono): bool
    {
        // Crea un nuovo carrello vuoto
        $codCarrello = $this->createEmptyCart();

        // Salva l'utente con il carrello assegnato
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

    public function removeProductFromCart($username, $codProdotto): bool
    {
        $query = "DELETE FROM COMPOSIZIONECARRELLO WHERE codCarrello = (SELECT codCarrello FROM CARRELLO WHERE username = ?) AND codProdotto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si', $username, $codProdotto);
        $success = $stmt->execute();
        return $success;
    }

    public function saveUserInfo($nome, $cognome, $email, $username, $password, $dataNascita, $citta, $cap, $indirizzo, $telefono, $codCarrello)
    {
        $query = "INSERT INTO cliente (nome, cognome, email, username, password, dataNascita, citta, cap, indirizzo, telefono, codCarrello)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssssssssss', $nome, $cognome, $email, $username, $password, $dataNascita, $citta, $cap, $indirizzo, $telefono, $codCarrello);
        $stmt->execute();
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
}
