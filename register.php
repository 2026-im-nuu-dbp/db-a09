<?php
include("db.php");

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $nickname = trim($_POST["nickname"]);
    $password = trim($_POST["password"]);
    $gender = trim($_POST["gender"]);
    $hobby = trim($_POST["hobby"]);

if (empty($username) || empty($password) || empty($nickname)) {
        $message = "錯誤：帳號、密碼與暱稱不能為空！";
    } else {
        //只有在不為空的情況下，才執行寫入資料庫的動作
        $sql = "INSERT INTO dbusers (username, nickname, password, gender, hobby)
                VALUES ('$username', '$nickname', '$password', '$gender', '$hobby')";

    if ($conn->query($sql) === TRUE) {
        $message = "註冊成功";
    } else {
        $message = "註冊失敗：" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>註冊</title>
</head>
<body>
    <h2>註冊頁面</h2>

<form method="post">
    帳號：<input type="text" name="username" required><br><br>
    暱稱：<input type="text" name="nickname" required><br><br>
    密碼：<input type="password" name="password" required><br><br>
    性別：<input type="text" name="gender"><br><br>
    興趣：<input type="text" name="hobby"><br><br>
    <input type="submit" value="送出">
</form>

    <p><?php echo $message; ?></p>

    <a href="login.php">前往登入</a>
</body>
</html>