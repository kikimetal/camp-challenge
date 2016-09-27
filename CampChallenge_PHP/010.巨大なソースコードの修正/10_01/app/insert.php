<?php require_once '../common/defineUtil.php'; ?>
<?php require_once '../common/scriptUtil.php'; ?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
      <title>登録画面</title>
      <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <h3 class="center">ユーザー新規登録</h3>

    <form action="<?php echo INSERT_CONFIRM ?>" method="POST">
    名前:
    <input type="text" name="name" value="<?php echo_post("name"); ?>">
    <br><br>

    生年月日:　
    <select name="year">
        <option value="">----</option>
        <?php
        for ($i=1950; $i<=2010; $i++) {
        ?>
            <option value="<?php echo $i; ?>"<?php if (!empty($_POST['year']) && $_POST['year'] == $i) { echo " selected";} ?>><?php echo $i;?></option>
        <?php
        }
        ?>
    </select>年

    <select name="month">
        <option value="">--</option>
        <?php
        for ($i = 1; $i<=12; $i++) {
        ?>
            <option value="<?php echo $i;?>"<?php if (!empty($_POST['month']) && $_POST['month'] == $i) { echo " selected";} ?>><?php echo $i;?></option>
        <?php
        }
        ?>
    </select>月

    <select name="day">
        <option value="">--</option>
        <?php
        for ($i = 1; $i<=31; $i++) {
        ?>
            <option value="<?php echo $i; ?>"<?php if (!empty($_POST['day']) && $_POST['day'] == $i) { echo " selected";} ?>><?php echo $i;?></option>
        <?php
        }
        ?>
    </select>日
    <br><br>

    種別:
    <br>
    <input type="radio" name="type" value="エンジニア" <?php if (empty($_POST['type'])) { echo "checked"; } elseif ($_POST['type'] == "エンジニア") { echo "checked"; } ?>>エンジニア<br>
    <input type="radio" name="type" value="営業" <?php if (!empty($_POST['type']) && $_POST['type'] == "営業") { echo "checked"; } ?>>営業<br>
    <input type="radio" name="type" value="その他" <?php if (!empty($_POST['type']) && $_POST['type'] == "その他") { echo "checked"; } ?>>その他<br>
    <br>

    電話番号:
    <input type="text" name="tell" value="<?php if (!empty($_POST['tell'])) { echo $_POST['tell']; } ?>">
    <br><br>

    自己紹介文
    <br>
    <textarea name="comment" rows=10 cols=50 style="resize:none" wrap="hard"><?php echo_post("comment"); ?></textarea><br><br>

    <input type="hidden" name="permission" value="true">
    <input type="submit" name="btnSubmit" value="確認画面へ">
    </form>


    <footer>
        <?php
        echo return_top();
        ?>
    </footer>


</body>
</html>
