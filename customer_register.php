<?php
$servername = "localhost";
$username = "root"; 
$password = "";    
$dbname = "abc_restaurant"; 

class Database {
    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        $this->conn = new mysqli($servername, $username, $password, $dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}

class Customer {
    private $conn;
    private $table = 'customers';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function register($username, $email, $password, $phone, $address) {
       
        $stmt = $this->conn->prepare("INSERT INTO $this->table (username, email, password, phone, address) VALUES (?, ?, ?, ?, ?)");
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); 

        $stmt->bind_param("sssss", $username, $email, $hashed_password, $phone, $address);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

$database = new Database($servername, $username, $password, $dbname);
$db = $database->getConnection();

$customer = new Customer($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['customer_username'];
    $email = $_POST['customer_email'];
    $password = $_POST['customer_password'];
    $phone = $_POST['customer_phone'];
    $address = $_POST['customer_address'];

    if ($customer->register($username, $email, $password, $phone, $address)) {
        echo "Registration successful!";
    } else {
        echo "Registration failed. Please try again.";
    }
}
?>
