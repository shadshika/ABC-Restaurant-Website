<?php
$connection = @mysqli_connect("localhost", "root", "", "abc_restaurant");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['usernameh']) && isset($_POST['passwordh'])) {
    $username = $_POST['usernameh'];
    $password = $_POST['passwordh'];
    
    $query = "SELECT * FROM admin WHERE username = ? AND password = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    
    if (mysqli_num_rows($result) > 0) {
      
        while ($row = mysqli_fetch_assoc($result)) {
            echo "Username: " . $row['username'] . "<br>";
            echo "Other field: " . $row['other_field'] . "<br>"; 
        }
        
        
        header("Location: adminnewpanel.html");
        exit();
    } else {
      
        echo "Invalid username or password.";
    }

 
    mysqli_stmt_close($stmt);
} else {
  
    echo "Username and password are required.";
}


mysqli_close($connection);
?>