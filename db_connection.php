<?php
$servername = "localhost";  // データベースサーバーのホスト名 (一般的にlocalhost)
$username = "***REMOVED_DB_USER***";  // データベースのユーザー名
$password = "***REMOVED_DB_PASSWORD***";  // データベースのパスワード
$dbname = "***REMOVED_DB_NAME***";    // 使用するデータベースの名前

// データベース接続の作成
$conn = new mysqli($servername, $username, $password, $dbname);

// 接続の確認
if ($conn->connect_error) {
    die("接続失敗: " . $conn->connect_error);
}
?>
