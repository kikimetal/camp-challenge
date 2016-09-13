<!-- LOGIN page -->
<?php require "06.php"; ?>

<!doctype html>
<html lang="ja">
<head>
   <meta charset="utf-8">
   <title><?php echo LOGIN ?></title>
   <style>
      *{
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
      button,input[type="submit"]{
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
         <h3>LOGIN page</h3>
      </header>
      <section>
         <h4>ログイン画面</h4>
         <p>
         <?php
         if(!empty($_POST["pass"])){
            if($_POST["pass"] == PASSWORD){
               $chk = true;

               session_set_cookie_params(120);
               session_start();
               $_SESSION['last_access'] = mktime();
               $_SESSION["show_page_count"] = 0;

               echo date("Y/m/d - H:i:s", $_SESSION["last_access"]) . "<br>";
               echo 'ログインに成功しました。三秒後にサービストップに移動します'."<br>";
               echo '<meta http-equiv="refresh" content="3;URL='.INPUT.'">';
            }
            else {
               echo "pass間違ってます再入力して";
               $chk = false;
            }
         }else{
            echo "ログインパスワードを入力してください pass : password";
            $chk = false;
         }
         ?>
         </p>

         <?php
         if($chk == false){
         ?>
         <form action="<?php echo LOGIN ?>" method="POST">
             <input type="text" name="pass">
             <input type="submit" name="btn" value="ログイン">
         </form>
         <?php
         }
         ?>
      </section>
   </article>
   <footer></footer>
</body>
</html>
