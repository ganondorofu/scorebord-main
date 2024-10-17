<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "xs333002_root"; // データベースユーザー名
$password = "Stemask1234"; // パスワード
$dbname = "xs333002_stemscore"; // データベース名

// データベース接続
$conn = new mysqli($servername, $username, $password, $dbname);

// 接続確認
if ($conn->connect_error) {
    echo json_encode(["success" => false, "error" => "データベース接続エラー: " . $conn->connect_error]);
    exit();
}

// スコアボードのデータを取得
$sql = "SELECT id, game_name, score_type FROM scoreboards";
$result = $conn->query($sql);

$scoreboards = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $scoreboards[] = $row;
    }
}

// JSON形式でレスポンスを返す
echo json_encode($scoreboards);

$conn->close();
?>