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

    // if(!empty($_POST['name']) && !empty($_POST['year']) && !empty($_POST['type'])
    //         && !empty($_POST['tell']) && !empty($_POST['comment'])
    //                 // #02
    //                 && $_POST['month'] && $_POST['day']
    //                         && $_POST['year'] != "----" && $_POST['month'] != "--" && $_POST['day'] != "--"){



    // ダイレクトリンクの際を追加
    if (empty($_POST)) {
        echo "<h3>不正なアクセスです！</h3><p>このページへ直接アクセスすることはできません。</p>";
        echo return_top();
        exit;
    }


    // #03
    $unanswered_flg = (bool) false; // 未回答の時に立つフラグ

    if (empty($_POST["name"])) {
        echo "<p><b>※名前が未入力です。</b></p>";
        $unanswered_flg = true;
    }
    if (empty($_POST['year']) or empty($_POST['month']) or empty($_POST['day']) or $_POST["year"] == "----" or $_POST["month"] == "--" or $_POST["day"] == "--") {
        echo "<p><b>※生年月日の選択が不完全です。</b></p>";
        $unanswered_flg = true;
    }
    if (empty($_POST["type"])) {
        echo "<p><b>※種別が未選択です。</b></p>";
        $unanswered_flg = true;
    }
    if (empty($_POST["tell"])) {
        echo "<p><b>※電話番号が未入力です。</b></p>";
        $unanswered_flg = true;
    }
    if (empty($_POST["comment"])) {
        echo "<p><b>※自己紹介文が未入力です。</b></p>";
        $unanswered_flg = true;
    }


    if ($unanswered_flg) {
    ?>

        <br>
        <p>入力項目が不完全です！</p>
        <p>再度入力を行ってください！</p>
        <br>

        <form action="<?php echo INSERT ?>" method="POST">
            <!-- #04 -->
            <input type="hidden" name="name" value="<?php if (!empty($_POST['name'])) { echo $_POST['name']; } ?>">
            <input type="hidden" name="year" value="<?php if (!empty($_POST['year'])) { echo $_POST['year']; } ?>">
            <input type="hidden" name="month" value="<?php if (!empty($_POST['month'])) { echo $_POST['month']; } ?>">
            <input type="hidden" name="day" value="<?php if (!empty($_POST['day'])) { echo $_POST['day']; } ?>">
            <input type="hidden" name="type" value="<?php if (!empty($_POST['type'])) { echo $_POST['type']; } ?>">
            <input type="hidden" name="tell" value="<?php if (!empty($_POST['tell'])) { echo $_POST['tell']; } ?>">
            <input type="hidden" name="comment" value="<?php if (!empty($_POST['comment'])) { echo $_POST['comment']; } ?>">

            <input type="submit" name="no" value="登録画面に戻る">
        </form>

    <?php
    } else {

        $post_name = $_POST['name'];
        //date型にするために1桁の月日を2桁にフォーマットしてから格納
        $post_birthday = $_POST['year'].'-'.sprintf('%02d',$_POST['month']).'-'.sprintf('%02d',$_POST['day']);
        $post_type = $_POST['type'];
        $post_tell = $_POST['tell'];
        $post_comment = $_POST['comment'];

        //セッション情報に格納
        // session_start();
        $_SESSION['name'] = $post_name;
        $_SESSION['birthday'] = $post_birthday;
        $_SESSION['type'] = $post_type;
        $_SESSION['tell'] = $post_tell;
        $_SESSION['comment'] = $post_comment;
    ?>

        <h1 class="center">登録確認画面</h1>
        名前:<?php echo $post_name;?><br>
        生年月日:<?php echo $post_birthday;?><br>
        種別:<?php echo $post_type?><br>
        電話番号:<?php echo $post_tell;?><br>
        自己紹介:<?php echo $post_comment;?><br>

        上記の内容で登録します。よろしいですか？

        <form action="<?php echo INSERT_RESULT ?>" method="POST">
            <input type="hidden" name="permission" value="true">
            <input type="submit" name="yes" value="はい">
        </form>

        <form action="<?php echo INSERT ?>" method="POST">

            <input type="hidden" name="name" value="<?php if (!empty($_POST['name'])) { echo $_POST['name']; } ?>">
            <input type="hidden" name="year" value="<?php if (!empty($_POST['year'])) { echo $_POST['year']; } ?>">
            <input type="hidden" name="month" value="<?php if (!empty($_POST['month'])) { echo $_POST['month']; } ?>">
            <input type="hidden" name="day" value="<?php if (!empty($_POST['day'])) { echo $_POST['day']; } ?>">
            <input type="hidden" name="type" value="<?php if (!empty($_POST['type'])) { echo $_POST['type']; } ?>">
            <input type="hidden" name="tell" value="<?php if (!empty($_POST['tell'])) { echo $_POST['tell']; } ?>">
            <input type="hidden" name="comment" value="<?php if (!empty($_POST['comment'])) { echo $_POST['comment']; } ?>">

            <input type="submit" name="no" value="登録画面に戻る">
        </form>

    <?php
    }
    ?>


    <footer>
        <?php
        // #01
        echo return_top();
        ?>
    </footer>



</body>
</html>
