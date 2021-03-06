<?php
require_once '../common/defineUtil.php';
require_once '../common/scriptUtil.php';
require_once '../common/dbaccessUtil.php';
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>ユーザー情報詳細画面</title>
    <link rel="stylesheet" href="<?php echo ROOT_URL,'/css/style.css'?>">
</head>
  <body>
    <header>
        <h2>ユーザー情報詳細画面</h2>
    </header>

    <?php
    session_start();

    // ----add----
    // 不測のダイレクトアクセス時の挙動を自然にするための処理を追加致しました。
    // 同時に、関係者や玄人向けのID検索機能を果たします。
    if(empty($_GET['id'])){
        ?>

        <h4>検索したいユーザーのIDを入力してください。</h4>
        <form class="" action="<?php echo RESULT_DETAIL; ?>" method="get">
            <input type="text" name="id" size="10">
            <input type="submit" name="submitbtn" value="ID検索">
        </form>

        <?php
        $_SESSION["direct_search_id"] = true;
        echo return_search();
        echo return_top();
        exit;
    }

    $result = profile_detail($_GET['id']);

    // ----retouch----
    // エラーケースの方が記述が短いため、先に記述いたしました。
    if(!is_array($result)){
        // 配列でないものが帰ってきた場合、エラーなので表示を行う
        echo '<p>データの検索に失敗しました。次記のエラーにより処理を中断します。</p><p>'.$result.'</p>';

    }elseif(empty($result)){
        // 空の配列が帰ってきた場合、DBに存在しない id を検索している
        // クエリストリングを自分で存在しない id を入力した際に、このケースに当てはまってくる
        echo "<p>そのユーザーIDでの登録は存在しません。</p>";


    }else{
        // 配列の場合はこちら。エラーでないので表示を行う。
        // この時、１レコードしか返ってこないので、後の記述を簡潔にするために配列を入れ替える。
        $user_data = $result[0];
    ?>

        <!-- ----retouch---- -->
        <!-- 全カラム表示なので、このままだと ID が抜けているので、追加致しました。 -->
        ID : <?php echo $user_data['userID'];?><br>

        名前 : <?php echo $user_data['name'];?><br>
        <!-- ----add---- -->
        <!-- 年月日のフォーマットを変更致しました -->
        生年月日 : <?php echo date('Y年n月j日', strtotime($user_data['birthday'])); ?><br>
        種別 : <?php echo ex_typenum($user_data['type']);?><br>
        電話番号 : <?php echo $user_data['tell'];?><br>
        自己紹介 : <?php echo $user_data['comment'];?><br>
        登録日時 : <?php echo date('Y年n月j日　G時i分s秒', strtotime($user_data['newDate'])); ?><br>

        <?php
        // ----retouch----
        // 仕様書ではここからUPDATE,DELETEページへ移行する際にデータを渡すとありますので、その処理を追加致しました。
        // ユーザーの全データをセッションに入れる。
        $_SESSION["user_data"] = $user_data;
        ?>

        <form action="<?php echo UPDATE; ?>" method="POST">
            <!-- ----retouch---- -->
            <!-- 画面遷移でアクセスを認識するようにするため、隠し属性のフォームを追加致しました。 -->
            <input type="hidden" name="mode" value="UPDATE">
            <input type="submit" name="update" value="変更" style="width:100px">
        </form>
        <form action="<?php echo DELETE; ?>" method="POST">
            <!-- ----retouch---- -->
            <!-- 画面遷移でアクセスを認識するようにするため、隠し属性のフォームを追加致しました。 -->
            <input type="hidden" name="mode" value="DELETE">
            <input type="submit" name="delete" value="削除" style="width:100px">
        </form>
    <?php
    } // else
    ?>

    <!-- add -->
    <br>

    <?php
    if(empty($_SESSION["direct_search_id"])){
        // ----add----
        // ID検索時は検索結果画面を介さない特別なパターンなので、ここで分岐する必要があります。
            // ----retouch----
            // 検索結果画面へ戻るボタンを追加致しました。
            // 対応するセッションが存在すれば、ゲットで送ってあげる仕組みです。
    ?>
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
    }else{
    ?>
        <a href="<?php echo RESULT_DETAIL; ?>"><button>もう一度ID検索をする</button></a>
    <?php
    }
    ?>


    <?php
    // ----add----
    // サーチページ、トップページへ戻るボタンを追加致しました。
    echo return_search();
    echo return_top();
    ?>
  </body>
</html>
