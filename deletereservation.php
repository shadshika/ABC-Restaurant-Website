<?php
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

   
    public function deleteReservation($reservation_id) {
       
        $stmt = $this->db->conn->prepare("DELETE FROM reservations WHERE id = ?");
        
       
        if ($stmt === false) {
            die('Prepare() failed: ' . htmlspecialchars($this->db->conn->error));
        }

       
        $stmt->bind_param('s', $reservation_id);

       
        if ($stmt->execute()) {
            return $stmt->affected_rows > 0;  
        } else {
            return false;
        }

        
        $stmt->close();
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
    $reservation_id = $_POST['reservation_no']; 


    $reservation = new Reservation();

   
    if ($reservation->deleteReservation($reservation_id)) {
        echo "<script>alert('Reservation deleted successfully.'); window.location.href='index.html';</script>";
    } else {
        echo "<script>alert('Reservation not found or deletion failed.'); window.location.href='deletereservation.html';</script>";
    }
}
?>
