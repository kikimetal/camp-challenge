<?php

session_start();

//読み込んだ時 $_POST[$key] に値が入っていたら、SESSION へ格納
function to_session($key){ //$key <= フォームのinput name
   global $_POST;
   global $_SESSION;
   if(isset($_POST["$key"])){
      $_SESSION["$key"] = $_POST["$key"];
   }
}

//読み込んだ時 $_SESSION[$key] に値が入っていたら 変数 $user_info へ格納
function use_session($key){
   global $_SESSION;
   global $user_info;
   if(isset($_SESSION["$key"])){
      $user_info["$key"] = $_SESSION["$key"];
   }
}

to_session("name");
to_session("sex");
to_session("hobby");

use_session("name");
use_session("sex");
use_session("hobby");

//use_session で $user_info に値が格納されたなら(２回目以降の訪問なら)、
//その値(=前回postで送った内容)を返す関数
function output_user_info($key){
   global $input_flg;
   global $user_info;
   // $input_flg = false;
   if(isset($user_info["$key"])){
      return $user_info["$key"];
      // $input_flg = true;
   }
   else{
      return null;
   }
}

?>

<!doctype html>

<!-- 05 phpデータ操作 課題 07 番です -->

<html lang="ja">
<head>
   <meta charset="utf8">
   <title>05_07_08_assignment_page</title>
   <style>
      *{
         color: dimgrey;
         margin: 0;
         padding: 0;
      }
      body{
         background: hsla(199, 70%, 90%, 1);
         margin: 20px;
      }
      .frame{
         position: fixed;
         z-index: -1;
         top: -12px;
         left: 0;
         right: 0;
         bottom: 0;
         /*height: 100%;*/
         /*width: 100%;*/
         box-shadow: 0 0 35px 10px hsla(199, 70%, 80%, 1) inset;
      }
      header{
         border-radius: 10px;
         margin: 20px auto;
         padding: 5px;
         background: hsla(199, 70%, 80%, 1);
         max-width: 300px;
         border: 1px dashed white;
         box-shadow: 0 0 0 5px hsla(199, 70%, 80%, 1);
      }
      article{
         margin: 30px;
         border: 1px dotted hsla(199, 70%, 80%, 1);
         max-width: 610px;
         margin: 5px auto;
         text-align: center;
      }
      section{
         margin: 5px;
         /*max-width: 600px;*/
         border-radius: 5px;
         background: hsla(199, 70%, 95%, 1);
         text-align: left;
      }
      section > p, section > div, section > h4, section > h5{
         padding-left: 10px;
      }
      pre{
         padding-top: 10px;
      }
      .test{
         position: relative;
         top: -5px;
         margin: 5px;
         border: 2px solid hsla(199, 70%, 88%, 1);
      }
      .pointer{
         cursor: pointer;
      }
      form{
         margin: 20px;
      }
      input[type="text"]{
         height: 20px;
         line-height: 20px;
         font-size: 16px;
      }
      textarea{
         padding: 0;
         height: 40px;
         line-height: 20px;
         font-size: 16px;
      }
   </style>
</head>
<body>

   <aside>
      <div class="frame"></div>
   </aside>
   <article>
      <header>
         <p>phpデータ操作 #07 - #08</hp>
      </header>
      <section>
         <h4>#07 #08</h4>
         <pre>
            下の機能を実装してください。

            名前・性別・趣味を入力するページを作成してください。
            また、入力された名前・性別・趣味を記憶し、次にアクセスした際に
            記録されたデータを初期値として表示してください。

            ※PHPと同時に、HTMLの知識が必要になります。
            ※入力フィールドの使い方を調べてみましょう。
         </pre>
      </section>
      <section>

         <h4>入力フォーム</h4>
         <div class="test">
            <form action="" method="post">
               <p>
                  名前 : <input type="text" name="name" placeholder="お名前">
               </p>
               <p>
                  性別 :
                  <input id="male" class="pointer" type="radio" name="sex" value="male"><label class="pointer" for="male">male</label>
                  <input id="female" class="pointer" type="radio" name="sex" value="female"><label class="pointer" for="female">female</label>
               </p>
               <p>
                  趣味 :<br>
                  <textarea name="hobby" placeholder="趣味を書いてね" rows="2" cols="40"></textarea>
               </p>
               <p>
                  <input type="submit" name="submit_btn" value="go^o^">
               </p>
            </form>
         </div>

         <h4>前回の入力を維持したフォーム</h4>
         <div class="test">
            <form action="" method="post">
               <p>
                  名前 : <input type="text" name="name" placeholder="お名前" value="<?php echo output_user_info("name"); ?>">
               </p>
               <p>
                  性別 :
                  <input id="male" class="pointer" type="radio" name="sex" value="male" <?php if (output_user_info("sex") == "male"){echo "checked";} ?>><label class="pointer" for="male">male</label>
                  <input id="female" class="pointer" type="radio" name="sex" value="female" <?php if (output_user_info("sex") == "female"){echo "checked";} ?>><label class="pointer" for="female">female</label>
               </p>
               <p>
                  趣味 :<br>
                  <textarea name="hobby" placeholder="趣味を書いてね" rows="2" cols="40"><?php echo output_user_info("hobby"); ?></textarea>
               </p>
               <p>
                  <input type="submit" name="submit_btn" value="go^o^" disabled>
               </p>
            </form>
         </div>

         <p>

         </p>
      </section>
   </article>
</body>
</html>

<?php
// session_unset();
?>
