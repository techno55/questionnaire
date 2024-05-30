<!DOCTYPE html>
<html>
<head>
    <title>模擬試験結果表示</title>
    <!-- Chart.jsのライブラリをインクルード -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>模擬試験結果</h1>
    <table border="1">
        <tr>
            <th>名前</th>
            <th>文法問題1の回答</th>
            <th>文法問題2の回答</th>
            <th>文法問題3の回答</th>
            <th>スコア</th>
            <th>試験回数</th>
        </tr>
        <?php
        // data.txtファイルを読み込みモードで開く
        $file = fopen("data.txt", "r");
        $results = []; // 結果を保存するための配列
        // ファイルの各行を読み込む
        while (($line = fgets($file)) !== false) {
            // カンマ区切りで行を分割し、データ配列に変換
            $data = explode(",", trim($line));
            $results[] = $data; // 結果配列に追加
            echo "<tr>";
            // 各データをテーブルのセルとして表示
            for ($i = 0; $i < count($data); $i++) {
                echo "<td>" . htmlspecialchars($data[$i]) . "</td>";
            }
            echo "</tr>";
        }
        // ファイルを閉じる
        fclose($file);
        ?>
    </table>

    <h2>過去の結果</h2>
    <!-- 結果を表示するためのキャンバス -->
    <canvas id="resultsChart"></canvas>
    <script>
        // PHPから渡された結果をJavaScriptの変数に変換
        const results = <?php echo json_encode($results); ?>;
        const labels = []; // ラベルを保存するための配列
        const scores = []; // スコアを保存するための配列
        
        // 結果配列からラベルとスコアを抽出
        results.forEach(result => {
            labels.push("試験 " + result[5]); // 試験回数をラベルとして追加
            scores.push(parseInt(result[4])); // スコアを数値として追加
        });

        // Chart.jsを使用してグラフを描画
        const ctx = document.getElementById('resultsChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'line', // グラフの種類を指定（折れ線グラフ）
            data: {
                labels: labels, // X軸のラベル
                datasets: [{
                    label: 'スコア', // データセットのラベル
                    data: scores, // Y軸のデータ
                    borderColor: 'rgba(75, 192, 192, 1)', // 線の色
                    borderWidth: 1 // 線の太さ
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true // Y軸をゼロから始める設定
                    }
                }
            }
        });
    </script>

    <h2>もう一度挑戦する</h2>
    <!-- 再挑戦のためのリンク -->
    <a href="post.php">再挑戦</a>
</body>
</html>
