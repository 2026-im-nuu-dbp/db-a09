<?php
$host = "127.0.0.1";
$user = "root";
$pass = "";
$dbname = "db-a09";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("資料庫連線失敗：" . $conn->connect_error);
}

$conn->set_charset("utf8");
?>