<?php
session_start();
include("db.php");

// 1. 安全檢查：必須登入才能看日誌
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// 2. 從資料庫撈取所有登入紀錄，並依照時間由新到舊排序 (DESC)
$sql = "SELECT * FROM dblog ORDER BY login_time DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>登入紀錄瀏覽</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .success { color: green; font-weight: bold; }
        .fail { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <h2>系統登入紀錄</h2>

    <a href="home.php">回首頁</a>

    <table>
        <tr>
            <th>編號 (ID)</th>
            <th>嘗試登入帳號</th>
            <th>登入時間</th>
            <th>狀態</th>
        </tr>

        <?php 
        // 3. 用迴圈把每一筆日誌印出來
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) { 
                
                // 判斷成功或失敗，並給予不同的文字和顏色
                if ($row["success"] == 1) {
                    $status_text = "<span class='success'>成功</span>";
                } else {
                    $status_text = "<span class='fail'>失敗</span>";
                }
        ?>
            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["username"]; ?></td>
                <td><?php echo $row["login_time"]; ?></td>
                <td><?php echo $status_text; ?></td>
            </tr>
        <?php 
            } // 迴圈結束
        } else {
            // 如果還沒有任何紀錄
            echo "<tr><td colspan='4'>目前沒有任何登入紀錄。</td></tr>";
        }
        ?>
    </table>

</body>
</html>