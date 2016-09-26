<?php

require_once "util.php";

$condition = session_cookie_chk(); // true or false

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
        <h3>ユーザーページ</h3>
    </header>
    <section class="center">

        <?php
        if (!$condition and empty($_SESSION["login"])) {
            echo "<p>不正なアクセスです。</p><p><a href='main.php'><button>メインページはこちら</button></a></p>";
            exit;
        } else {
            session_set_cookie_params(60 * 60 * 24);
            session_start();
            session_regenerate_id();
        }


        $user = new User;
        $user->set_name($_SESSION["user_name"]);
        ?>

        <p>
            こんにちは！ <?php echo $user->get_name(); ?>さん！
        </p>
        <p>
            <a href="entry.php"><button>商品の登録ページはこちら</button></a>
        </p>
        <p class="">
            <b><?php echo $user->get_name(); ?>さんの登録済み商品</b>
        </p>




        <?php

        $_SESSION["user_id"] = $user->get_my_user_id();
        $my_list = $user->select_all_my_product();
        $num_of_list = count($my_list);
        ?>

        <table class="center">
            <tr>
                <th>ユーザー名</th><th>商品名</th>
            </tr>

            <?php
            if (empty($my_list)) {
                echo "<tr><td colspan='2'>まだ何も登録されていません</td></tr>";
            } else {
                for ($i = 0; $i < $num_of_list; $i++) {
            ?>
                    <tr>
                        <td><?php echo $_SESSION["user_name"]; ?></td><td><?php echo $my_list[$i]; ?></td>
                    </tr>
            <?php
                }
            }
            ?>
        </table>



        <form action="main.php" method="post">
            <button type="submit" name="logout" value="true">ログアウトしてメインページに戻る</button>
        </form>
        <?php ?>

    </section>
</body>
</html>
