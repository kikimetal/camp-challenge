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
    <header>
        <h2>ユーザー情報変更画面</h2>
    </header>

    <?php
    // ----retouch----
    // $result = profile_detail($_GET['id']);
    // これは id を元に、すべてのカラムを引き出す関数だが、前ページですべてのカラムは既に受け取っており、
    // DBアクセスの回数を増やす手段となります。ので、前ページから post + session で受け取る方法に変更します。
    session_start();
    // UPDATE処理はDBを書き換えてしまう重要な操作なので、不正ルートアクセスを弾くようにする。
    if(empty($_SESSION["user_data"]) or empty($_POST["mode"])){
        // ************************************ 不正アクセス mode == null *************************************************
        echo "<p>アクセスルートが不正です。もう一度トップページからやり直してください。</p>";
        echo return_top();
        exit;

    }elseif($_POST["mode"] == "update_CONFIRM"){
    // *************************************** 登録ボタンを押して再読み込み時 ************************************************
        // リダイレクト時

        $user_data["birthday"] = $_POST['update_year'].'-'.sprintf('%02d',$_POST['update_month']).'-'.sprintf('%02d',$_POST['update_day']);
        $user_data["name"] = $_POST["update_name"];
        $user_data["year"] = $_POST["update_year"];
        $user_data["month"] = $_POST["update_month"];
        $user_data["day"] = $_POST["update_day"];
        $user_data["tell"] = $_POST["update_tell"];
        $user_data["type"] = $_POST["update_type"];
        $user_data["comment"] = $_POST["update_comment"];
        $user_data["userID"] = $_POST["userID"];

        $_SESSION["user_data"] = $user_data;


        $complete = true;

        foreach ($user_data as $key => $value) {
            if(empty($value)){
                $unanswerd_flg[$key] = true;
                $complete = false;
            }else{
                $unanswerd_flg[$key] = false;
            }
        }

        // ----add----
        // 電話番号チェック
        if(!empty($user_data["tell"])){
            // $tell_flg = preg_match("/^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$/",$user_data["tell"]);
            $tell_flg = preg_match("/(^(?<!090|080|070)(^\d{2,5}?\-\d{1,4}?\-\d{4}$|^&#91;\d\-&#93;{12}$))|(^(090|080|070)(\-\d{4}\-\d{4}|&#91;\\d-&#93;{13})$)|(^0120(\-\d{2,3}\-\d{3,4}|&#91;\d\-&#93;{12})$)|(^0080\-\d{3}\-\d{4})/",$user_data["tell"]);
            if(!$tell_flg){
                $complete = false;
            }
        }



        if($complete){
            // **************************************** $complete == true ***********************************************
            // すべて入力されていた時
            $_SESSION["update_tell_flg"] = true;
            ?>
            <h4>この内容で本当に変更してよろしいですか？</h4>
            <p><b>*この操作は取り消せません。</b></p>

            <br>
            名前 : <?php echo $user_data['name'];?><br>
            <!-- // ----add---- -->
            <!-- 年月日フォーマット変更 -->
            生年月日 : <?php echo $user_data['year'].'年'.$user_data['month'].'月'.$user_data['day'].'日';?><br>
            種別 : <?php echo ex_typenum($user_data['type']);?><br>
            電話番号 : <?php echo $user_data['tell'];?><br>
            自己紹介 : <?php echo $user_data['comment'];?><br>
            <br>


            <form class="" action="<?php echo UPDATE_RESULT; ?>" method="post">
                <input type="hidden" name="mode" value="UPDATE_RESULT">
                <button type="submit" name="submitbtn" value="yes">はい</button>
            </form>


            <form class="" action="<?php echo UPDATE; ?>" method="post">
                <input type="hidden" name="mode" value="UPDATE">
                <button type="submit" name="submitbtn" value="yes">もう一度内容を編集する</button>
            </form>



            <?php
            // **********************************************************************************************************

        }else{
            // **************************************** $complete == false ***********************************************
            // 再読み込みの結果、何か抜けていた時
        ?>
            <h3>- 入力項目が不完全です！</h3>
            <p>再度入力を行ってください。</p>
            <br>
            <h4>- 不完全な項目</h4>
        <?php
            $_SESSION["update_tell_flg"] = true;
            //連想配列内の未入力項目を検出して表示
            foreach ($unanswerd_flg as $key => $value){
                if($key == "userID" or $key == "birthday" or $key == "submitbtn" or $key == "mode"){
                    continue;
                }elseif($value == true){
                    echo "<p><span class='crimson'>";
                    if($key == 'name'){
                        echo '＊名前';
                    }
                    if($key == 'year'){
                        echo '＊年';
                    }
                    if($key == 'month'){
                        echo '＊月';
                    }
                    if($key == 'day'){
                        echo '＊日';
                    }
                    if($key == 'type'){
                        echo '＊種別';
                    }
                    if($key == 'tell'){
                        echo '＊電話番号';
                    }
                    if($key == 'comment'){
                        echo '＊自己紹介';
                    }
                    echo 'が未記入です。</span></p>';
                }
                if($key == 'tell' and $value != true and empty($tell_flg)){
                    echo "<p><span class='crimson'>＊電話番号の入力形式が間違っています。</span></p>";
                    $_SESSION["update_tell_flg"] = false;
                }
            } // foreach
            ?>
            <form class="" action="<?php echo UPDATE; ?>" method="post">
                <input type="hidden" name="mode" value="un_complete">
                <button type="submit" name="submitbtn" value="yes">戻って再入力する</button>
            </form>

            <?php
        } // if $complete else
        // **********************************************************************************************************


    }else{
        // *********************** 初回アクセス    or   $comlete == false で帰ってきた時 ****************************
        $user_data = $_SESSION["user_data"];
        // またこのままだと、受け取った生年月日 ([birthday]) が year month day に対応していないため、分解
        if(!isset($user_data["year"]) and !isset($user_data["year"]) and !isset($user_data["year"])){
            $user_data["year"] = date('Y', strtotime($user_data['birthday']));
            $user_data["month"] = date('n',strtotime($user_data["birthday"]));
            $user_data["day"] = date('d',strtotime($user_data["birthday"]));
        }

    ?>
    <form action="<?php echo UPDATE ?>" method="POST">
        <?php echo update_input_chk("名前: ","name"); ?>
        <input type="text" name="update_name" value="<?php echo $user_data['name']; ?>">
        <br><br>

        <?php echo update_input_chk("生年月日: ","year","month","day"); ?>
        <select name="update_year">
            <option value="">----</option>
            <?php
            for($i=1950; $i<=2010; $i++){ ?>
            <option value="<?php echo $i;?>" <?php if($i==$user_data['year']){echo "selected";} ?>><?php echo $i ;?></option>
            <?php } ?>
        </select>
        <?php echo update_input_chk("年","year"); ?>
        <select name="update_month">
            <option value="">--</option>
            <?php
            for($i = 1; $i<=12; $i++){?>
            <option value="<?php echo $i;?>" <? if($i==$user_data['month']){echo "selected";} ?>><?php echo $i;?></option>
            <?php } ;?>
        </select>
        <?php echo update_input_chk("月","month"); ?>
        <select name="update_day">
            <option value="">--</option>
            <?php
            for($i = 1; $i<=31; $i++){ ?>
            <option value="<?php echo $i; ?>" <?php if($i==$user_data['day']){echo "selected";} ?>><?php echo $i;?></option>
            <?php } ?>
        </select>
        <?php echo update_input_chk("日","day"); ?>
        <br><br>

        <?php echo update_input_chk("種別: ","type"); ?>
        <br>
        <?php
        for($i = 1; $i<=3; $i++){ ?>
        <input type="radio" name="update_type" value="<?php echo $i; ?>"<?php if($i==$user_data['type']){echo "checked";}?>><?php echo ex_typenum($i);?><br>
        <?php } ?>
        <br>

        <?php echo update_input_chk("電話番号:<br>*半角数字とハイフン(-)で記入してください。例) 080-1122-3344<br>","tell","tell_flg"); ?>
        <input type="text" name="update_tell" value="<?php echo $user_data['tell']; ?>">
        <br><br>

        <?php echo update_input_chk("自己紹介文: ","comment"); ?>
        <br>
        <textarea name="update_comment" rows=10 cols=50 style="resize:none" wrap="hard"><?php echo $user_data['comment']; ?></textarea><br><br>

        <!-- ----retouch---- -->
        <!-- ユーザーのIDも同時にポストで送ってあげる -->
        <input type="hidden" name="userID" value="<?php echo $user_data["userID"]; ?>">

        <input type="hidden" name="mode" value="update_CONFIRM">
        <button type="submit" name="submitbtn" value="yes">以上の内容で更新を行う</button>
        </form>




        <!-- ----retouch---- -->
        <form action="<?php echo RESULT_DETAIL."?id=".$user_data["userID"]; ?>" method="POST">
            <input type="submit" name="NO" value="詳細画面に戻る" style="width:100px">
        </form>


    <?php
    }
    ?>


    <?php echo return_top(); ?>
</body>

</html>
