<?php require_once '../common/defineUtil.php'; ?>
<?php require_once '../common/scriptUtil.php'; ?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
    <title>ユーザー情報管理トップ</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1 class="center">ユーザー情報管理トップ画面</h1><br>
    <h3>ここでは、ユーザー情報管理システムとしてユーザー情報の登録や検索、
        付随して修正や削除を行うことができます</h3><br>
    <a href="<?php echo INSERT; ?>">新規登録</a><br>
    <a href="<?php echo SEARCH; ?>" >検索(修正・削除)</a><br>

</body>
</html>
