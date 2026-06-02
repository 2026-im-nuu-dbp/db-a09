<?php
session_start();
include("db.php");

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM dbmemo ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>圖文列表</title>
</head>
<body>
    <h2>圖文列表</h2>

    <a href="home.php">回首頁</a><br><br>

    <?php while ($row = $result->fetch_assoc()) { ?>
        <div style="border:1px solid black; margin-bottom:20px; padding:10px;">
            <p>編號：<?php echo $row["id"]; ?></p>
            <p>使用者ID：<?php echo $row["user_id"]; ?></p>
            <p>標題：<?php echo $row["title"]; ?></p>
            <p>內容：<?php echo nl2br($row["content"]); ?></p>
            <p>建立時間：<?php echo $row["created_at"]; ?></p>

            <?php if ($row["image"] != "") { ?>
                <img src="uploads/<?php echo $row["image"]; ?>" width="150"><br><br>
            <?php } ?>

            <a href="memo_edit.php?id=<?php echo $row["id"]; ?>">修改</a>
            <a href="memo_delete.php?id=<?php echo $row["id"]; ?>" onclick="return confirm('確定要刪除嗎？')">刪除</a>
        </div>
    <?php } ?>
</body>
</html>