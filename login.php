<?php
session_start();
include "./config.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $result = mysqli_fetch_assoc($result);
        $_SESSION["username"] = $username;
        $_SESSION['user'] = $result;
        $_SESSION['liked'] = array('init');
        header("Location: index.php");
    } else {
        echo "<div class='warning'>Hibás felhasználónév vagy jelszó</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="card">
            <form method="post" action="login.php">
                <label for="username">Felhasználónév:</label><br>
                <input type="text" name="username"><br>
                <label for="password">Jelszó:</label><br>
                <input type="password" name="password"><br>
                <input class="btn-submit-okay" type="submit" value="Bejelentkezés">
            </form>
            <a href="./regist.php">
                <h5>Nincs még fiókod?</h5>
            </a>
        </div>
    </div>
</body>

</html>