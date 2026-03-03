<?php
// データベース接続情報
require_once 'db_connection.php';


// パラメータの取得と検証
$scoreboardId = isset($_GET['scoreboardId']) ? intval($_GET['scoreboardId']) : 0;
$sortOrder = isset($_GET['sortOrder']) && strtoupper($_GET['sortOrder']) === 'ASC' ? 'ASC' : 'DESC';

// スコア取得クエリ
$sql = "SELECT id, nickname, score FROM scores WHERE scoreboard_id = ? ORDER BY score $sortOrder";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $scoreboardId);
$stmt->execute();
$result = $stmt->get_result();

$scores = array();

while ($row = $result->fetch_assoc()) {
    $scores[] = $row; // idも含めて返す
}

echo json_encode($scores);

$stmt->close();
$conn->close();
?>
