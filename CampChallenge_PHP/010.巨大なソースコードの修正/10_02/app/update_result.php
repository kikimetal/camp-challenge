<?php
require_once '../common/defineUtil.php';
require_once '../common/scriptUtil.php';
require_once '../common/dbaccessUtil.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>更新結果画面</title>
    <link rel="stylesheet" href="<?php echo ROOT_URL,'/css/style.css'?>">
</head>
  <body>
      <header>
          <h2>更新結果画面</h2>
      </header>
    <?php
    // ----retouch----
    session_start();


    if(empty($_SESSION["reload_chk"]) and (empty($_POST["mode"]) or !$_POST["mode"] == "UPDATE_RESULT")){
        echo "<p>アクセスルートが不正です。もう一度トップページからやり直してください。</p>";
        echo return_top();
        exit;
    }


    // ****************************** ブラウザのリロード連投対策 *********************************
    if(empty($_SESSION["reload_chk"])){
        $_SESSION["reload_chk"] = true;
    ?>
        <meta http-equiv="refresh" content="0;<?php echo UPDATE_RESULT; ?>">
    <?php
        exit;
    }
    // リフレッシュ後は
    $_SESSION["reload_chk"] = null;
    // *******************************************************************************************



    // 確認用
    // var_dump($_SESSION["user_data"]);

    $user_data = $_SESSION["user_data"];

    $id = $user_data["userID"];
    $name = $user_data["name"];
    $birthday = $user_data["birthday"];
    $type = $user_data["type"];
    $tell = $user_data["tell"];
    $comment = $user_data["comment"];


    $result = update_profile($id, $name, $birthday, $type, $tell, $comment);
    //エラーが発生しなければ表示を行う
    if(!empty($result)){
        // エラーが返ってきた時
        echo '<p>データの更新に失敗しました。次記のエラーにより処理を中断します。</p><p>'.$result.'</p>';
    }else{
    ?>

    <h3>更新確認</h3>
    <p>内容の更新が完了しました。</p>

    <!-- ----retouch---- -->
    <!-- // 詳細画面へ戻るボタンを実装 -->
    <br>
    <p>変更内容の確認はこちら。</p>
    <form action="<?php echo RESULT_DETAIL."?id=".$user_data["userID"]; ?>" method="POST">
        <input type="submit" name="NO" value="詳細画面に戻る" style="width:100px">
    </form>

    <?php
    }

    // ----add----
    echo return_search();
    echo return_top();
    ?>
  </body>
</html>
