<!-- INPUT page -->
<?php require "06.php"; ?>
<?php require "04.php"; ?>
<?php
session_start();
if(!empty($_POST["access"])){
   if($_POST["access"] == "from_show_page"){
      $_SESSION["show_page_count"] = 0;
   }
}

//ここはそのままでで良さそうなのでdemoからコピペ
session_chk();

if(!isset($_COOKIE['login_count']) && !isset($_COOKIE['last_login'])){
    $lcount = 1;
    $llogin = mktime();
    setcookie('login_count',$lcount);
    setcookie('last_login',$llogin);
    setcookie('SAVEDPHPSESSID',$_COOKIE['PHPSESSID']);
}else if($_COOKIE['PHPSESSID']!=$_COOKIE['SAVEDPHPSESSID']){
    setcookie('login_count',$_COOKIE['login_count']+1);
    $lcount = $_COOKIE['login_count'];
    $llogin = $_COOKIE['last_login'];
    setcookie('last_login',mktime());
    setcookie('SAVEDPHPSESSID',$_COOKIE['PHPSESSID']);
}else{
    $lcount = $_COOKIE['login_count'];
    $llogin = $_COOKIE['last_login'];
}


// if(!isset($_SESSION["show_page_count"])){
//    echo "<p>urlから直接このページは開けません、不正なアクセスです</p>";
//    echo "<p><a href="01.php">ログインページ</a></p>";
//    exit;
// }else {
//    $_SESSION["show_page_count"]++;
// }



// if($_SESSION["show_page_count"] >= 0){
//    $_SESSION["show_page_count"]++;
// }else {
//    $_SESSION["show_page_count"] = 1;
// }

?>

<!doctype html>
<html lang="ja">
<head>
   <meta charset="utf-8">
   <title><?php echo INPUT ?></title>
   <style>
      body,article,nav,section,aside,header,footer,
      p,div,h1,h2,h3,h4,h5,h6,
      form{
         /*border: 1px dotted grey;*/
         color: dimgrey;
         border-radius: 5px;
         margin: 5px;
         padding: 5px;
      }
      body{
         background: pink;
         text-align: center;
      }
      section{
         background: mistyrose;
         width: 600px;
         margin: 5px auto;
         text-align: left;
      }
      footer{
         height: 100px;
      }
      button{
         margin: 0;
         padding: 5px;
         height: 30px;
         border-radius: 10px;
         background: white;
      }
      button,input,textarea,section{
         border: 2px solid hsl(349, 70%, 80%);
      }
   </style>
</head>
<body>
   <article>
      <header>
         <h4>INPUT page</h4>
      </header>
      <section>

         <?php
         if(!isset($_SESSION["show_page_count"])){
            echo "<p>urlから直接このページは開けません、不正なアクセスです</p>";
            echo "<p>こちらからどうぞ <a href='01.php'>ログインページ</a></p>";
            exit;
         }else {
            $_SESSION["show_page_count"]++;
         }
         ?>

         <form action="<?php echo INPUT ?>" method="GET">
            <p>今回で<?php echo $lcount ?>回目のアクセスです！<br>最終ログイン日時 <?php echo date('Y年m月d日 H時i分s秒',$llogin)?> </p>
            <hr>
            <p>名前:<br>全角は５文字まで、半角で８文字まで出力できません><</p>
            <p><input type="text" name="name" maxlength="8"></p>

            <p>コメント:</p>
            <p><textarea name="comment" cols="40" rows="2"></textarea></p>

            <p><button type="submit" name="btn" value="書き込む！">書き込む！</button></p>
         </form>

         <p>
            <?php
            if($_SESSION["show_page_count"] > 1){
               if(!chk_get_data("name")){
                  echo "名前が未入力です" . "<br>";
               }
               if(!chk_get_data("comment")){
                  echo "コメントが未入力です" . "<br>";
               }
               if(chk_get_data("name") && chk_get_data("comment")){
                  unset($_SESSION["show_page_count"]);
                  $_SESSION["GET_name_is_name"] = $get_data["name"];
                  $_SESSION["GET_name_is_comment"] = $get_data["comment"];
                  echo '<meta http-equiv="refresh" content="0;URL='.SHOW.'">';
               }
            }
            ?>
         </p>
      </section>
   </article>
   <footer></footer>
</body>
</html>
