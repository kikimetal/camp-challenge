<?php
require_once '../common/defineUtil.php';
require_once '../common/scriptUtil.php';
require_once '../common/dbaccessUtil.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>検索結果画面</title>
    <link rel="stylesheet" href="<?php echo ROOT_URL,'/css/style.css'?>">
</head>
<body>


    <header>
        <h2>ユーザー検索結果画面</h2>
    </header>

        <?php
        // ----retouch----
        // result_detail.php から戻ってくる際に、検索結果を保持していたいため、セッションを使う
        session_start();

        $_SESSION["direct_search_id"] = false;
        bind_g2s("search_name");
        bind_g2s("search_year");
        bind_g2s("search_type");

        // 確認用
        // var_dump($_SESSION);


        $result = null;
        if(empty($_GET['search_name']) && empty($_GET['search_year']) && empty($_GET['search_type'])){
            $result = serch_all_profiles();
        }else{
            // ----retouch----
            // -> search.php を修正
            // radio にしろ、checkbox にしろ、
            // 種別が未選択でここに来た時、$_GET['type'] が未定義で次の関数に入ってしまう
            $result = serch_profiles($_GET['search_name'],$_GET['search_year'],$_GET['search_type']);
        }
        // 確認用
        // var_dump($result);
        // var_dump($_GET["type"]);







        // ----retouch----
        // 空ではなく、配列ではない場合、Exception が帰ってきている
        if(!empty($result) and !is_array($result)){
            echo '<p>データの検索に失敗しました。次記のエラーにより処理を中断します。</p><p>'.$result.'</p>';

        }elseif(empty($result)){
            // ----retouch----
            // 何も帰ってこなかった時（検索ヒットなしの時）の表示パターン処理を追加

            ?>
            <!-- <tr>
                <td colspan="4">ヒットしませんでした。</td>
            </tr> -->
            <p>
                ヒットなし
            </p>
            <?php



        }else{
            // ----add----
            // 検索に成功してるの、ヒット数を表示させる。
            $hits = count($result);
            echo "<p>検索結果 : ".$hits."件ヒットしました。</p><br>";

            ?>
            <table border=1>
                <tr>
                    <th>名前</th>
                    <th>生年</th>
                    <th>種別</th>
                    <th>登録日時</th>
                </tr>
            <?php

            // ----retouch----
            // 空でなく配列の時、検索ヒットに成功しているので、表示を行う
            foreach($result as $value){
            ?>
                <tr>
                    <td><a href="<?php echo RESULT_DETAIL ?>?id=<?php echo $value['userID']?>"><?php echo $value['name']; ?></a></td>
                    <td><?php echo date('Y年n月j日', strtotime($value['birthday'])); ?></td>

                    <!-- <td><?php //echo $value['year'].'年'.$value['month'].'月'.$value['day'].'日';?></td> -->
                    <td><?php echo ex_typenum($value['type']); ?></td>
                    <!-- ----retouch---- -->
                    <!-- セミコロンが二つあるのを修正 -->
                    <!-- <td><?php // echo date('Y年n月j日　G時i分s秒', strtotime($value['newDate']));; ?></td> -->
                    <td><?php echo date('Y年n月j日　G時i分s秒', strtotime($value['newDate'])); ?></td>

                </tr>
            <?php
            } // foreach
            ?>
            </table>
            <?php
        } // else
        ?>


        <!-- ----add---- -->
        <br>
        <?php echo return_search(); ?>
        <?php echo return_top(); ?>

</body>
</html>
