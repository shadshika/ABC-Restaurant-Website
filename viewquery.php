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

    public function getConnection() {
        return $this->conn;
    }
}


class Contact {
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection(); 
    }

    // Retrieve all contact details
    public function getAllContacts() {
        
        $stmt = $this->db->prepare("SELECT * FROM contacts");

        if ($stmt === false) {
            die('Prepare() failed: ' . htmlspecialchars($this->db->error));
        }

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                return $result->fetch_all(MYSQLI_ASSOC);
            } else {
                return "No contacts found.";
            }
        } else {
            return "Error: " . htmlspecialchars($stmt->error);
        }
    }
}


$contact = new Contact();
$contacts = $contact->getAllContacts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Contacts - ABC Restaurant</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #e74c3c;
            color: white;
            font-size: 1.5rem;
            text-align: center;
        }

        table {
            width: 100%;
        }

        th, td {
            text-align: left;
            padding: 12px;
        }

        th {
            background-color: #e74c3c;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <div class="card-header">
            All Contacts
        </div>
        <div class="card-body">
            <?php if (is_array($contacts)): ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($contacts as $contact): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($contact['id']); ?></td>
                                <td><?php echo htmlspecialchars($contact['name']); ?></td>
                                <td><?php echo htmlspecialchars($contact['email']); ?></td>
                                <td><?php echo isset($contact['phone']) ? htmlspecialchars($contact['phone']) : 'N/A'; ?></td>
                                <td><?php echo htmlspecialchars($contact['message']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p><?php echo htmlspecialchars($contacts); ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
