<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>phpからのデータベース操作 #12</title>
    <link rel="stylesheet" href="../00/style.css" media="screen" title="no title">
    <style media="screen">
        input[type="text"]{
            font-size: 16px;
            width: 90px;
            /*height: 20px;*/
        }
        .cell{
            box-sizing: border-box;
            margin: 5px;
            padding: 0;
            width: 100px;
            /*height: 40px;*/
            float: left;
        }
        .thead .cell {
            padding: 0px 5px;
            border: 1px solid lightgrey;
        }
        .clear{
            clear: left;
        }
    </style>
</head>
<body>

<h4>課題 #12</h4>
<p class="pre">
    検索用 フォームを用意し、名前、年齢、誕生日を使った複合検索ができるよう にしてください

</p>
<hr>
<section>
    <form class="" action="" method="post">

        <div class="thead clear">
            <div class="cell">
                profilesID
            </div>
            <div class="cell">
                name
            </div>
            <div class="cell">
                tell
            </div>
            <div class="cell">
                age
            </div>
            <div class="cell">
                birthday
            </div>
        </div>

        <div class="tbody clear">
            <div class="cell">
                <input type="text" name="profilesID" placeholder="profilesID">
            </div>
            <div class="cell">
                <input type="text" name="name" placeholder="name">
            </div>
            <div class="cell">
                <input type="text" name="tell" placeholder="tell">
            </div>
            <div class="cell">
                <input type="text" name="age" placeholder="age">
            </div>
            <div class="cell">
                <input type="text" name="birthday" placeholder="birthday">
            </div>
        </div>

        <div class="clear">
            <button type="submit" name="submitbtn">検索っ</button>
        </div>
    </form>
    <div>

        <?php
        // まず未入力時
        if (empty($_POST)) {
            echo "<p>検索ワードを入力してください。</p>";
            exit;
        }

        // submitbtn 以外の値の存在をチェック
        $flg = false;
        foreach ($_POST as $key => $value) {
            if ($key == "submitbtn") {
                continue;
            }
            if ($value) {
                // $search_condition[$key] = true;
                $flg = true;
            }
        }

        // 入っていなかったら、終了
        if (!$flg) {
            echo "<p>値が入力されていません。<br>検索ワードを入力してください。</p>";
            exit;
        }

        // submitbtn 以外に値が入っていれば、検索開始
        // 探索する SQL を生成してく
        $sql = "SELECT * FROM profiles WHERE ";

        // 値があったら SQL に追加して、echo でどのカラムがどの値で検索されたのか吐く
        function input_chk($column_name) {
            global $_POST;
            global $sql;
            static $added_flg = false;

            if (!empty($_POST[$column_name])) {
                if ($added_flg) {
                    $sql .= " and ";
                }
                $sql .= $column_name . " like '%" . $_POST[$column_name] . "%'";
                $added_flg = true;
                echo "<p>" . $column_name . " : " . $_POST["$column_name"] . "</p>";
            }
        }

        echo "<h5>入力された検索ワード</h5>";
        // input_chk で一気に SQL 追加
        input_chk("profilesID");
        input_chk("name");
        input_chk("tell");
        input_chk("age");
        input_chk("birthday");
        $sql .= ";";

        echo "<h5>生成されたSQL :</h5><p>" . $sql . "</p>";

        echo "<h4>以上の検索結果 --v</h4>";

        // DBアクセス！
        const DB_DATABASE_NAME = "challenge_db";
        const DB_USERNAME = "kiki";
        const DB_PASSWORD = "metal";
        const PDO_DSN = "mysql:host=localhost;dbname=" . DB_DATABASE_NAME . ";charset=utf8";

        try {
            // connect
            $pdo = new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // do
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchall(PDO::FETCH_ASSOC);

            // disconnect
            $pdo = null;
        } catch (PDOException $e) {
            die("接続エラーです : " . $e->getMessage());
        }
        ?>

        <?php
        $i = 0;
        $number_of_hit = count($result); //複数のレコードにヒットしたときに備え、そのレコード数を $number_of_hit へ
        ?>

        <table border="1">
            <tr>
                <th>profilesID</th><th>name</th><th>tell</th><th>age</th><th>birthday</th>
            </tr>

            <?php
            if ($number_of_hit == 0) {
                echo "<td colspan='5'>該当なし。</td>";
            }
            while ($i < $number_of_hit) {
            ?>

                <tr>
                    <td><?php echo $result[$i]["profilesID"]; ?></td>
                    <td><?php echo $result[$i]["name"]; ?></td>
                    <td><?php echo $result[$i]["tell"]; ?></td>
                    <td><?php echo $result[$i]["age"]; ?></td>
                    <td><?php echo $result[$i]["birthday"]; ?></td>
                </tr>

            <?php
                $i++;
            }
            ?>
        </table>
        <?php  ?>


    </div>
</section>
</body>
</html>
