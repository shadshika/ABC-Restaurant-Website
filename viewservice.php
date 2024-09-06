<?php
// Database connection 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "abc_restaurant";

// Service class
class Service {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Function to get all services
    public function getAllServices() {
        $sql = "SELECT * FROM services";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

// Database connection
$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$service = new Service($conn);


$services = $service->getAllServices();


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Services</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 1000px;
        }
        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            max-width: 100px;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>View Services</h2>
        <?php if (!empty($services)) : ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Image</th>
                </tr>
                <?php foreach ($services as $service) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($service['id']); ?></td>
                        <td><?php echo htmlspecialchars($service['name']); ?></td>
                        <td><img src="uploads/<?php echo htmlspecialchars($service['image_path']); ?>" alt="<?php echo htmlspecialchars($service['name']); ?>"></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else : ?>
            <p>No services found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
