<?php require_once '../common/defineUtil.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ユーザー情報管理トップ</title>
    <link rel="stylesheet" href="<?php echo ROOT_URL,'/css/style.css'?>">
</head>
<body>
    <header>
        <h2>ユーザー情報管理トップ画面</h2>
    </header>
    <h3>ここでは、ユーザー情報管理システムとしてユーザー情報の登録や検索、
        付随して修正や削除を行うことができます。</h3><br>
    <a href="<?php echo INSERT; ?>">-> 新規ユーザー登録</a><br>
    <a href="<?php echo SEARCH; ?>" >-> ユーザー検索(修正・削除)</a><br>
</body>
</html>
