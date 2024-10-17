<?php
$servername = "localhost";
$username = "xs333002_root";
$password = "Stemask1234";
$dbname = "xs333002_stemscore";

// データベース接続
$conn = new mysqli($servername, $username, $password, $dbname);

// 接続確認
if ($conn->connect_error) {
    die("接続失敗: " . $conn->connect_error);
}

// リクエストからデータを取得
$data = json_decode(file_get_contents('php://input'), true);
$scoreboardId = $data['scoreboardId'];
$nickname = $data['name'];
$score = $data['score'];

// スコアをデータベースに追加
$sql = "INSERT INTO scores (scoreboard_id, nickname, score) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isi", $scoreboardId, $nickname, $score);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => $stmt->error]);
}

$stmt->close();
$conn->close();
?>