<?php
// staff_registration.php
class Database {
    private $host = 'localhost';
    private $db_name = 'abc_restaurant';
    private $username = 'root';
    private $password = '';
    public $conn;

    // Database connection
    public function connect() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}

class Staff {
    private $conn;
    private $table = 'staff';

    public $username;
    public $email;
    public $password;

   
    public function __construct($db) {
        $this->conn = $db;
    }

  
    public function register() {
        $query = "INSERT INTO " . $this->table . " (username, email, password) VALUES (:username, :email, :password)";

       
        $stmt = $this->conn->prepare($query);

      
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = password_hash($this->password, PASSWORD_DEFAULT); 

       
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);

       
        if ($stmt->execute()) {
            return true;
        }

        
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $database = new Database();
    $db = $database->connect();

    $staff = new Staff($db);

 
    $staff->username = $_POST['staff_username'];
    $staff->email = $_POST['staff_email'];
    $staff->password = $_POST['staff_password'];

   
    if ($staff->register()) {
        echo "Staff registered successfully.";
    } else {
        echo "Staff registration failed.";
    }
}
?>
