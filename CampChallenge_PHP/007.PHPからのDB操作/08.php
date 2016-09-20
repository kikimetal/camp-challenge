<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>phpからのデータベース操作 #08</title>
    <link rel="stylesheet" href="../00/style.css" media="screen" title="no title">
</head>
<body>

<h4>課題 #08</h4>
<p class="pre">
    検索用 フォームを用意し、名前 部分一致で検索+表示する処理を構築してく ださい
    同じページにリダイレクトするPOST処理と、POSTに値が入っているか 条件分 岐を活用すれ 、
    一つの.phpで完了できますのでチャレンジしてみてください
    
</p>
<hr>
<section>
    <h4>*- 名前けんさく -*</h4>
    <form class="" action="" method="post">
        <p>
            <input type="text" name="search_name" placeholder="ここに名前を入力してください">
        </p>
        <p>
            <input type="submit" name="transmission" value="けんさくするっ">
        </p>
    </form>
    <h4>*- けんさく結果 -*</h4>
    <p>
        <?php

        // ポストの中身チェック
        if ( empty($_POST["search_name"]) ) {
            echo "未入力です。キーワードを入力してください。";
            exit;
            // ポストに値が入ってなかったらここで終了
        }

        $keyword = $_POST["search_name"]; // 検索するキーワードをもらう

        const DB_DATABASE_NAME = "challenge_db";
        const DB_USERNAME = "kiki";
        const DB_PASSWORD = "metal";
        const DB_CHARSET = ";charset=utf8";
        const PDO_DSN = "mysql:host=localhost;dbname=" . DB_DATABASE_NAME . DB_CHARSET;


        try {
            // connect
            $pdo = new PDO(PDO_DSN , DB_USERNAME , DB_PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            // action
            // echo "接続 start <br>";

            $sql_select = "SELECT * FROM profiles WHERE name LIKE '%" . $keyword . "%';"; // 確認用

            $stmt = $pdo->prepare($sql_select);
            $stmt->execute();
            $result = $stmt->fetchall(PDO::FETCH_ASSOC);
            // $result に結果を格納

            // disconnect
            $pdo = null;
            // echo "<br> 接続 end";

        } catch (PDOException $e) {
            die("接続に失敗しちゃった＞＜ <br>" . $e->getMessage() );
        }

        // 結果の配列 $result の中身チェック
        if ( empty($result) ) {
            echo "「" . $keyword . "」は見つかりませんでした。";
            exit;
            // 配列が空っぽだったらここで終了
        }
        ?>

    </p>

        <?php
        $i = 0;
        $number_of_hit = count($result); //複数のレコードにヒットしたときに備え、そのレコード数を $number_of_hit へ
        ?>

        <table border="1">
            <tr>
                <th>ID</th><th>name</th><th>tell</th><th>age</th><th>birthday</th>
            </tr>

            <?php
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
        <?php
            // php 記述がここまであると、exit した場合、ここまでを全て飛ばす。
            //よって検索ヒットしなかったら <table> とかも全部、表示されない、ここまでスキップ
        ?>


</section>


</body>
</html>
