<?php
// Database connection 
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

 
    public function updateFacility($id, $name, $imagePath) {
        $sql = "UPDATE facilities SET name = ?, image_path = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssi", $name, $imagePath, $id);
        return $stmt->execute();
    }

   
    public function getFacilityById($id) {
        $sql = "SELECT image_path FROM facilities WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

 
    public function uploadImage($imageFile) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($imageFile["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $uploadOk = 1;

    
        $check = getimagesize($imageFile["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }

      
        if ($imageFile["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

       
        if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

       
        if ($uploadOk == 0) {
            return false;
        } else {
           
            if (move_uploaded_file($imageFile["tmp_name"], $targetFile)) {
                return basename($imageFile["name"]); 
            } else {
                echo "Sorry, there was an error uploading your file.";
                return false;
            }
        }
    }
}

// Database connection
$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_POST['submit'])) {
    $id = $_POST['idh'];
    $name = $_POST['nameh'];
    $imagePath = "";

  
    $facility = new Facility($conn);

   
    if (isset($_FILES['imageh']) && $_FILES['imageh']['error'] == UPLOAD_ERR_OK) {
        $imagePath = $facility->uploadImage($_FILES['imageh']);
        if (!$imagePath) {
           
            exit;
        }
    } else {
       
        $facilityData = $facility->getFacilityById($id);
        $imagePath = $facilityData['image_path'];
    }

   
    if ($facility->updateFacility($id, $name, $imagePath)) {
        echo "The facility has been updated successfully.";
    } else {
        echo "Error updating facility.";
    }
}


$conn->close();
?>
