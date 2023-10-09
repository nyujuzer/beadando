<?php
include "config.php";
include "functions.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $post_id = $_POST["post_id"];
    $username = $_SESSION["username"];

    $query = "SELECT id FROM users WHERE username='$username'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $user_id = $row["id"];

        $query = "SELECT * FROM likes WHERE post_id='$post_id' AND user_id='$user_id'";
        $result = $conn->query($query);

        if ($result->num_rows == 0) {
            $query = "INSERT INTO likes (post_id, user_id) VALUES ('$post_id', '$user_id')";
            $conn->query($query);
            array_push($_SESSION['liked'], $post_id);

        } else {
            $query = "DELETE FROM likes WHERE post_id='$post_id' AND user_id='$user_id'";
            $conn->query($query);
            $_SESSION["liked"]= remove($_SESSION["liked"], $post_id);
        }

        header("Location: index.php ");
    } else {
        echo "User not found.";
    }
}

?>
