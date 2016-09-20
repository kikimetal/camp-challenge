<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>phpからのデータベース操作 #11</title>
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

<h4>課題 #11</h4>
<p class="pre">
    profileIDで指定したレコード 、profileID以外 要素をすべて上書きできるフォームを作成してください

</p>
<hr>
<section>


    <?php
    // submitbtn が selected だったら、ID 入力画面をスキップさせる
    if (empty($_POST["submitbtn"]) or $_POST["submitbtn"] != "id_selected") {
    ?>
        <h4>UPDATE したい profilesID を入力して下さい</h4>

        <form class="" action="11.php" method="post">

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
                <button type="submit" name="submitbtn" value="id_selected">この ID を選択</button>
            </div>
        </form>
        <?php
        exit;
    }
    ?>


    <!-- ID が入力されてて初めて、以下結果、分岐へ -->
    <h4>*- 結果 -*</h4>
    <div>

        <?php
        // ページリロードさせて ID 入力まで戻すボタンを定数へ
        const RETURN_TOP_BUTTON = "<p><a href='11.php'><button>ID 入力に戻る</button></a></p>";


        // UPDATE する条件が整ったとき
        if (!empty($_POST["update"]) and $_POST["update"] == true) {
            // name が未入力だったとき、戻してあげる、入力されていた ID を保持
            // （このやり方で全入力値を戻してあげられそう、脱線しすぎちゃうので今回は ID のみで）
            if (empty($_POST["name"])) {
                echo "<p>name は入力必須です。</p>";
                echo "<form action='11.php' method='post'>";
                // ここで IDの値を 戻してあげる
                echo "<input type='hidden' name='profilesID' value='" . $_POST["profilesID"] . "'>";
                echo "<p><button type='submit' name='submitbtn' value='id_selected'>さっきの画面に戻る</button></p>";
                echo "</form>";
                echo RETURN_TOP_BUTTON;
                exit;

            } else {
                // ここで初めて、ID name が入力されている状態になる


            echo "レコードを更新しました。";
            echo RETURN_TOP_BUTTON;
            exit;
            }
        }

        // 未入力時（初回訪問）
        if ( empty( $_POST ) ) {
            echo "<p>変更したいレコードの profilesID を入力してください。</p>";
            echo RETURN_TOP_BUTTON;
            exit;
        }

        // 未入力でボタン押されたとき
        if ( empty( $_POST["profilesID"] ) ) {
            echo "<p>変更したいレコードの profilesID が入力されていません。<br>profilesID を入力してください。</p>";
            echo RETURN_TOP_BUTTON;
            exit;
        }

        ?>



        <?php

        // 以下、_post[id] が入力済みのとき、レコードの有無を確認する
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
            die( "接続中にエラーが発生しました(検索時) : " . $e->getMessage());
        }

        // 検索で見つかんなかったら終了
        if (empty($result)) {
            echo "<p>指定された profilesID = " . $_POST["profilesID"] . "<br>このレコードは存在しません。</p>";
            echo RETURN_TOP_BUTTON;
            exit;
        }


        // 見つかった場合、UPDATE できるように入力フォームを出現
        ?>
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
                    <input type="text" name="profilesID" value="<?php echo $_POST["profilesID"]; ?>" disabled>
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
                <input type="hidden" name="profilesID" value="<?php echo $_POST["profilesID"]; ?>">
                <input type="hidden" name="update" value="true">
                <button type="submit" name="submitbtn" value="id_selected">この内容で更新</button>
            </div>
        </form>








    </div>

</section>


</body>
</html>
