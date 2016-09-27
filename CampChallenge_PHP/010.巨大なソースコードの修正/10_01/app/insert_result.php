<?php require_once '../common/scriptUtil.php'; ?>
<?php require_once '../common/dbaccesUtil.php'; ?>
<?php session_start(); ?>

<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="UTF-8">
      <title>登録結果画面</title>
      <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php
    // #05
    if (empty($_POST['permission'])) {
        echo "<h3>不正なアクセスです！</h3><p>このページへ直接アクセスすることはできません。</p>";
        echo return_top();
        exit;
    }


    $_SESSION['datetime'] = date("Y-m-d H:i:s", time());

    //db接続 insert_
    $db_access = new Database();
    $db_access->insert_all();
    ?>


    <h1>登録結果画面</h1><br>
    名前:<?php echo $_SESSION["name"]; ?><br>
    生年月日:<?php echo $_SESSION["birthday"]; ?><br>
    種別:<?php echo $_SESSION["type"]; ?><br>
    電話番号:<?php echo $_SESSION["tell"]; ?><br>
    自己紹介:<?php echo $_SESSION["comment"]; ?><br>
    以上の内容で登録しました。<br>

    <?php echo return_top(); ?>

</body>

</html>
