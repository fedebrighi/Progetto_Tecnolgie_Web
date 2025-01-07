<?php 

    class   DatabaseHelper {

        private $db;

        public function __construct($servername, $username, $password, $dbname, $port) {
            $this->db = new mysqli($servername, $username, $password, $dbname, $port);
            if ($this->db->connect_error) {
                die("Connection failed: " . $this->db->connect_error);
            }
        }

        public function getBeerDetails($idBirra){
            $query = "SELECT nome, alc, descrizione, prezzo,immagine FROM PRODOTTO WHERE idBirra = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('i',$idBirra);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function getIngredients($idBirra){
            $query = "SELECT ingredienti FROM INGREDIENTI I WHERE I.codProdotto = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('i',$idBirra);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function getCartFromUser($id) {
            $query = "SELECT codCarrello, totale, codProdotto,nome, alc, quantita FROM CARRELLO CA,  COMPOSIZIONECARRELLO CC, PRODOTTO, P WHERE CA.codCarrello = ? AND CC.codCarrello = CA.codCarrello AND P.codProdotto = CC.codProdotto";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('i',$id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function emptyCart($codCarrello){
            $query = "DELETE FROM COMPOSIZIONECARRELLO WHERE codCarrello = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('i',$codCarrello);
            $stmt->execute();
        }
    }

?>