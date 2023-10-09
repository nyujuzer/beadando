<?php
session_start();
include "config.php";
include "functions.php";
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION["username"];
$query = "SELECT posts.id, posts.content, users.username, COUNT(likes.id) AS like_count
          FROM posts
          LEFT JOIN users ON posts.user_id = users.id
          LEFT JOIN likes ON posts.id = likes.post_id
          GROUP BY posts.id";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="./css/style.css">
    <title>Hírfolyam</title>
</head>

<body>
    <h1>
        <?php echo $username; ?> Hírfolyama
    </h1>

        <label for="content">Új poszt létrehozása:</label><br>
        <textarea name="content" id="post_content" rows="4" cols="50" required></textarea>
        <br>
        <input type="submit" value="Küldés">
    </form>

    <?php
    include_once "functions.php";
    while ($row = $result->fetch_assoc()) {
        $post_id = $row["id"];
        $_SESSION["liked"] = array_unique($_SESSION['liked']);
        $isLiked = in_array($post_id, $_SESSION['liked']);
        $likeText = $isLiked ? "unlike" : "like";
        ?>
        <div class="post">
            <p><strong>
                    <?php echo $row["username"]; ?>
                </strong></p>
            <p>
                <?php echo $row["content"]; ?>
            </p>
            <p>Like-k száma:
                <?php echo $row["like_count"]; ?>
            </p>
            <form method="post" action="like.php">
                <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                <input type="hidden" name="like_action" value="<?php echo $likeText; ?>">
                <input type="submit" value="<?php echo $likeText; ?>">
            </form>
        </div>
    <?php } ?>
</body>

</html>
