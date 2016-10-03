<?php require_once '../common/defineUtil.php'; ?>
<?php require_once '../common/scriptUtil.php'; ?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>ユーザー情報検索画面</title>
    <link rel="stylesheet" href="<?php echo ROOT_URL,'/css/style.css'?>">
</head>
  <body>
    <header>
        <h2>ユーザー情報検索画面</h2>
    </header>
    <h4>- 検索したいワードを入力してください。</h4>
    <p class="pre">    *全て未入力の場合は全てのユーザーを表示します。</p>

    <form action="<?php echo SEARCH_RESULT ?>" method="GET">

        名前:
        <br>
        <input type="text" name="search_name" value="<?php  ?>">
        <br><br>

        生年:
        <br>
        <select name="search_year">
            <option value="">----</option>
            <?php
            for($i=1950; $i<=2010; $i++){ ?>
              <option value="<?php echo $i;?>"><?php echo $i;?></option>
            <?php } ?>
        </select>年生まれ
        <br><br>

        種別:
        <br>
        <p>*複数チェックした場合、いずれかに当てはまるユーザーを検索します。</p>
        <!-- ----retouch---- -->
        <!-- 複合検索で、選択した種別を含むユーザーを検索する挙動に変更致しました。 -->
        <!-- search_result.phpに記述した、type が未定義で関数に入ってしまう不具合を、修正致しました。 -->
            <!-- 隠し属性で value="" を送ってあげる -->
            <!-- 下の一覧から選択されれば上書きされる -->
        <input type="hidden" name="search_type" value="">

        <?php
        for($i = 1; $i<=3; $i++){ ?>
        <input type="checkbox" name="search_type[]" value="<?php echo $i; ?>"><?php echo ex_typenum($i);?><br>
        <?php } ?>
        <br>
        <input type="submit" name="btnSubmit" value="検索">
    </form>

    <!-- ----add---- -->
    <!-- 全ユーザー検索のボタンの追加致しました。 -->
    <br>
    <h4>- 全てのユーザーを表示したい場合はこちら。</h4>
    <form ckass="button" action="<?php echo SEARCH_RESULT ?>" method="GET">
        <input type="hidden" name="search_name" value="">
        <input type="hidden" name="search_year" value="">
        <input type="hidden" name="search_type" value="">
        <input type="submit" name="btnSubmit" value="全ユーザー検索">
    </form>
    <br>

    <!-- ----add---- -->
    <!-- サーチ結果画面でクエリストリングを直接変更するような方や、すでにユーザーのIDをご存知の方などへ向けて、ID検索の昨日を追加致しました。 -->
    <h5>- IDでユーザーを検索したい場合はこちら</h5>
    <a href="<?php echo RESULT_DETAIL; ?>"><button>ID検索をする</button></a>

      <!-- ----add---- -->
      <!-- トップページへ戻るリンクを追加致しました。 -->
      <?php echo return_top(); ?>
  </body>
</html>
