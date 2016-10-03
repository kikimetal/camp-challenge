<?php
require_once '../common/defineUtil.php';
require_once '../common/scriptUtil.php';
require_once '../common/dbaccessUtil.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>削除結果画面</title>
    <link rel="stylesheet" href="<?php echo ROOT_URL,'/css/style.css'?>">
</head>
<body>
    <header>
        <h2>削除結果画面</h2>
    </header>

    <?php
    // ----add----
    // 不正アクセスへの処理を追加致しました。
    if(empty($_POST["mode"]) or !$_POST["mode"] == "DELETE" or empty($_POST["delete_user_id"])){
        echo "<p>アクセスルートが不正です。もう一度トップページからやり直してください。</p>";
        echo return_top();
        exit;
    }

    // ----retouch----
    // get でなく post で受け取るように変更致しました。
    $result = delete_profile($_POST['delete_user_id']);

    if(!empty($result)){
        echo '<p>データの削除に失敗しました。次記のエラーにより処理を中断します。</p><p>'.$result.'</p>';
    }else{
    session_start();
    ?>
        <h2>削除確認</h2>
        <p>削除しました。</p>

        <!-- // ----retouch---- -->
        <!-- 検索画面へ戻るボタンを実装致しました。 -->
        <form class="" action="<?php echo SEARCH_RESULT; ?>" method="get">
            <input type="hidden" name="search_name" value="<?php if(!empty($_SESSION["search_name"])){echo $_SESSION["search_name"];}?>">
            <input type="hidden" name="search_year" value="<?php if(!empty($_SESSION["search_year"])){echo $_SESSION["search_year"];}?>">
            <?php
            if(!empty($_SESSION["search_type"])){
                for($i=0; $i < count($_SESSION["search_type"]); $i++){
            ?>
                    <input type="hidden" name="search_type[]" value="<?php if(!empty($_SESSION["search_type"])){echo $_SESSION["search_type"][$i];}?>">
            <?php
                }
            }else{
            ?>
                <input type="hidden" name="search_type" value="">
            <?php
            }
            ?>
            <input type="submit" name="submit" value="検索画面へ戻る">
        </form>

    <?php
    } // else
    // ----add----
    // サーチページ、トップページへのリンクを追加致しました。
    echo return_search();
    echo return_top();
    ?>
    <!-- // ----retouch---- -->
    <!-- body タグが２個ありましたので、片方をを削除致しました。 -->
</body>
</html>
