<?php
session_start();
include("db.php");

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$id = $_GET["id"];
$sql = "SELECT * FROM dbmemo WHERE id='$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $content = $_POST["content"];

    $update_sql = "UPDATE dbmemo 
            SET title='$title', content='$content'
            WHERE id='$id'";

    if ($conn->query($update_sql) === TRUE) {
        header("Location: memo_list.php");
        exit();
    } else {
        $message = "修改失敗：" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>修改圖文</title>
</head>
<body>

<h2>修改圖文</h2>

<form method="post">
    標題：<input type="text" name="title" value="<?php echo $row["title"]; ?>"><br><br>
    內容：<br>
    <textarea name="content" rows="5" cols="40"><?php echo $row["content"]; ?></textarea><br><br>
    <input type="submit" value="更新">
</form>

<p><?php echo $message; ?></p>

<a href="memo_list.php">回列表</a>

</body>
</html>