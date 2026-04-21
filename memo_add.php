<?php
session_start();
include("db.php");

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION["user_id"];
    $title = $_POST["title"];
    $content = $_POST["content"];
    $image_name = "";

    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $image_name = time() . "_" . $_FILES["image"]["name"];
        move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/" . $image_name);
    }

    $sql = "INSERT INTO dbmemo (user_id, title, content, image, created_at)
            VALUES ('$user_id', '$title', '$content', '$image_name', NOW())";

    if ($conn->query($sql) === TRUE) {
        $message = "新增成功";
    } else {
        $message = "新增失敗：" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>新增圖文</title>
</head>
<body>
    <h2></h2>新增圖文</h2>

    <form method="post" enctype="multipart/form-data">
        標題：<input type="text" name="title"><br><br>
        內容：<br>
        <textarea name="content" rows="5" cols="40"></textarea><br><br>
        圖片：<input type="file" name="image"><br><br>
        <input type="submit" value="新增">
    </form>

    <p><?php echo $message; ?></p>

    <a href="home.php">回首頁</a>
</body>
</html>