<?php
// staff_login.php
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
    public $password;

  
    public function __construct($db) {
        $this->conn = $db;
    }

  
    public function login() {
        $query = "SELECT * FROM " . $this->table . " WHERE username = :username LIMIT 1";

        
        $stmt = $this->conn->prepare($query);

        
        $this->username = htmlspecialchars(strip_tags($this->username));

       
        $stmt->bindParam(':username', $this->username);

        
        $stmt->execute();

       
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
          
            if (password_verify($this->password, $row['password'])) {
                return true;
            } else {
                echo "Invalid password.";
                return false;
            }
        } else {
            echo "Username not found.";
            return false;
        }
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $database = new Database();
    $db = $database->connect();

    $staff = new Staff($db);

 
    $staff->username = $_POST['usernameh'];
    $staff->password = $_POST['passwordh'];

   
    if ($staff->login()) {
        
        header("Location: staff panal.html");
        exit();
    } else {
        echo "Login failed. Please check your credentials.";
    }
}
?>
