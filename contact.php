<?php

include_once 'Database.php';

class ContactForm {
    private $db;
public function __construct() {
       $this->db = new Database();
    }
    public function saveContactForm($name, $email, $phone, $message) {
        try {
          
            $stmt = $this->db->connect()->prepare("INSERT INTO contacts (name, email, phone, message) VALUES (:name, :email, :phone, :message)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':message', $message);
            
           
            return $stmt->execute();
        } catch (PDOException $e) {
            
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

   
    $contactForm = new ContactForm();
    if ($contactForm->saveContactForm($name, $email, $phone, $message)) {
        $successMessage = "Thank you! Your message has been successfully sent.";
        echo $successMessage;
    } else {
        $errorMessage = "Sorry, there was an error sending your message. Please try again.";
        echo $errorMessage;
    }
}
?>
