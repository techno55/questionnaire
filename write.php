<?php

/*data.txt から過去の試験結果を読み込み、テーブルとして表示します。
Chart.js を使用して過去のスコアの推移をグラフとして表示*/
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];

    // 正誤判定とスコア計算
    $score = 0;
    $results = [];
    for ($i = 0; $i < 3; $i++) {
        $user_answer = $_POST['grammar' . $i];
        $correct_answer = $_POST['answer' . $i];
        $result = $user_answer == $correct_answer ? '正解' : '不正解';
        if ($result == '正解') {
            $score++;
        }
        $results[] = $user_answer . " (" . $result . ")";
    }

    // 試験回数をカウント
    $data = file_get_contents("data.txt");
    $lines = explode("\n", trim($data));
    $attempt_count = 1;
    foreach ($lines as $line) {
        if (strpos($line, $name) !== false) {
            $attempt_count++;
        }
    }

    // データを保存
    $data = $name . "," . implode(",", $results) . "," . $score . "," . $attempt_count . "\n";
    $file = fopen("data.txt", "a");
    fwrite($file, $data);
    fclose($file);

    $_SESSION['attempt_count'] = $attempt_count;

    // 結果ページにリダイレクト
    header("Location: read.php");
    exit();
}
?>
