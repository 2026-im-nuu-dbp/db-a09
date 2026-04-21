<?php
session_start();
include("db.php");

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $sql = "DELETE FROM dbmemo WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: memo_list.php");
        exit();
    } else {
        echo "刪除失敗：" . $conn->error;
    }
}
?>