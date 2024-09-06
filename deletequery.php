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

    public function getConnection() {
        return $this->conn;
    }
}


class Contact {
    private $db;
    private $contactId;

    public function __construct($contactId) {
        $this->db = (new Database())->getConnection(); 
        $this->contactId = $this->sanitize($contactId);
    }

    
    private function sanitize($data) {
        return htmlspecialchars(strip_tags($data));
    }

    
    public function delete() {
       
        $stmt = $this->db->prepare("DELETE FROM contacts WHERE id = ?");

        
        if ($stmt === false) {
            die('Prepare() failed: ' . htmlspecialchars($this->db->error));
        }

        $stmt->bind_param("i", $this->contactId);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                return "Contact with ID {$this->contactId} has been deleted successfully.";
            } else {
                return "No contact found with the given ID.";
            }
        } else {
            return "Error: " . htmlspecialchars($stmt->error);
        }
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $contactId = $_POST['no'];

    $contact = new Contact($contactId);
    $deleteResult = $contact->delete();

    
    echo "<p>" . htmlspecialchars($deleteResult) . "</p>";
}
?>
