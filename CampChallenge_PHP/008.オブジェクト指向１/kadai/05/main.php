<?php require_once "util.php"; ?>

<?php
// ログアウトリンクで飛んできたとき、ログアウト
if (!empty($_POST["logout"]) and $_POST["logout"] == true) {
    $user = new User;
    $user->logout();
    // var_dump($_POST["logout"]);
} else {
    session_set_cookie_params(60 * 60);
    session_start();
}

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
        <h3>ログインページ</h3>
    </header>
    <section>
        <h4>課題 #05 応用編</h4>
        <p class="pre">
            以下の機能を満たすロジックを作成してください。
            在庫管理システムを作成します。
            まず、DBにユーザー情報管理テーブルと、商品情報登録テーブルを作成してください。
            その上で、下記機能を実現してください。
            1ユーザーのログイン・ログアウト機能
            2商品情報登録機能
            3商品一覧機能   ※各テーブルの構成は各自の想像で。

        </p>

        <div class="test">
            <p>
                ID と name を入力してください。
            </p>
            <form action="" method="post">
                <input value="<?php if (!empty($_POST["name"])) { echo $_POST["name"]; } ?>" type="text" maxlength="16" name="name" pattern="^[0-9A-Za-z]+$" size="20">
                <input value="<?php if (!empty($_POST["password"])) { echo $_POST["password"]; } ?>" type="text" maxlength="12" name="password" pattern="^[0-9A-Za-z]+$" size="16">
                <input type="hidden" name="login" value="true">
                <button type="submit" name="submitbtn" value="yes">ログインする</button>
            </form>

            <?php
                if (empty($_POST["submitbtn"])) {
                    // 初回
                    // セッションクッキーを消す
                    session_unset();
                    session_destroy();
                    setcookie("PHPSESSID" , "" , time() - 1800);
                }
                elseif (empty($_POST["name"]) or empty($_POST["password"])) {
                    // どっちかが未入力
                    echo "<p><strong>未入力欄があります！</strong></p>";

                    // セッションクッキーを消す
                    session_unset();
                    session_destroy();
                    setcookie("PHPSESSID" , "" , time() - 1800);
                }
                else {
                    // 入力されていたらログインを試みる
                    $user = new User();
                    $user->login();
                    // ユーザー名
                    $_SESSION["user_name"] = $_POST["name"];
                    // このページからログインしたときのみ true になる
                    $_SESSION["php_008_05_kadai_login"] = true;

                }
            ?>

        </div>




<!--
        <pre>
            SQL memo

            // ユーザーテーブル
            CREATE TABLE obj_user (
                id int primary key auto_increment,
                name varchar(16) not null,
                password varchar(12) not null
            );

            // 今回のユーザーさん
            INSERT INTO obj_user (name, password)
                VALUES ('himechan','kawaii'),('ukonvasara','dragoon');

            // 商品テーブル
            CREATE TABLE obj_product (
                id int not null,
                name varchar(255) not null,
                foreign key (id) references obj_user (id)
            );

            // 商品登録SQL 雛形
            INSERT INTO obj_product (name) VALUES (:name);

        </pre>
-->

    </section>
</body>
</html>
