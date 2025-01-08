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
        $query = "SELECT nome, alc, descrizione, prezzo, immagine FROM PRODOTTO WHERE codProdotto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $idBirra);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getIngredients($idBirra)
    {
        $query = "SELECT ingredienti FROM INGREDIENTI I WHERE I.codProdotto = ?";
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
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function emptyCart($codCarrello)
    {
        $query = "DELETE FROM COMPOSIZIONECARRELLO WHERE codCarrello = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $codCarrello);
        $stmt->execute();
    }

    public function saveUserInfo($nome, $cognome, $email, $username, $password, $dataNascita, $citta, $cap, $indirizzo, $telefono, )
    {
        $query = "INSERT INTO CLIENTI (nome, cognome, email, username, pw, data_nascita, citta, cap, indirizzo, telefono,)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT); // Hash della password
        $stmt->bind_param('sssssssssss', $nome, $cognome, $email, $username, $hashedPassword, $dataNascita, $citta, $cap, $indirizzo, $telefono, );

        if (!$stmt->execute()) {
            throw new Exception("Errore durante l'inserimento dell'utente: " . $stmt->error);
        }
    }

    public function getClientIfRegistered($username,$password)
    {
        $query = "SELECT * FROM CLIENTE WHERE username = ? AND pw = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_all(MYSQLI_ASSOC);    

    }

    public function getSellerIfRegistered($username,$password)
    {
        $query = "SELECT * FROM VENDITORE WHERE username = ? AND pw = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);

    }
}

?>