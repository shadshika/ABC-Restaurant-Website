<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "abc_restaurant";


class Service {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

   
    public function deleteService($id) {
    
        $sql = "SELECT image_path FROM services WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $service = $result->fetch_assoc();

        if ($service) {
            $imagePath = $service['image_path'];
            
            $sql = "DELETE FROM services WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
              
                if (!empty($imagePath) && file_exists("uploads/" . $imagePath)) {
                    unlink("uploads/" . $imagePath);
                }
                return true;
            }
        }
        return false;
    }
}

// Database connection
$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $serviceId = $_POST['serviceId'];

   
    $service = new Service($conn);

   
    if ($service->deleteService($serviceId)) {
        echo "The service has been deleted successfully.";
    } else {
        echo "Error deleting service. Please make sure the service ID is correct.";
    }
}


$conn->close();
?>
