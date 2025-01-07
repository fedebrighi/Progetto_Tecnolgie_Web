<?php

class DatabaseHelper
{

    private $db;

    public function __construct($servername, $username, $password, $dbname, $port)
    {
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function getBeerDetails($idBirra)
    {
        $query = "SELECT nome, alc, descrizione, prezzo,immagine FROM PRODOTTO WHERE idBirra = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $idBirra);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
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
        $query = "SELECT CA.codCarrello AS carrello_id, CA.totale AS totale_carrello,
                             P.codProdotto AS prodotto_id, P.nome AS prodotto_nome,
                             P.alc AS prodotto_alc, CC.quantita AS prodotto_quantita
                      FROM CARRELLO CA
                      JOIN COMPOSIZIONECARRELLO CC ON CC.codCarrello = CA.codCarrello
                      JOIN PRODOTTO P ON P.codProdotto = CC.codProdotto
                      WHERE CA.codCarrello = ?";
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
}

?>