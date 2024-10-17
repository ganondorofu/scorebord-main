<?php
$servername = "localhost";  // データベースサーバーのホスト名 (一般的にlocalhost)
$username = "xs333002_root";  // データベースのユーザー名
$password = "Stemask1234";  // データベースのパスワード
$dbname = "xs333002_stemscore";    // 使用するデータベースの名前

// データベース接続の作成
$conn = new mysqli($servername, $username, $password, $dbname);

// 接続の確認
if ($conn->connect_error) {
    die("接続失敗: " . $conn->connect_error);
}
?>
