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

   
    public function close() {
        $this->conn->close();
    }
}


class Staff {
    private $db;

   
    public function __construct($database) {
        $this->db = $database->conn;
    }

   
    public function searchStaff($searchTerm) {
      
        $sql = "SELECT id, username, email FROM staff WHERE id = ? OR username = ? OR email = ?";

      
        $stmt = $this->db->prepare($sql);
        if ($stmt === false) {
            die('Prepare failed: ' . $this->db->error);
        }

  
        $stmt->bind_param('iss', $searchTerm, $searchTerm, $searchTerm);

      
        if ($stmt->execute()) {
           
            $result = $stmt->get_result();

          
            if ($result->num_rows > 0) {
                // Display the search results
                while ($row = $result->fetch_assoc()) {
                    echo "ID: " . htmlspecialchars($row['id']) . "<br>";
                    echo "Username: " . htmlspecialchars($row['username']) . "<br>";
                    echo "Email: " . htmlspecialchars($row['email']) . "<br><br>";
                }
            } else {
                echo "No staff found with the provided details.";
            }
        } else {
            echo "Error searching for staff: " . $stmt->error;
        }

       
        $stmt->close();
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $searchTerm = isset($_POST['search_term']) ? trim($_POST['search_term']) : '';

    
    if (!empty($searchTerm)) {
        
        $database = new Database();

      
        $staff = new Staff($database);

       
        $staff->searchStaff($searchTerm);

       
        $database->close();
    } else {
        echo "Please enter a search term.";
    }
}
?>