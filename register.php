<?php
include("db.php");

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $nickname = $_POST["nickname"];
    $password = $_POST["password"];
    $gender = $_POST["gender"];
    $hobby = $_POST["hobby"];

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
        帳號：<input type="text" name="username"><br><br>
        暱稱：<input type="text" name="nickname"><br><br>
        密碼：<input type="password" name="password"><br><br>
        性別：<input type="text" name="gender"><br><br>
        興趣：<input type="text" name="hobby"><br><br>
        <input type="submit" value="送出">
    </form>

    <p><?php echo $message; ?></p>

    <a href="login.php">前往登入</a>
</body>
</html>