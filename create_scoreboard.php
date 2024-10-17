<?php
$servername = "localhost"; // MariaDBサーバーのホスト名
$username = "xs333002_root"; // データベースユーザー名
$password = "Stemask1234"; // データベースパスワード
$dbname = "xs333002_stemscore"; // スキーマ名

// データベース接続
$conn = new mysqli($servername, $username, $password, $dbname);

// 接続確認
if ($conn->connect_error) {
    die("接続失敗: " . $conn->connect_error);
}

// リクエストからデータを取得
$data = json_decode(file_get_contents('php://input'), true);
$gameName = $data['gameName'];
$scoreType = $data['scoreType'];

// データベースに新しいスコアボードを追加
$sql = "INSERT INTO scoreboards (game_name, score_type) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $gameName, $scoreType);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "id" => $stmt->insert_id]);
} else {
    echo json_encode(["success" => false, "error" => $stmt->error]);
}

$stmt->close();
$conn->close();
?>