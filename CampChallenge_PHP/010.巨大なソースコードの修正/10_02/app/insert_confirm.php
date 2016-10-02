<?php require_once '../common/defineUtil.php'; ?>
<?php require_once '../common/scriptUtil.php'; ?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>登録確認画面</title>
    <link rel="stylesheet" href="<?php echo ROOT_URL,'/css/style.css'?>">
</head>
  <body>
    <?php
    //入力画面から「確認画面へ」ボタンを押した場合のみ処理を行う
    // ----retouch----
    // if(!$_POST['mode']=="CONFIRM"){
    // ----retouch----
    // insertページ間の移動なので、ミスが起きないように、insert_ を追加
    if(empty($_POST['mode']) or !$_POST['mode'] == "insert_CONFIRM"){
        echo "<p>アクセスルートが不正です。もう一度トップページからやり直してください。</p>";
        echo return_top();
        exit;
    }else{
    ?>
    <!-- add -->
    <header>
        <h2>ユーザー登録確認画面</h2>
    </header>
    <?php

        session_start();

        //ポストの存在チェックとセッションに値を格納しつつ、連想配列にポストされた値を格納
        $confirm_values = array(
                                // ----retouch----
                                // 'name' => bind_p2s('name'),
                                // 'year' => bind_p2s('year'),
                                // 'month' =>bind_p2s('month'),
                                // 'day' =>bind_p2s('day'),
                                // 'type' =>bind_p2s('type'),
                                // 'tell' =>bind_p2s('tell'),
                                // 'comment' =>bind_p2s('comment'));
                                'name' => bind_p2s('insert_name'),
                                'year' => bind_p2s('insert_year'),
                                'month' =>bind_p2s('insert_month'),
                                'day' =>bind_p2s('insert_day'),
                                'type' =>bind_p2s('insert_type'),
                                'tell' =>bind_p2s('insert_tell'),
                                'comment' =>bind_p2s('insert_comment'));


        // ----add----
        // 電話番号チェック
        if(!empty($confirm_values["tell"])){
            // $tell_flg = preg_match("/^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$/",$_POST["tell"]);
            $tell_flg = preg_match("/(^(?<!090|080|070)(^\d{2,5}?\-\d{1,4}?\-\d{4}$|^&#91;\d\-&#93;{12}$))|(^(090|080|070)(\-\d{4}\-\d{4}|&#91;\\d-&#93;{13})$)|(^0120(\-\d{2,3}\-\d{3,4}|&#91;\d\-&#93;{12})$)|(^0080\-\d{3}\-\d{4})/",$confirm_values["tell"]);
        }
        // var_dump($tell_flg);



        //1つでも未入力項目があったら表示しない
        if (!in_array(null, $confirm_values, true) and !empty($tell_flg)) {
            $_SESSION["insert_tell_flg"] = true;
            ?>
            <!-- <h1>登録確認画面</h1><br> -->
            名前 : <?php echo $confirm_values['name'];?><br>
            生年月日 : <?php echo $confirm_values['year'].'年'.$confirm_values['month'].'月'.$confirm_values['day'].'日';?><br>
            種別 : <?php echo ex_typenum($confirm_values['type']);?><br>
            電話番号 : <?php echo $confirm_values['tell'];?><br>
            自己紹介 : <?php echo $confirm_values['comment'];?><br><br>

            <p>上記の内容で登録します。よろしいですか？</p>

            <form class="button" action="<?php echo INSERT_RESULT ?>" method="POST">
                <input type="hidden" name="mode" value="insert_RESULT" >
                <input type="submit" name="yes" value="はい">
            </form>
            <?php
        } else {
            ?>

            <h3>- 入力項目が不完全です！</h3>
            <p>再度入力を行ってください。</p>
            <br>
            <h4>- 不完全な項目</h4>

            <?php
            $_SESSION["insert_tell_flg"] = true;
            //連想配列内の未入力項目を検出して表示
            foreach ($confirm_values as $key => $value){
                if($value == null){
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
                if($key == 'tell' and $value != null and empty($tell_flg)){
                    echo "<p><span class='crimson'>＊電話番号の入力形式が間違っています。</span></p>";
                    $_SESSION["insert_tell_flg"] = false;
                }
            }
        }
        ?>
        <br>
        <p>登録情報を変更する場合はこちら。</p>
        <form class="button" action="<?php echo INSERT ?>" method="POST">
            <input type="hidden" name="mode" value="insert_REINPUT" >
            <input type="submit" name="no" value="登録画面に戻る">
        </form>
        <?php
    }
    echo return_top();
    ?>
</body>
</html>
