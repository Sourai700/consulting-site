<?php
// CSVファイル名を指定
$csvFile = 'contact_data.csv';

// フォームからデータが送信された場合
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $message = htmlspecialchars($_POST['message'] ?? '');

    // 必須チェック
    if (empty($name) || empty($email) || empty($message)) {
        echo "全ての必須項目を入力してください。";
        exit;
    }

    // CSV用のデータを配列に格納
    $data = [
        date('Y-m-d H:i:s'), // 現在の日時
        $name,
        $email,
        $message
    ];

    // CSVファイルにデータを追記
    $file = fopen($csvFile, 'a');
    if ($file) {
        fputcsv($file, $data);
        fclose($file);
        echo "お問い合わせを受け付けました。";
    } else {
        echo "データ保存中にエラーが発生しました。";
    }
}
?>
