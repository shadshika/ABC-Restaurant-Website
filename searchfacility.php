<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "abc_restaurant";

// Facility class
class Facility {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Search facility by name or ID
    public function searchFacility($query) {
        
        $sql = "SELECT * FROM facilities WHERE name LIKE ? OR id = ?";
        $stmt = $this->conn->prepare($sql);
        
        
        if (!$stmt) {
            die("Preparation failed: " . $this->conn->error);
        }
        
       
        $likeQuery = "%" . $query . "%";
        
       
        $stmt->bind_param("si", $likeQuery, $query);
        
        
        if (!$stmt->execute()) {
            die("Execution failed: " . $stmt->error);
        }

        
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

// Database connection
$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_GET['query'])) {
    $query = $_GET['query'];

   
    $facility = new Facility($conn);

    // Search for facilities
    $results = $facility->searchFacility($query);

    
    if (!empty($results)) {
        echo "<h2>Search Results:</h2>";
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Name</th><th>Image</th></tr>";
        foreach ($results as $row) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td><img src='uploads/" . htmlspecialchars($row['image_path']) . "' alt='" . htmlspecialchars($row['name']) . "' width='100'></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No facilities found matching your query.";
    }
} else {
    echo "Please enter a search query.";
}


$conn->close();
?>
