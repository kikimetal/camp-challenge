<?php

require_once "util.php";

$condition = session_cookie_chk(); // true or false

session_set_cookie_params(60 * 60 * 24);
session_start();

?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>php_オブジェクト指向_01</title>
    <link rel="stylesheet" href="../../00/style.css" media="screen" title="no title">
    <style media="screen">
        input[type="text"]{
            width: auto;
        }
    </style>
</head>
<body>
    <h4>オブジェクト指向_01</h4>
    <header>
        <h3>商品登録ページ</h3>
    </header>
    <section class="center">

        <?php

        if (!$condition or empty($_SESSION["php_008_05_kadai_login"])) {

            echo "<p>不正なアクセスです。</p><p><a href='main.php'><button>メインページはこちら</button></a></p>";

            $user = new User;
            $user->logout();
            exit;

        } else {

            session_regenerate_id();

        }

        ?>
        <p>
            こんにちは <?php echo $_SESSION["user_name"]; ?> さん
        </p>
        <p>
            <b>新しい商品の登録はこちらから</b>
        </p>
        <form class="" action="" method="post">
            <p><input type="text" name="product_name" placeholder="商品名" size="40"></p>
            <p><button type="submit" name="submitbtn" value="yes">この商品を登録</button></p>
        </form>


        <?php

        if (!empty($_POST["product_name"]) and !empty($_POST["submitbtn"])) {
            $user = new User;
            $user->insert_product();
            echo "<p>商品登録が完了しました！</p>";
            echo "<p>登録した商品「" .$_POST["product_name"]. "」</p>";
        } elseif (empty($_POST["product_name"]) and !empty($_POST["submitbtn"])) {
            echo "<p><b>商品名が入力されていません！</b></p>";
        }

        ?>

        <a href="user.php"><button>ユーザーページ（登録済み商品一覧）に戻る</button></a>

    </section>
</body>
</html>
