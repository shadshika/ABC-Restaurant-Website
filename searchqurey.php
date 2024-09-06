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


class Contact {
    private $db;
    private $contactId;

    public function __construct($contactId) {
        $this->db = new Database();
        $this->contactId = $this->sanitize($contactId);
    }

   
    private function sanitize($data) {
        return htmlspecialchars(strip_tags($data));
    }

   
    public function search() {
        $stmt = $this->db->conn->prepare("SELECT * FROM contacts WHERE id = ?");

        if ($stmt === false) {
            die('Prepare() failed: ' . htmlspecialchars($this->db->conn->error));
        }

        $stmt->bind_param("i", $this->contactId);

        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                return $result->fetch_assoc();
            } else {
                return "No contact found with the given ID.";
            }
        } else {
            return "Error: " . htmlspecialchars($stmt->error);
        }
    }
}


$searchResult = '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $contactId = $_POST['no'];

    $contact = new Contact($contactId);
    $searchResult = $contact->search();
}


if (is_array($searchResult)) {
    echo "<h4>Contact Details:</h4>";
    echo "<p><b>Contact ID:</b> " . htmlspecialchars($searchResult['id']) . "</p>";
    echo "<p><b>Name:</b> " . htmlspecialchars($searchResult['name']) . "</p>";
    echo "<p><b>Email:</b> " . htmlspecialchars($searchResult['email']) . "</p>";

 
    echo "<p><b>Phone No:</b> " . (isset($searchResult['phone']) ? htmlspecialchars($searchResult['phone']) : 'Not available') . "</p>";

    echo "<p><b>Message:</b> " . htmlspecialchars($searchResult['message']) . "</p>";
} elseif (!empty($searchResult)) {
    echo "<p>" . htmlspecialchars($searchResult) . "</p>";
}
?>
