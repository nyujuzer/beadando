<?php
include "./config.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    $checkQuery = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($checkQuery);
    
    if ($result->num_rows == 0) {
        $insertQuery = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        
        if ($conn->query($insertQuery) === TRUE) {
            header("location: login.php");
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
       echo  '<div class="warning">
            Username is in use. Please choose a different username
        </div>';
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>

    <div class="container">
        <div class="card">
            <form method="post" action="regist.php">
                <label for="username">Felhasználónév:</label><br>
                <input type="text" name="username"><br>
                <label for="password">Jelszó</label><br>
                <input type="password" name="password"><br>
                <input class="btn-submit-okay" type="submit" value="Regisztráció">
            </form>
        </div>
    </div>
</body>

</html>