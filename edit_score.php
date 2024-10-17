<?php
$servername = "localhost";
$username = "***REMOVED_DB_USER***";
$password = "***REMOVED_DB_PASSWORD***";
$dbname = "***REMOVED_DB_NAME***";

// データベース接続
$conn = new mysqli($servername, $username, $password, $dbname);

// 接続確認
if ($conn->connect_error) {
    die("接続失敗: " . $conn->connect_error);
}

// リクエストからデータを取得
$data = json_decode(file_get_contents('php://input'), true);

// scoreId, newNickname, newScoreが設定されているか確認
if (isset($data['scoreId']) && isset($data['newNickname']) && isset($data['newScore'])) {
    $scoreId = $data['scoreId'];
    $newNickname = $data['newNickname'];
    $newScore = $data['newScore'];

    // スコア編集クエリ
    $sql = "UPDATE scores SET nickname = ?, score = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param('sii', $newNickname, $newScore, $scoreId);

        if ($stmt->execute()) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "error" => $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(["success" => false, "error" => "SQLクエリの準備に失敗しました: " . $conn->error]);
    }
} else {
    echo json_encode(["success" => false, "error" => "必須データが送信されていません"]);
}

$conn->close();
?>