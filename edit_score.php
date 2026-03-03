<?php
require_once 'db_connection.php';


// リクエストからデータを取得
$data = json_decode(file_get_contents('php://input'), true);

// scoreId, newNickname, newScoreが設定されているか確認
if (isset($data['scoreId']) && isset($data['newNickname']) && isset($data['newScore'])) {
    $scoreId = $data['scoreId'];
    $newNickname = $data['newNickname'];
    $newScore = floatval($data['newScore']);  // 修正: スコアを浮動小数点に変換

    // スコア編集クエリ
    $sql = "UPDATE scores SET nickname = ?, score = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        // スコアを浮動小数点として処理
        $stmt->bind_param('sdi', $newNickname, $newScore, $scoreId);

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