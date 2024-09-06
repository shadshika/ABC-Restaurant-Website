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

 
    public function deleteStaff($id) {
      
        $sql = "DELETE FROM staff WHERE id = ?";

       
        $stmt = $this->db->prepare($sql);
        if ($stmt === false) {
            die('Prepare failed: ' . $this->db->error);
        }

        
        $stmt->bind_param('i', $id);

       
        if ($stmt->execute()) {
            echo "<div class='alert alert-success mt-3'>Staff member deleted successfully!</div>";
        } else {
            echo "<div class='alert alert-danger mt-3'>Error deleting staff member: " . $stmt->error . "</div>";
        }

       
        $stmt->close();
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
    $staff_id = isset($_POST['staff_id']) ? intval($_POST['staff_id']) : 0;

   
    if ($staff_id > 0) {
       
        $database = new Database();

     
        $staff = new Staff($database);

       
        $staff->deleteStaff($staff_id);

       
        $database->close();
    } else {
        echo "<div class='alert alert-warning mt-3'>Invalid staff ID provided.</div>";
    }
}
?>


