<?php require_once "util.php"; ?>

<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>phpからのデータベース操作 #13</title>
    <link rel="stylesheet" href="../../00/style.css" media="screen" title="no title">
    <style media="screen">
        .kadai_007_13{
            max-width: 860px;
        }
        .kadai_007_13 th, .kadai_007_13 td{
            width: 100px;
            min-height: 40px;
        }
        tr td:first-child, tr th:first-child{
            width: 30px;
        }
        tr td p:first-child {
            min-height: 40px;
        }
        .kadai_007_13 p{
            font-size: 12px;
            margin: 1px;
            padding: 0;
        }
        label {
            cursor: pointer;
        }
        .container p {
            font-size: 14px;
        }
    </style>
</head>

<body>
    <header><h3>授業登録ページ</h3></header>

    <?php
        // 全部が格納されている時、DB へ書き出し、のち、当力完了で exit
        if ( !empty($_POST["subject"]) and !empty($_POST["teacher"]) and !empty($_POST["day"]) and !empty($_POST["time"]) ) {
            // update sql
            $sql = "UPDATE timetable SET ".$_POST["day"]." = :s_and_t WHERE timetable_id = :time;";
            // finction pdo_update
            pdo_update($sql);
            // 完了！
            echo "<p>登録が完了しましたっ！</p>";
            echo "<p><a href='main.php'><button>メインページに戻る</button></a></p>";
            exit;
        }

        // 最初期、初めてページに来た時
        if (empty($_POST)) {
            echo "<p>科目と担当者をそれぞれ指定してください。</p>";

            // 全部選択されてない時
        } else {
            echo "<p>科目と担当者、日程をそれぞれ指定してください。</p><p><strong>選択されていない項目があります！</strong></p>";
        }
    ?>

<section>
    <form action="" method="post">
        <div class="container">
            <h4>科目</h4>
            <?php look_list_of_subject(); ?>
        </div>

        <div class="container">
            <h4>担当</h4>
            <?php look_list_of_teacher(); ?>
        </div>

        <div class="container">
            <h4>曜日</h4>
            <p>
                <label><input type="radio" name="day" value="mon">月曜日</label>
                <label><input type="radio" name="day" value="tue">火曜日</label>
                <label><input type="radio" name="day" value="wed">水曜日</label>
                <label><input type="radio" name="day" value="thu">木曜日</label>
                <label><input type="radio" name="day" value="fri">金曜日</label>
                <label><input type="radio" name="day" value="sat">土曜日</label>
                <label><input type="radio" name="day" value="sun">日曜日</label>
            </p>
        </div>

        <div class="container">
            <h4>時間</h4>
            <p>
                <label><input type="radio" name="time" value="1">1限</label>
                <label><input type="radio" name="time" value="2">2限</label>
                <label><input type="radio" name="time" value="3">3限</label>
                <label><input type="radio" name="time" value="4">4限</label>
            </p>
        </div>

        <p align="center"><button type="submit" name="submitbtn" value="entry">この条件で登録する</button></p>
    </form>
</section>
<p> </p>
<p><a href="main.php"><button>メインページに戻る</button></a></p>



</body>
</html>
