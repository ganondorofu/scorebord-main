<?php
$servername = "localhost"; // MariaDBサーバーのホスト名
$username = "***REMOVED_DB_USER***"; // データベースユーザー名
$password = "***REMOVED_DB_PASSWORD***"; // データベースパスワード
$dbname = "***REMOVED_DB_NAME***"; // スキーマ名

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