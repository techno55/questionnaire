<!DOCTYPE html>
<html>
<head>
    <title>TOEIC 文法問題模擬試験</title>
</head>
<body>
    <h1>TOEIC 文法問題模擬試験</h1>
    <?php
    session_start();
    
    // 問題セットを定義
    $questions = [
        [
            "question" => "He _______ (be) a teacher.",
            "choices" => ["is", "are", "am"],
            "answer" => "is"
        ],
        [
            "question" => "They _______ (go) to the market.",
            "choices" => ["go", "goes", "going"],
            "answer" => "go"
        ],
        [
            "question" => "She _______ (have) a car.",
            "choices" => ["have", "has", "having"],
            "answer" => "has"
        ]
    ];

    // 問題をランダムにシャッフル
    shuffle($questions);

    // フォームに問題を表示
    echo '<form action="write.php" method="post">';
    echo '名前: <input type="text" name="name"><br>';
    
    foreach ($questions as $index => $question) {
        echo ($index + 1) . '. ' . $question['question'] . '<br>';
        foreach ($question['choices'] as $choice) {
            echo '<input type="radio" name="grammar' . $index . '" value="' . $choice . '"> ' . $choice . '<br>';
        }
        echo '<input type="hidden" name="answer' . $index . '" value="' . $question['answer'] . '">';
    }

    echo '<input type="submit">';
    echo '</form>';
    ?>
</body>
</html>
