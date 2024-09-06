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

    // Delete facility by ID
    public function deleteFacility($id) {
   
        $imagePath = $this->getFacilityImagePathById($id);
        if ($imagePath) {
            $filePath = "uploads/" . $imagePath;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $sql = "DELETE FROM facilities WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        
        return $stmt->execute();
    }

    // Get the image path of a facility by ID
    private function getFacilityImagePathById($id) {
        $sql = "SELECT image_path FROM facilities WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $facility = $result->fetch_assoc();
        return $facility ? $facility['image_path'] : null;
    }
}

// Database connection
$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    
    $facility = new Facility($conn);

   
    if ($facility->deleteFacility($id)) {
        echo "The facility has been deleted successfully.";
    } else {
        echo "Error deleting facility.";
    }
}


$conn->close();
?>
