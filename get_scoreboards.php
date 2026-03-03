<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'db_connection.php';

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