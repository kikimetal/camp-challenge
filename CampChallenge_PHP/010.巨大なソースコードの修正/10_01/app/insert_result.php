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


    // session_start();
    $name = $_SESSION['name'];
    $birthday = $_SESSION['birthday'];
    $type = $_SESSION['type'];
    $tell = $_SESSION['tell'];
    $comment = $_SESSION['comment'];
    
    // #06
    $datetime = date("Y-m-d H:i:s", time());
    // セッションにも入れておく
    $_SESSION['datetime'] = $datetime;



    //db接続
    $db_access = new Database();
    $db_access->insert_all();
    ?>



    <h1>登録結果画面</h1><br>
    名前:<?php echo $name;?><br>
    生年月日:<?php echo $birthday;?><br>
    種別:<?php echo $type?><br>
    電話番号:<?php echo $tell;?><br>
    自己紹介:<?php echo $comment;?><br>
    以上の内容で登録しました。<br>

    <?php echo return_top(); ?>

</body>

</html>
