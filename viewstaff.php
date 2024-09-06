<?php
// Database connection 
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

 
    public function getAllStaff() {
        $sql = "SELECT id, username, email FROM staff";
        $result = $this->db->query($sql);

        if ($result === false) {
            die('Query failed: ' . $this->db->error);
        }

        return $result;
    }
}


$database = new Database();


$staff = new Staff($database);


$staffMembers = $staff->getAllStaff();


$database->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABC Restaurant - View Staff</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS */
        body {
            background-color: #f8f9fa;
        }

        .view-container {
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .view-title {
            font-size: 2rem;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        .table th, .table td {
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- View Staff Table -->
    <div class="view-container">
        <h2 class="view-title">Staff Members</h2>
        <?php if ($staffMembers->num_rows > 0): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $staffMembers->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-center">No staff members found.</p>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
