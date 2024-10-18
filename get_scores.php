<?php
// データベース接続情報
$servername = "localhost";
$username = "xs333002_root";
$password = "Stemask1234";
$dbname = "xs333002_stemscore";

// DB接続
$conn = new mysqli($servername, $username, $password, $dbname);

// 接続確認
if ($conn->connect_error) {
    die("接続失敗: " . $conn->connect_error);
}

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
