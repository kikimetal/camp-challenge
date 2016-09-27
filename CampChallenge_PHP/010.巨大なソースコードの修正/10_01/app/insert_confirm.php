<?php require_once '../common/defineUtil.php'; ?>
<?php require_once '../common/scriptUtil.php'; ?>
<?php session_start(); ?>

<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="UTF-8">
      <title>登録確認画面</title>
      <link rel="stylesheet" href="css/style.css">
</head>
  <body>
    <?php

    if (empty($_POST['permission'])) {
        echo "<h3>不正なアクセスです！</h3><p>このページへ直接アクセスすることはできません。</p>";
        echo return_top();
        exit;
    }


    $unanswered_flg = (bool) false; // どれかが未回答の時に立つフラグ
    $birthday_flg = (bool) false; // 生年月日の未入力警告の重複を避けるフラグ
    foreach (FORM_ARR as $key => $value) {
        if (!chk_post($key)) {
            if ($key == "year" or $key == "month" or $key =="day") {
                if (!$birthday_flg) {
                    echo "<p><b>" . $value . "の選択が不完全です。</b></p>";
                    $birthday_flg = true;
                    $unanswered_flg = true;
                }
                continue;
            }
            echo "<p><b>" . $value . "の入力が未回答です。</b></p>";
            $unanswered_flg = true;
        }
    }

    // 未入力でひっかかればここ
    if ($unanswered_flg) {
    ?>

        <br>
        <p>入力項目が不完全です！</p>
        <p>再度入力を行ってください！</p>
        <br>

        <form action="<?php echo INSERT ?>" method="POST">

            <?php
            foreach (FORM_ARR as $key => $value) {
            ?>
                <input type="hidden" name="<?php echo $key;?>" value="<?php echo_post($key); ?>">
            <?php
            }
            ?>

            <input type="submit" name="no" value="登録画面に戻る">
        </form>

    <?php
    // すべて入力済みでここ
    } else {

        //セッション情報に格納
        $_SESSION['name'] = $_POST['name'];
            //date型にするために1桁の月日を2桁にフォーマットしてから格納
        $_SESSION['birthday'] = $_POST['year'].'-'.sprintf('%02d',$_POST['month']).'-'.sprintf('%02d',$_POST['day']);
        $_SESSION['type'] = $_POST['type'];
        $_SESSION['tell'] = $_POST['tell'];
        $_SESSION['comment'] = $_POST['comment'];
    ?>

        <h1 class="center">登録確認画面</h1>
        名前:<?php echo $_SESSION["name"]; ?><br>
        生年月日:<?php echo $_SESSION["birthday"]; ?><br>
        種別:<?php echo $_SESSION["type"]; ?><br>
        電話番号:<?php echo $_SESSION["tell"]; ?><br>
        自己紹介:<?php echo $_SESSION["comment"]; ?><br>

        上記の内容で登録します。よろしいですか？

        <form action="<?php echo INSERT_RESULT ?>" method="POST">
            <input type="hidden" name="permission" value="true">
            <input type="submit" name="yes" value="はい">
        </form>

        <form action="<?php echo INSERT ?>" method="POST">

            <?php
            foreach (FORM_ARR as $key => $value) {
            ?>
                <input type="hidden" name="<?php echo $key;?>" value="<?php echo_post($key); ?>">
            <?php
            }
            ?>

            <input type="submit" name="no" value="登録画面に戻る">
        </form>

    <?php
    }
    ?>

    <footer><?php echo return_top(); ?></footer>

</body>
</html>
