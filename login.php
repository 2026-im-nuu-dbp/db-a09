<?php
session_start();
include("db.php");

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM dbusers WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $_SESSION["user_id"] = $row["id"];
        $_SESSION["username"] = $row["username"];

        // 記錄成功
        $log_sql = "INSERT INTO dblog (username, login_time, success)
                    VALUES ('$username', NOW(), 1)";
        $conn->query($log_sql);

        // 👉 這裡是重點：跳轉到首頁
        header("Location: home.php");
        exit();

    } else {
        // 記錄失敗
        $log_sql = "INSERT INTO dblog (username, login_time, success)
                    VALUES ('$username', NOW(), 0)";
        $conn->query($log_sql);

        $message = "登入失敗";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>登入</title>
</head>
<body>
    <h2>登入頁面</h2>

    <form method="post">
        帳號：<input type="text" name="username"><br><br>
        密碼：<input type="password" name="password"><br><br>
        <input type="submit" value="登入">
    </form>

    <p><?php echo $message; ?></p>

    <a href="register.php">前往註冊</a>
</body>
</html>