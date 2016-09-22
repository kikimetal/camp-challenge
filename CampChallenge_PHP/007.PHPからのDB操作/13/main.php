<?php require_once "define.php"; ?>
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
        }
        .kadai_007_13 td {
            display: table-cell;
            height: 100px;
        }
        tr td:first-child, tr th:first-child{
            width: 30px;
        }
        .kadai_007_13 p{
            font-size: 12px;
            margin: 1px;
        }
        .entry_page {
            width: 200px;
            height: 50px;
            margin: 20px auto;
            line-height: 40px;
            background: lavenderblush;
            border: 1px dotted pink;
            border-radius: 20px;
        }
        .entry_page * {
            border: none;
        }
    </style>
</head>
<body>
    <h4>課題 #13 ロジック構築編</h4>
    <header>
        <h3>メインページ</h3>
    </header>

<div class="entry_page"><h4><a href="entry.php">授業日程を追加する</a></h4></div>

<section class="kadai_007_13">
    <h4 align="center">
        時間割 ( 科目名 / 担当者名 )
    </h4>

    <table border="1">
        <tr>
            <th></th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th bgcolor="honeydew">Sat</th><th bgcolor="honeydew">Sun</th>
        </tr>

        <?php
            $sql = "SELECT * FROM timetable;";
            // function pdo_select()
            $timetable = pdo_select($sql);

            $i = 0;
            $arr_count = count($timetable);
            while ($i < $arr_count) {
        ?>
                <tr>
                    <td><?php echo $i+1 . "限"; ?></td>
                    <?php
                    foreach ($timetable[$i] as $column => $value) {
                        if ($column == "timetable_id") {
                            continue;
                        }
                        if ($column == "sat" or $column == "sun") {
                            echo "<td bgcolor='honeydew'>";
                        } else {
                            echo "<td>";
                        }
                        echo_subject_and_teacher($value);
                        echo "</td>";
                    }
                    ?>
                    <!-- <td bgcolor="lightgrey"></td>
                    <td bgcolor="lightgrey"></td> -->
                </tr>
        <?php
            $i++;
            }
        ?>

    </table>
</section>


<div style="height:20px;"></div>
<!------------------------------------------------------------------->
<!-- <p class="pre">
    課題13 以下 仕様 プログラムを作成しなさい
・○×塾 一週間時間割
・時間割  html テーブル構造をうまく用いること
・科目名と、担当者が各テーブルに入る
・科目名、担当者名 自由に考えてよい。
・入力フォームを持つページを用意し、
    何日目 、何時限目に、どの科目で、どの担当者が担当する か、をそ れぞれ入力
</p> -->
<section>
<h4>- 仕様 memo -</h4>
<p class="pre">
    teacher と subject と　時間割　のテーブルを用意。
    teacher subject にそれぞれ新しい担当者、科目を追加。(今回はこの登録ページは省きDBへ直接設定)
    時間割登録の際は、この二つから全件SELECTしたリストから、
    １：１になるように選択させ、
    + 登録する時限と曜日
    それを、subject名＠teacher名 で 時間割テーブル にINSERT。

    メインページを開いた時、DBから引き出す際に、
    時間割テーブルからSELECT した値 $value を分解する。
    $teacher = mb_strstr ( $value, "@" , true );
    $subject = mb_substr ( mb_strstr( $value , "@" ) , 1 );
    で、担当者と科目を抽出。セットで表示させる。

</p>
<pre>
    // メインとなる時間割テーブル
    create table timetable(
        timetable_id int primary key,
        mon text, tue text, wed text, thu text, fri text, sat text, sun text
    );

    INSERT INTO timetable (timetable_id) VALUES (1),(2),(3),(4);
    // これで１〜４限まである感じにする

</pre>
</section>
</body>
</html>
