<?php
    require_once '06.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
   <meta charset="utf-8">
   <title><?php echo REDIRECT ?></title>
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

   </style>
</head>
<body>
    <?php
    if(isset($_GET['mode']) && $_GET['mode']=='timeout'){
    ?>
        <h3>タイムアウト</h3>
        <p>セッション有効期限切れです。三秒後にログイン画面に移動します</p>
    <?php
    }else{
    ?>
        <h3>不正なアクセス</h3>
        <p>不正なアクセスです。三秒後にログイン画面に移動します。</p>
    <?php
    }
    ?>
    <meta http-equiv="refresh" content="3;URL=<?php echo LOGIN ?>">
</body>
</html>
