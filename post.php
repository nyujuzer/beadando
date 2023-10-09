<?php
include "config.php";
session_start();
print_r($_SESSION);
echo $_SESSION['user']["id"];
$user_id = $_SESSION['user']["id"]; 
$post_content = $_POST["content"]; 

$user_id = mysqli_real_escape_string($conn, $user_id);
$post_content = mysqli_real_escape_string($conn, $post_content);

$insertQuery = "INSERT INTO posts (user_id, content) VALUES ('$user_id', '$post_content')";

if ($conn->query($insertQuery) === TRUE) {
    header("location:index.php");
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
