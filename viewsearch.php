<?php
// Database connection 
class Database {
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'abc_restaurant';
    public $conn;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
     
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);

      
        if ($this->conn->connect_error) {
            die('Connection failed: ' . $this->conn->connect_error);
        }
    }
}


class Reservation {
    private $db;

    public function __construct() {
        $this->db = new Database();  
    }

   
    public function getAllReservations() {
      
        $stmt = $this->db->conn->prepare("SELECT * FROM reservations");

       
        if ($stmt === false) {
            die('Prepare() failed: ' . htmlspecialchars($this->db->conn->error));
        }

        $stmt->execute();
        $result = $stmt->get_result();

        
        $reservations = [];
        while ($row = $result->fetch_assoc()) {
            $reservations[] = $row;
        }

        return $reservations;
    }
}


$reservation = new Reservation();
$reservations = $reservation->getAllReservations();


header('Content-Type: application/json');
echo json_encode($reservations);
?>
