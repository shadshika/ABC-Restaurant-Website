<?php
// Database connection class
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

    //  update staff information
    public function updateStaff($id, $username, $email, $password) {
        // Hash the password for security
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

       
        $sql = "UPDATE staff SET username = ?, email = ?, password = ? WHERE id = ?";

       
        $stmt = $this->db->prepare($sql);
        if ($stmt === false) {
            die('Prepare failed: ' . $this->db->error);
        }

       
        $stmt->bind_param('sssi', $username, $email, $hashedPassword, $id);

      
        if ($stmt->execute()) {
            echo "Staff information updated successfully!";
        } else {
            echo "Error updating staff information: " . $stmt->error;
        }

       
        $stmt->close();
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    $staff_id = $_POST['staff_id'];
    $staff_username = $_POST['staff_username'];
    $staff_email = $_POST['staff_email'];
    $staff_password = $_POST['staff_password'];

 
    $database = new Database();

   
    $staff = new Staff($database);

    // Update the staff details
    $staff->updateStaff($staff_id, $staff_username, $staff_email, $staff_password);


    $database->close();
}
?>
