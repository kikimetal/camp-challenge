<?php require_once '../common/scriptUtil.php'; ?>
<?php require_once '../common/dbaccessUtil.php'; ?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>登録結果画面</title>
    <link rel="stylesheet" href="<?php echo ROOT_URL,'/css/style.css'?>">
</head>
    <body>
        <header>
            <h2>ユーザー登録結果画面</h2>
        </header>

    <?php
    session_start();
    // ----retouch----
    // $_POST[mode]の存在をチェックしてからmodeの値を比較するように変更致しまいした。
    // また$_SESSION[reload_chk]は以下のブラウザのリロード対策に必要なのでこれも追加致しました。
    if(empty($_SESSION["reload_chk"]) and (empty($_POST['mode']) or !$_POST['mode']=="insert_RESULT")){
        echo "<p>アクセスルートが不正です。もう一度トップページからやり直してください。</p>";
        echo return_top();
        exit;
    }else{

        // ----add----
        // ****************************** ブラウザのリロード連投対策 *********************************
        // ブラウザ側のリロードによるフォーム再入力で、手軽な操作で何度もDBアクセスし、
        // ユーザーを登録できてしまうのを禁止するための処理を追加致しました。
        // $_POST[mode] が許可された場合のみここにジャンプ致します。
        if(empty($_SESSION["reload_chk"])){
            $_SESSION["reload_chk"] = true;
        ?>
            <meta http-equiv="refresh" content="0;<?php echo INSERT_RESULT; ?>">
        <?php
            exit;
        }
        // リフレッシュ後は値がnullに かつ ここのページを介しているので$_POSTが空にになることにより、連投を防ぎます。
        $_SESSION["reload_chk"] = null;
        // *******************************************************************************************

        $name = $_SESSION['insert_name'];
        //date型にするために1桁の月日を2桁にフォーマットしてから格納
        $birthday = $_SESSION['insert_year'].'-'.sprintf('%02d',$_SESSION['insert_month']).'-'.sprintf('%02d',$_SESSION['insert_day']);
        $type = $_SESSION['insert_type'];
        $tell = $_SESSION['insert_tell'];
        $comment = $_SESSION['insert_comment'];

        //データのDB挿入処理。エラーの場合のみエラー文がセットされる。成功すればnull
        $result = insert_profiles($name, $birthday, $type, $tell, $comment);

        // ----retouch----
        // 記述が短いエラーケースを先に記述致しました。
        if(!empty($result)){
            echo '<p>データの挿入に失敗しました。次記のエラーにより処理を中断します。</p><p>'.$result.'</p>';
        }else{
            // エラーがなければこちらの処理へ。
        ?>

            <h3>登録完了</h3>
            <br>
            名前 : <?php echo $name;?><br>
            <!-- // ----add---- -->
            <!-- 年月日フォーマットを変更致しました。 -->
            生年月日 : <?php echo date('Y年n月j日', strtotime($birthday));?><br>
            種別 : <?php echo ex_typenum($type);?><br>
            電話番号 : <?php echo $tell;?><br>
            自己紹介 : <?php echo $comment;?><br><br>
            以上の内容で登録しました。<br>

        <?php
        }
        // ----add----
        // インサートページ、トップページへのリンクを追加致しました。
        // 不正アクセス時に続けて登録が表示されてしまわないように、ここは位置が分かれています。
        echo return_insert();
    }
    echo return_top();
    ?>
    </body>
</html>
