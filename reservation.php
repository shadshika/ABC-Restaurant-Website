<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


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
}


class Reservation {
    private $db;
    private $name;
    private $email;
    private $date;
    private $time;
    private $people;

    public function __construct($name, $email, $date, $time, $people) {
        $this->db = new Database();
        $this->name = $this->sanitize($name);
        $this->email = $this->sanitize($email);
        $this->date = $this->sanitize($date);
        $this->time = $this->sanitize($time);
        $this->people = $this->sanitize($people);
    }

   
    private function sanitize($data) {
        return htmlspecialchars(strip_tags($data));
    }

    public function save() {
        $stmt = $this->db->conn->prepare("INSERT INTO reservations (name, email, date, time, people) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $this->name, $this->email, $this->date, $this->time, $this->people);

        return $stmt->execute();
    }

    
    public function sendEmail() {
        $mail = new PHPMailer(true);
        try {
            // SMTP server configuration
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'shadshishakshi@gmail.com';  
            $mail->Password = 'rjzp atle nzzx kebl';  
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('shadshishakshi@gmail.com', 'ABC Restaurant'); 
            $mail->addAddress($this->email);  
            $mail->addReplyTo('shadshishakshi@gmail.com', 'ABC Restaurant');  
            // Email content
            $mail->isHTML(true);
            $mail->Subject = 'Your Booking Confirmation';
            $mail->Body = "<strong>Dear {$this->name},</strong><br><br>
                          Thank you for your Booking at ABC Restaurant.  your booking details:<br>
                          <strong>Date:</strong> {$this->date}<br>
                          <strong>Time:</strong> {$this->time}<br>
                          <strong>Number of People:</strong> {$this->people}<br><br>
                          we're dedicated to giving you the best experience possible.<br><br>
                          if you have any question, feel free to get in touch
                          Best regards,<br>
                          Location<br>
                          Colombo, Sri Lanka<br>
                          Phone<br>
                          +94 123 456 789<br>
                          Email<br>
                          contact@abcrestaurant.lk";

            $mail->send();
            return true;
        } catch (Exception $e) {
            return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}

// Processing the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $people = $_POST['people'];

    $reservation = new Reservation($name, $email, $date, $time, $people);
    if ($reservation->save()) {
        if ($reservation->sendEmail()) {
            echo "Your booking has been successfully submitted and a confirmation email has been sent!";
        } else {
            echo "Your booking has been submitted, but there was an error sending the confirmation email.";
        }
    } else {
        echo "There was an error submitting your booking. Please try again.";
    }
}
?>
