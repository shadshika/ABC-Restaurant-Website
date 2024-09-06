<?php
session_start();
if (isset($_SESSION['user_id'])) {
    $_SESSION = array();
 if (session_status() == PHP_SESSION_ACTIVE) {
        session_destroy();
    }
header("Location: logout.html");
    exit();
} else {
 header("Location: login.html");
    exit();
}
?>
