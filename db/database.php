<?php 

    class   DatabaseHelper {

        private $db;

        public function __construct($servername, $username, $password, $dbname, $port) {
            $this->db = new mysqli($servername, $username, $password, $dbname, $port);
            if ($this->db->connect_error) {
                die("Connection failed: " . $this->db->connect_error);
            }    
        }

        public function getBeerDetails($name){
            $query = "SELECT idBirra, nomeBirra, testo FROM BIRRA WHERE nomeBirra = ?"; //da rivedere
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('i',$id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        }
    }

?>