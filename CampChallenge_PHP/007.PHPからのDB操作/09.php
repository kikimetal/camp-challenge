<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>phpからのデータベース操作 #09</title>
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

<h4>課題 #09</h4>
<p class="pre">
    フォームからデータを挿入できる処理を構築してください。

</p>
<hr>
<section>

    <h4>*- 入力フォーム -*</h4>
    <p>
        id name は入力必須です。
    </p>
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
            <input type="submit" name="submitbtn" value="挿入っ">
        </div>
    </form>
    <h4>*- 結果 -*</h4>
    <div>
        <?php
        // 未入力時
        if ( empty($_POST) ) {
            echo "挿入したい情報を入力してください。";
            exit;
        }

        // id name どっちかが欠けてたらNG
        if ( empty($_POST["name"]) or empty($_POST["profilesID"]) ) {
            echo "id と name は入力必須です。入力してください。";
            exit;
        }

        // 入力形式不正を弾く
        // 本当は全部やんなきゃいけないけど今回は id だけで...
        if ( !is_numeric($_POST["profilesID"]) ) {
            echo "id には 半角数字を入れてください";
            exit;
        }

        // ここから本番 // 全部打ち込んで覚える
        const DB_DATABASE_NAME = "challenge_db";
        const DB_USERNAME = "kiki";
        const DB_PASSWORD = "metal";
        const DB_CHARSET = ";charset = utf8";
        const PDO_DSN = "mysql:host=localhost;dbname=" . DB_DATABASE_NAME . DB_CHARSET;

        // まず入力された id と name が重複しないか調べる
        try{
            // connect
            $pdo = new PDO( PDO_DSN , DB_USERNAME , DB_PASSWORD );
            $pdo->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION );

            // action
            $sql_search = "SELECT * FROM profiles WHERE profilesID = :id OR name = :name";
            $stmt = $pdo->prepare( $sql_search );
            $stmt->bindValue( ":id" , $_POST["profilesID"] , PDO::PARAM_INT );
            $stmt->bindValue( ":name" , $_POST["name"] , PDO::PARAM_STR );
            $stmt->execute();
            $result = $stmt->fetchall( PDO::FETCH_ASSOC );
            // すでに登録済みの name か id のときは、ここで配列が帰ってくるはず

            // disconnect
            $pdo = null;
        }catch( PDOException $e ){
            die( "接続できませんでした : " . $e->getMessage() );
        }

        // 検索結果 $result が空じゃないなら、すでに登録済みだったことになるから、重複でNG
        if ( !empty( $result ) ) {
            echo "<p>そのIDまたは名前は登録済みです</p>";
            echo "<p>" . "(id : " . $_POST["profilesID"] . ") (name : " . $_POST["name"] . ")</p>";
            echo "<p>検出されたレコード --v</p>";


            $i = 0;
            $number_of_hit = count( $result ); //複数のレコードにヒットしたときに備え、そのレコード数を $number_of_hit へ
            ?>

            <table border="1">
                <tr>
                    <th>ID</th><th>name</th><th>tell</th><th>age</th><th>birthday</th>
                </tr>

                <?php
                while( $i < $number_of_hit ){
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
            exit; // 重複結果を表示して終了
        }
        ?>

        <?php
        // -------------------------------------------------------------
        // 次、ここまで通過でようやく INSERT の条件が揃う
        // もう一度 DB へ接続
        // -------------------------------------------------------------

        try{
            // connect
            $pdo = new PDO( PDO_DSN , DB_USERNAME , DB_PASSWORD );
            $pdo->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION );

            // action
            $sql_insert = "
                INSERT INTO
                    profiles
                VALUES (
                    :id ,
                    :name ,
                    :tell ,
                    :age ,
                    :birthday
                )
            ";
            $stmt = $pdo->prepare( $sql_insert );
            $stmt->bindValue( ":id" , $_POST["profilesID"] , PDO::PARAM_INT );
            $stmt->bindValue( ":name" , $_POST["name"] , PDO::PARAM_STR );
            $stmt->bindVAlue( ":tell" , $_POST["tell"] , PDO::PARAM_STR );
            $stmt->bindVAlue( ":age" , $_POST["age"] , PDO::PARAM_INT );
            $stmt->bindVAlue( ":birthday" , $_POST["birthday"] , PDO::PARAM_STR );
            $stmt->execute();

            // disconnect
            $pdo = null;
        }catch( PDOException $e ){
            die( "接続できませんでした : " . $e->getMessage() );
        }


        echo "<p>以下の情報で登録しました。</p>";
        echo "<p>";
        foreach ($_POST as $key => $value) {
            if ($key == "submitbtn"){
                continue;
            }
            echo $key . " : " . $value . "<br>";
        }
        echo "</p>";

        ?>
    </div>

</section>


</body>
</html>
