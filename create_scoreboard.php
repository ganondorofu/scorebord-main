<?php
require_once 'db_connection.php';


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