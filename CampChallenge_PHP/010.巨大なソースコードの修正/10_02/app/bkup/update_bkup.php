<?php
require_once '../common/defineUtil.php';
require_once '../common/scriptUtil.php';
require_once '../common/dbaccessUtil.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>変更入力画面</title>
    <link rel="stylesheet" href="<?php echo ROOT_URL,'/css/style.css'?>">
</head>
<body>
    <form action="<?php echo UPDATE_RESULT ?>" method="POST">
    <?php
    // ----retouch----
    // $result = profile_detail($_GET['id']);
    // これは id を元に、すべてのカラムを引き出す関数だが、前ページですべてのカラムは既に受け取っており、
    // DBアクセスの回数を増やす手段となります。ので、前ページから post + session で受け取る方法に変更します。
    session_start();
    // UPDATE処理はDBを書き換えてしまう重要な操作なので、不正ルートアクセスを弾くようにする。
    if(empty($_SESSION["user_data"]) or empty($_POST["mode"]) or $_POST["mode"] != "UPDATE"){
        echo "<p>アクセスルートが不正です。もう一度トップページからやり直してください。</p>", return_top();
        exit;
    }else{
        $user_data = $_SESSION["user_data"];
        // またこのままだと、受け取った生年月日 ([birthday]) が year month day に対応していないため、分解
        $user_data['year'] = date('Y', strtotime($user_data['birthday']));
        $user_data["month"] = date('n',strtotime($user_data["birthday"]));
        $user_data["day"] = date('d',strtotime($user_data["birthday"]));

        // 確認用
        var_dump($user_data);

    }
    ?>
    名前:
    <input type="text" name="update_name" value="<?php echo $user_data['name']; ?>">
    <br><br>

    生年月日:　
    <select name="update_year">
        <option value="">----</option>
        <?php
        for($i=1950; $i<=2010; $i++){ ?>
        <option value="<?php echo $i;?>" <?php if($i==$user_data['year']){echo "selected";} ?>><?php echo $i ;?></option>
        <?php } ?>
    </select>年
    <select name="update_month">
        <option value="">--</option>
        <?php
        for($i = 1; $i<=12; $i++){?>
        <option value="<?php echo $i;?>" <? if($i==$user_data['month']){echo "selected";} ?>><?php echo $i;?></option>
        <?php } ;?>
    </select>月
    <select name="update_day">
        <option value="">--</option>
        <?php
        for($i = 1; $i<=31; $i++){ ?>
        <option value="<?php echo $i; ?>" <?php if($i==$user_data['day']){echo "selected";} ?>><?php echo $i;?></option>
        <?php } ?>
    </select>日
    <br><br>

    種別:
    <br>
    <?php
    for($i = 1; $i<=3; $i++){ ?>
    <input type="radio" name="update_type" value="<?php echo $i; ?>"<?php if($i==$user_data['type']){echo "checked";}?>><?php echo ex_typenum($i);?><br>
    <?php } ?>
    <br>

    電話番号:
    <input type="text" name="update_tell" value="<?php echo $user_data['tell']; ?>">
    <br><br>

    自己紹介文
    <br>
    <textarea name="update_comment" rows=10 cols=50 style="resize:none" wrap="hard"><?php echo $user_data['comment']; ?></textarea><br><br>

    <input type="hidden" name="mode"  value="RESULT">
    <input type="submit" name="btnSubmit" value="以上の内容で更新を行う">
    </form>

    <!-- ----retouch---- -->
    <form action="<?php echo RESULT_DETAIL."?id=".$user_data["userID"]; ?>" method="POST">
        <input type="submit" name="NO" value="詳細画面に戻る" style="width:100px">
    </form>
    <?php echo return_top(); ?>
</body>

</html>
