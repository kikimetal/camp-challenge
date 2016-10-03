<?php require_once '../common/defineUtil.php'; ?>
<?php require_once '../common/scriptUtil.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>登録画面</title>
    <link rel="stylesheet" href="<?php echo ROOT_URL,'/css/style.css'?>">
</head>
<body>
    <!-- add -->
    <header>
        <h2>新規ユーザー登録画面</h2>
    </header>
    <h3>- プロフィールを全て入力してください。</h3>

    <?php session_start(); // 再入力時用 ?>
    <form action="<?php echo INSERT_CONFIRM ?>" method="POST">

        <!-- ----add---- -->
        <!-- コンファームから戻ってきた際に、入力がされていなかった項目のカラーが赤色へ変更されるように変更致しました。 -->

        <?php echo insert_input_chk("名前:","insert_name");?>
        <input type="text" name="insert_name" value="<?php echo form_value('insert_name'); ?>">
        <br><br>


        <?php echo insert_input_chk("生年月日: ","insert_year","insert_month","insert_day");?>
        <br>
        <select name="insert_year">
            <option value="">----</option>
            <?php
            for($i=1950; $i<=2010; $i++){ ?>
            <option value="<?php echo $i;?>" <?php if($i==form_value('insert_year')){echo "selected";}?>><?php echo $i ;?></option>
            <?php } ?>
        </select>
        <?php echo insert_input_chk("年:","insert_year");?>
        <select name="insert_month">
            <option value="">--</option>
            <?php
            for($i = 1; $i<=12; $i++){?>
            <option value="<?php echo $i;?>" <?php if($i==form_value('insert_month')){echo "selected";}?>><?php echo $i;?></option>
            <?php } ;?>
        </select>
        <?php echo insert_input_chk("月:","insert_month");?>
        <select name="insert_day">
            <option value="">--</option>
            <?php
            for($i = 1; $i<=31; $i++){ ?>
            <option value="<?php echo $i; ?>"<?php if($i==form_value('insert_day')){echo "selected";}?>><?php echo $i;?></option>
            <?php } ?>
        </select>
        <?php echo insert_input_chk("日:","insert_day");?>
        <br><br>

        <?php echo insert_input_chk("種別:","insert_type");?>
        <br>
        <?php
        for($i = 1; $i<=3; $i++){ ?>
        <input type="radio" name="insert_type" value="<?php echo $i; ?>"<?php if($i==form_value('insert_type')){echo "checked";}?>><?php echo ex_typenum($i);?><br>
        <?php } ?>
        <br>

        <!-- ----add---- -->
        <!-- 電話番号が日本どやアルファベットなど、一般的な電話番号の形式でなくとも許可されてしまうのをブロックするように変更いたしました。 -->

        <?php echo insert_input_chk("電話番号:<br>*半角数字とハイフン(-)で記入してください。例) 080-1122-3344<br>","insert_tell","insert_tell_flg");?>
        <input type="text" name="insert_tell" value="<?php echo form_value('insert_tell'); ?>">
        <br><br>

        <?php echo insert_input_chk("自己紹介文:","insert_comment");?>
        <br>
        <textarea name="insert_comment" rows=10 cols=50 style="resize:none" wrap="hard"><?php echo form_value('insert_comment'); ?></textarea><br><br>

        <input type="hidden" name="mode"  value="insert_CONFIRM">
        <input type="submit" name="btnSubmit" value="確認画面へ">
    </form>

    <?php echo return_top(); ?>
</body>
</html>
