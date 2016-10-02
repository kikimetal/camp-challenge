<?php
require_once '../common/defineUtil.php';
require_once '../common/scriptUtil.php';
require_once '../common/dbaccessUtil.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>削除確認画面</title>
    <link rel="stylesheet" href="<?php echo ROOT_URL,'/css/style.css'?>">
</head>
  <body>
      <header>
          <h2>削除確認画面</h2>
      </header>
    <?php
    // ----retouch----
    // DBから取得するのでなく、result_detail.phpから受け取る
    // $result = profile_detail($_GET['id']);
    //エラーが発生しなければ表示を行う
    // if(is_array($result)){
    session_start();

    if(empty($_SESSION["user_data"]) or empty($_POST["mode"]) or $_POST["mode"] != "DELETE"){
        echo "<p>アクセスルートが不正です。もう一度トップページからやり直してください。</p>";
        echo return_top();
        exit;
    }else{
        $user_data = $_SESSION["user_data"];
    }
    ?>

    <h2>削除確認</h2>
    <p><b>*この操作は取り消しができません。</b></p>
    <br>
    <p>以下の内容を削除します。</p>
    <p>本当によろしいですか？</p>
    <br>

    <!-- // ----retouch---- -->
    <!-- 仕様書の規定で対象の全レコードを表示なので、IDの表示を追加 -->
    ID : <?php echo $user_data['userID']; ?><br>

    名前 : <?php echo $user_data['name'];?><br>
    <!-- ----add---- -->
    <!-- 年月日フォーマットを変更 -->
    生年月日 : <?php echo date('Y年n月j日', strtotime($user_data['birthday'])); ?><br>
    種別 : <?php echo ex_typenum($user_data['type']);?><br>
    電話番号 : <?php echo $user_data['tell'];?><br>
    自己紹介 : <?php echo $user_data['comment'];?><br>
    登録日時 : <?php echo date('Y年n月j日　G時i分s秒', strtotime($user_data['newDate'])); ?><br>

    <form action="<?php echo DELETE_RESULT; ?>" method="POST">
        <input type="hidden" name="mode" value="DELETE">
        <input type="hidden" name="delete_user_id" value="<?php echo $user_data["userID"]; ?>">
        <input type="submit" name="YES" value="削除する"style="width:100px">
    </form><br>

    <!-- ----retouch---- -->
    <!-- <form action="<?php // echo RESULT_DETAIL; ?>" method="POST"> -->
    <form action="<?php echo RESULT_DETAIL."?id=".$user_data["userID"]; ?>" method="POST">
        <input type="submit" name="NO" value="詳細画面に戻る"style="width:100px">
    </form>

    <?php
    // }else{
    //     echo 'データの取得に失敗しました。次記のエラーにより処理を中断します:'.$result;
    // }
    echo return_search();
    echo return_top();
    ?>
   </body>
</html>
