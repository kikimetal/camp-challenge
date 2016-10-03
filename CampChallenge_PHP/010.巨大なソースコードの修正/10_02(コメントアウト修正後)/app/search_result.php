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
        // result_detail.php から戻ってくる際に、検索結果が保持される処理を追加致しました。
        session_start();

        $_SESSION["direct_search_id"] = false;
        bind_g2s("search_name");
        bind_g2s("search_year");
        bind_g2s("search_type");

        $result = null;
        if(empty($_GET['search_name']) && empty($_GET['search_year']) && empty($_GET['search_type'])){
            $result = serch_all_profiles();
        }else{
            // ----retouch----
            // -> search.php を修正
            // radio、checkbox ともに、種別が未選択でここに来た時、$_GET['type'] が未定義で次の関数に入ってしまうのを修正いたしました。
            $result = serch_profiles($_GET['search_name'],$_GET['search_year'],$_GET['search_type']);
        }

        // ----retouch----
        // DBアクセス後の処理を修正、追加致しました。
        if(!empty($result) and !is_array($result)){
            // 空ではなく、配列ではない場合、Exception が帰ってきている。
            echo '<p>データの検索に失敗しました。次記のエラーにより処理を中断します。</p><p>'.$result.'</p>';
        }elseif(empty($result)){
            // ----retouch----
            // 何も帰ってこなかった時（検索ヒットなしの時）の表示パターン処理を追加致しました。
        ?>

            <p>検索結果 : ヒットしませんでした。</p>

        <?php
        }else{
            // ----add----
            // 検索に成功してるので、ヒット数を表示させます。
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
                // 空でなく配列の時、検索ヒットに成功しているので、表示を行います。
                foreach($result as $value){
                ?>

                    <tr>
                        <td><a href="<?php echo RESULT_DETAIL ?>?id=<?php echo $value['userID']?>"><?php echo $value['name']; ?></a></td>
                        <!-- ----add---- -->
                        <!-- 表示させる年月日のフォーマットを変更致しました。 -->
                        <td><?php echo date('Y年n月j日', strtotime($value['birthday'])); ?></td>
                        <td><?php echo ex_typenum($value['type']); ?></td>
                        <!-- ----retouch---- -->
                        <!-- セミコロンが二つあるのを削除修正致しました。 -->
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
        <!-- サーチページ、トップページへ戻るリンクを追加致しました。 -->
        <br>
        <?php echo return_search(); ?>
        <?php echo return_top(); ?>

</body>
</html>
