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
    private $no;

    public function __construct($no) {
        $this->db = new Database();  
        $this->no = $this->sanitize($no);  
    }

  
    private function sanitize($data) {
        return htmlspecialchars(strip_tags($data));
    }

  
    public function search() {
        
        $stmt = $this->db->conn->prepare("SELECT * FROM reservations WHERE id = ?");

       
        if ($stmt === false) {
            die('Prepare() failed: ' . htmlspecialchars($this->db->conn->error));
        }

      
        $stmt->bind_param("i", $this->no);
        $stmt->execute();
        $result = $stmt->get_result();

       
        if ($result->num_rows > 0) {
          
            $reservation = $result->fetch_assoc();
            return $reservation;
        } else {
            return "No reservation found with the provided number.";
        }
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['no']) && !empty($_POST['no'])) {
        $no = $_POST['no'];

        $reservation = new Reservation($no);
        $result = $reservation->search();

        if (is_array($result)) {
            // Display reservation details
            echo "<h2>Reservation Details:</h2>";
            echo "<p><strong>No:</strong> " . htmlspecialchars($result['id']) . "</p>";
            echo "<p><strong>Name:</strong> " . htmlspecialchars($result['name']) . "</p>";
            echo "<p><strong>Email:</strong> " . htmlspecialchars($result['email']) . "</p>";
            echo "<p><strong>Date:</strong> " . htmlspecialchars($result['date']) . "</p>";
            echo "<p><strong>Time:</strong> " . htmlspecialchars($result['time']) . "</p>";
            echo "<p><strong>Number of People:</strong> " . htmlspecialchars($result['people']) . "</p>";
        } else {
            
            echo $result;
        }
    } else {
        echo "No reservation number provided.";
    }
}
?>
