<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>首頁</title>
</head>
<body>
    <h2>歡迎，<?php echo $_SESSION["username"]; ?></h2>

    <a href="memo_add.php">新增圖文</a><br><br>
    <a href="memo_list.php">查看圖文</a><br><br>
    <a href="logout.php">登出</a>
</body>
</html>