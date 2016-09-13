<!-- SHOW page -->
<?php require "06.php"; ?>
<?php require "04.php"; ?>

<?php
session_start();

if(isset($_POST["reload"])){
   if($_POST["reload"] == "clear"){
      for($i=1; $i <= $_SESSION["count"]; $i++){
         unset($_SESSION["output_name_$i"]);
         unset($_SESSION["output_comment_$i"]);
      }
   }
}

session_chk();

?>
<!doctype html>
<html lang="ja">
<head>
   <meta charset="utf-8">
   <title><?php echo SHOW ?></title>
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
      button{
         margin: 0;
         padding: 5px;
         height: 30px;
         border-radius: 10px;
         background: white;
      }

      /**/

      /*.comment{
         background: white;
         display: inline-block;
      }
      .comment:first-child{
         width: 100px;
      }
      .comment + .comment{
         width: 428px;
      }*/
      .canvas{
         display: inline-block;
         height: 505px;
      }
      .name{
         position: relative;
         left: 15px;
         width: 94px;
      }
      .comment{
         width: 428px;
      }
      .text_output{
         background: white;
         height: 15px;
         padding: 2px;
         margin: 2px;
         line-height: 18px;
         overflow: hidden;
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
         <h4>SHOW page</h4>
      </header>
      <section>
         <div class="canvas name">

         <?php
         // $_SESSION["output_$i"]

         if(isset($_SESSION["GET_name_is_name"])){
            if(isset($_SESSION["count"])){
               $_SESSION["count"]++;
            }else{
               $_SESSION["count"] = 1;
            }
            $max_line = $_SESSION["count"];
         }

         //出力ように置き換えてアンセット
         if(isset($_SESSION["GET_name_is_name"])){
            $_SESSION["output_name_$max_line"] = $_SESSION["GET_name_is_name"] . "<br>";
            unset($_SESSION["GET_name_is_name"]);
         }
         if(isset($_SESSION["GET_name_is_comment"])){
            $_SESSION["output_comment_$max_line"] = $_SESSION["GET_name_is_comment"] . "<br>";
            unset($_SESSION["GET_name_is_comment"]);
         }

         if($_SESSION["count"] > 20){
            $start_line = $_SESSION["count"] - 20;
         }else {
            $start_line = 1;
         }

         // 正順
         // for($i=$start_line ;$i <= $_SESSION["count"]; $i++){
         //    echo $_SESSION["output_$i"];
         // }
         // 逆順
         for($i=$_SESSION["count"] ;$i >= $start_line; $i--){
            if(isset($_SESSION["output_name_$i"])){
               echo '<p class="text_output">' . $_SESSION["output_name_$i"] . '</p>';
            }
         }

         ?>
      </div>
      <div class="canvas comment">

         <?php

         for($i=$_SESSION["count"] ;$i >= $start_line; $i--){
            if(isset($_SESSION["output_comment_$i"])){
               echo '<p class="text_output">' . $_SESSION["output_comment_$i"] . '</p>';
            }
         }



         ?>

      </div>

      </section>
      <form action="<?php echo INPUT ?>" method="POST">
         <p>
            <input type="hidden" name="access" value="from_show_page">
            <input type="submit" name="btn" value="戻る">
         </p>
      </form>
      <form action="<?php echo SHOW ?>" method="POST">
         <p>
            <input type="hidden" name="reload" value="clear">
            <input type="submit" name="btn" value="ページクリア">
         </p>
      </form>

   </article>
   <footer></footer>
</body>
</html>
