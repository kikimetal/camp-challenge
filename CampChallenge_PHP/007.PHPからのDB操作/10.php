<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>phpからのデータベース操作 #10</title>
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

<h4>課題 #10</h4>
<p class="pre">
    profilesIDで指定したレコードを削除できるフォームを作成してください
    
</p>
<hr>
<section>

    <h4>削除したいレコードのIDを入力してください</h4>

    <form class="" action="10.php" method="post">

        <div class="thead clear">
            <div class="cell">
                profilesID
            </div>
        </div>

        <div class="tbody clear">
            <div class="cell">
                <input type="text" name="profilesID" placeholder="profilesID">
            </div>
        </div>

        <div class="clear">
            <input type="submit" name="submitbtn" value="削除っ">
        </div>
    </form>

    <h4>*- 結果 -*</h4>
    <div>
        <?php
        // 未入力時（初回訪問）
        if ( empty( $_POST ) ) {
            echo "<p>profilesID を入力してください。</p>";
            exit;
        }

        // 未入力でボタン押されたとき
        if ( empty( $_POST["profilesID"] ) ) {
            echo "<p>削除したい profilesID が入力されていません。</p>";
            exit;
        }

        // 以下、_post[id] が入力済みのとき
        // 今回は入力された profilesID のレコードが存在するかしないかの確認、分岐は割愛
        // DBアクセス開始
        const DB_DATABASE_NAME = "challenge_db";
        const DB_USERNAME = "kiki";
        const DB_PASSWORD = "metal";
        const PDO_DSN = "mysql:host=localhost;dbname=" . DB_DATABASE_NAME . ";charset=utf8";

        try {
            // connect
            $pdo = new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // 指定された profilesID が存在するか調べる
            $sql_select = "SELECT * FROM profiles WHERE profilesID = :id";
            $stmt = $pdo->prepare($sql_select);
            $stmt->bindValue(":id", $_POST["profilesID"], PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchall(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            die( "接続中にエラーが発生しました(SELECT) : " . $e->getMessage());
        }

        // 検索で見つかんなかったら終了
        if (empty($result)) {
            echo "<p>指定された profilesID = " . $_POST["profilesID"] . "<br>このレコードは存在しません。</p>";
            exit;
        }

        // 見つかった場合、削除
        try {
            // connect
            $pdo = new PDO( PDO_DSN , DB_USERNAME , DB_PASSWORD );
            $pdo->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION );

            // 指定された profilesID のレコード削除する
            $sql_delete = "DELETE FROM profiles WHERE profilesID = :id";
            $stmt = $pdo->prepare($sql_delete);
            $stmt->bindValue( ":id" , $_POST["profilesID"] , PDO::PARAM_INT );
            $stmt->execute();

            // disconnect
            $pdo = null;

        } catch (Exception $e) {
            die("接続中にエラーが発生しました(DELETE) : " . $e->getMessage());
        }

        echo "<p>profilesID = " . $_POST["profilesID"] . "のレコードを削除しました。</p>";









/*
-----
        try {
            $pdo = new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD);
            $pdo->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            die ("接続中にエラーが発生しました : " . $e->getMessage());
        }

----

        try{
            $pdo = new PDO ( PDO_DSN , DB_USERNAME , DB_PASSWORD );
            $pdo->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION );
        }catch( Exception $e ){
            die( "接続中にエラーが発生しました : " . $e->getMessage() );
        }
---
*/







        ?>
    </div>

</section>


</body>
</html>
