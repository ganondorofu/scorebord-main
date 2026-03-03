<?php
// エラー表示を有効化
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// データベース接続情報
require_once 'db_connection.php';


// リクエストからデータを取得
$data = json_decode(file_get_contents('php://input'), true);

// scoreIdが設定されているか確認
if (isset($data['scoreId'])) {
    $scoreId = $data['scoreId'];

    // scoreIdが空かどうか確認
    if (empty($scoreId)) {
        echo json_encode(["success" => false, "error" => "scoreIdが空です"]);
        exit;
    }

    // スコア削除クエリ
    $sql = "DELETE FROM scores WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('i', $scoreId);

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
    echo json_encode(["success" => false, "error" => "scoreIdが設定されていません"]);
}

$conn->close();
?>