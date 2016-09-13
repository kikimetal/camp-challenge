<?php

   if (isset($_COOKIE["last_date"])) {
      $last_date = $_COOKIE["last_date"]; //クッキーがあれば最後の読み込み時の日付を受け取る
   }
   $access_time = date('Y年m月d日 H:i:s'); //現在時刻を格納
   setcookie("last_date", $access_time, time()+5); //時刻をクッキーへ保存

   session_start(); //session もheader関数なのかしら？同じエラーが出たからここにやってきました
   if (isset($_SESSION["last_date"])) {
      $last_date_session = $_SESSION["last_date"];
   }
   $_SESSION["test"] = "hello session!";
   $_SESSION["last_date"] = date('Y年m月d日 H:i:s');

?>

<!doctype html>

<!-- sectionで課題を分けています -->

<html lang="ja">
<head>
   <meta charset="utf-8">
   <title>data_manipulation</title>
   <link rel="stylesheet" href="">
   <style>
      *{
         margin: 5px;
         padding: 0px;
         border: 1px dotted hsl(360, 90%, 90%);
      }
      body{
         background: hsl(360, 90%, 94%);
         color: dimgrey;
         text-align: center;
      }
      u,i,b,span{
         border: none;
      }
      header{
         border-radius: 10px;
         margin: 10px auto;
         background: pink;
         max-width: 400px;
         border: 1px dashed white;
         box-shadow: 0 0 0 5px pink;
      }
      header p{
         border: none;
      }
      section{
         max-width: 600px;
         border-radius: 5px;
         margin: 5px auto;;
         background: lavenderblush;
         text-align: left;
      }
      p,h3,h4,h5{
         padding-left: 3px;
      }
      h4{
         margin-bottom: 0;
      }
      h5{
         margin-top: -1px;
      }
      .test{
         margin-top: 8px;
         /*box-shadow: 0 0 0px 2px pink;*/
         border: 3px solid hsl(360, 90%, 93%);
      }
      footer{
         margin-bottom: 100px;
         border: none;
      }

      button{
         background: white;
         border: 1px solid grey;
         border-radius: 10px;
         margin: 2px;
         padding: 2px;
      }
      button:hover{
         cursor: pointer;
      }
      button:hover:after{
         content: "<ウヒョー";
         margin: 0;
         padding: 0;
         line-height: 90%;
         vertical-align: 1px;
      }

      span{
         background: pink;
         border: none;
      }
      pre{
         padding-top: 8px;
         overflow: scroll;
         /*border: none;*/
      }
      footer a{
         color: white;
         text-align: center;
         border: none;
      }
      footer div{
         position: fixed;
         bottom: 0;
         right: -100px;
         width: 60px;
         height: 60px;
         background: pink;
         border-radius: 50%;
         border: 1px dashed white;
         box-shadow: 0 0 0 5px pink;
         text-align: center;
         line-height: 60px;

         animation-name: korokoro;
         animation-duration: 18s;
         animation-timing-function: ease-in-out;
         animation-delay: 0.3s;
         animation-direction: alternate;
         animation-iteration-count: infinite;
      }
      @keyframes korokoro {
         0%{
            right -70px;
         }
         20%{
            right: -70px;
            opacity: 0;
            transform: rotate(0deg);
         }
         40%{
            opacity: .8;
         }
         60%{
            opacity: .8;
         }
         80%{
            right: 100%;
            opacity: 0;
            transform: rotate(-1000deg);
         }
         100%{
            right: 100%;
         }
      }
      .memo p{
         padding: 10px;
         padding-left: 30px;
         font-size: 14px;
         line-height: 120%;
      }
      input[type="submit"]{
         /*border: 1px solid black;*/
         background: white;
         border-radius: 10px;
      }
      input[type="radio"],
      .pointer{
         cursor: pointer;
      }
      a{
         /*color: hsl(350, 80%, 65%);*/
         color: hotpink;
      }
      .test_08{
         text-align: center;
      }
      .test_08 td{
         width: 140px;
      }
   </style>
</head>
<body>
   <header>
      <p>phpデータ操作</p>
      <p>20160909 - 20160911</p>
   </header>
   <h4><a href="#kadai">課題へ</a><h4>
   <h4>*- memo -*</h4>
   <section class="memo">
      <h4>$_POST["test"] ...これは連想配列？</h4>
      <p>
         $_GET[""] $_POST[""]ってのは、この[""]の記述的に、連想配列で格納されていってること？
         試してみる<br>
         print_r($_POST); --v<br>
      </p>
      <form class="look_post_data test" action="" method="post">
         <div>
            <label class="pointer"><input type="radio" name="user_sex" value="male">male</label>
            <label class="pointer"><input type="radio" name="user_sex" value="female" checked>female</label>
         </div>
         <div>
            <input type="hidden" name="check" value="no check">
            <labe><input type="checkbox" name="check" value="checked">checked?</label>
         </div>
         <input type="text" name="user_name" placeholder="ここで試せ^^" size="">
         <input type="submit" name="submit_btn" value="そうしん^o^">
      </form>
      <p>

         <?php

            print_r($_POST);

         ?>

      </p>
      <p>

         <?php

         if(isset($_POST["check"])){
            echo '$_POST["check"] = ' . $_POST["check"];
         }

         ?>

      </p>
      <p>まさか配列だったとは...</p>
      <h4>cookie</h4>
      <pre>
         // ユーザーの１回目の訪問
         $access_time = date('Y年m月d日');
         setcookie('LastLoginDate', $access_time);

         // 次の訪問で。。。
         $lastDate = $_COOKIE['LastLoginDate'];

         echo 'お帰りなさい！○○さん！< br >';
         echo '前回ログイン日は、' . $lastDate . 'です！';
      </pre>
      <pre class="test">
         <span>注意</span>setcookie は header関数っていうくくりらしい
         だから上記の記述を HTML のど真ん中にっぽんっておいちゃうとエラーになる

         <u><i>制御ロジックとアウトプットロジックを分離するようにする</i></u>

            - スクリプトの先頭に制御ロジックを記述する
            - 一時的な文字列変数などを用いて後でアウトプットできるようにする
            - 実際のアウトプットロジックと HTML の出力は最後に行う
      </pre>
      <p class="test">
         <?php

            //このファイルのいーーーちばん番上と連携してるよ。確認してね。
            if (isset($last_date)){

               echo 'お帰りなさい！○○さん！60sec以内にリロードするとこれが表示されます！<br>';
               echo '<br>前回ログイン日は、' . $last_date . ' です！';
            }
            else {
               echo "初めての訪問ですね！";
            }

         ?>

      </p>
      <h4>session</h4>
      <pre>
         // セッション開始
         session_start();

         // セッションに情報を入れる。
         $_SESSION['message'] = 'こんにちは。';

         // セッションからデータを取り出す
         echo $_SESSION['message'];
      </pre>
      <p>

         <?php

            echo $_SESSION['test'];

         ?>

      </p>
      <pre>
         <span>これも header関数 だから記述位置に注意</span>
      </pre>
      <h4>ファイルアップロード</h4>
      <pre>
         &lt;form <span>enctype="multipart/form-data"</span> action="sample.php" <span>method="post"</span>&gt;
            file 選択 :
            &lt;input name="user_file" <span>type="file"</span>&gt;
         &lt;/form&gt;
      </pre>
      <pre>
         サーバーの送られてきたファイルは一時フォルダに一時的保存される
         アップロードされたファイルの情報は $_FILES に保存されている

         アップロードされたファイルをサーバー側に保存するには
         move_uploaded_file ( 一時フォルダのファイル, 保存ファイル名 ); を使う
      </pre>
      <p>
         move_uploaded_file( $_FILES['userfile']['tmp_name'], $file_name);<br>
         なにこれは一体どこへ保存されるの...？
      </p>
      <pre>
         解決！
         <span>初期設定だと.phpファイルと同じ位置にそのまま保存されるみたい！</span>
      </pre>
   </section>

   <h4 id="kadai">以下課題</h4>
   <section>
      <h4>#01</h4>
      <h5>以下の入力フィールドを持ったHTMLを、PHPで処理する想定で記述してください。<br>
      ・名前（テキストボックス）、性別（ラジオボタン）、趣味（複数行テキストボックス）</h5>
      <div class="test">

         <form action="" method="post" enctype="multipart/form-data">
            <p>
               お名前 : <input type="text" name="name" placeholder="お名前">
            </p>
            <p>
               性別 :
               <input id="male" type="radio" name="sex" value="male"><label class="pointer" for="male">male</label>
               <input id="female" type="radio" name="sex" value="female" checked><label class="pointer" for="female">female</label>
            </p>
            <p>
               ご趣味をどうぞ :<br>
               <textarea name="hobby" placeholder="趣味を書いてね" rows="3" cols="40"></textarea>
            </p>
            <p>
               <input type="submit" name="submit_btn" value="go^o^">
            </p>
         </form>

      </div>
   </section>
   <section>
      <h4>#02</h4>
      <h5>以下の機能を実装してください。<br>
         １で作成したHTMLの入力データを取得し、画面に表示する</h5>
      <p class="test">

         <?php

         // 未入力時の対応が割とめんどくさい感じなので関数にしておく
         function output_form($out_name, $post_name){
            $none = (string) "";
            echo "$out_name : ";
            if (isset($_POST["$post_name"])) {
               if ($_POST["$post_name"] != $none) {
                  $output = $_POST["$post_name"];
                  echo $output;
               }
               else {
                  echo "未入力";
               }
            }
            else {
               echo "未入力";
            }
            echo "<br>";
         }

         // 出力
         output_form("名前", "name");
         output_form("性別", "sex");
         output_form("趣味", "hobby");

         // 以下うまくいかなかったやつ

         // $none = (string) "";
         // echo "お名前 : ";
         // if (isset($_POST["name"])) {
         //    if ($_POST["name"] != $none) {
         //       $name = $_POST["name"];
         //       echo $name;
         //    }
         //    else {
         //       echo "未入力";
         //    }
         // }
         // else {
         //    echo "未入力";
         // }
         // echo "<br>";

         // echo "性別 : ";
         // if (isset($_POST["sex"])) {
         //    $sex = $_POST["sex"];
         //    echo $sex;
         // }
         // else {
         //    echo "未入力";
         // }
         // echo "<br>";
         // echo "趣味 : ";
         // if (isset($_POST["hobby"])) {
         //    $hobby = $_POST["hobby"];
         //    echo $hobby;
         // }
         // else {
         //    echo "未入力";
         // }
         // echo "<br>";
         // var_dump($name);
         // var_dump($flg);

         ?>

      </p>
   </section>
   <section>
      <h4>#03</h4>
      <h5>クッキーに現在時刻を記録し、
         次にアクセスした際に、前回記録した日時を表示してください。</h5>
      <p class="test">

         <?php

         // setcookie は header関数なので最上に記述
         echo "前回のアクセス : ";
         if (isset($last_date)){
            echo $last_date;
         }
         else {
            echo "(このクッキーは６０秒しか保存されません)";
         }
         echo "<br>今回のアクセス : " . date('Y年m月d日 H:i:s');

         ?>

      </p>
   </section>
   <section>
      <h4>#04</h4>
      <h5>３と同じ機能をセッションで作成してください。</h5>
      <p class="test">

         <?php

         echo "前回のアクセス(session) : ";
         if (isset($last_date_session)){
            echo $last_date_session;
         }
         echo "<br>今回のアクセス(session) : " . date('Y年m月d日 H:i:s');


         ?>

      </p>
   </section>
   <section>
      <h4>#05</h4>
      <h5>ファイルアップロード機能を作成してください。</h5>
      <p class="test">

         <form class="upload" action="" method="post" enctype="multipart/form-data">
            <input type="file" name="user_file">
            <input type="submit" value="ファイル送信">
         </form>

      </p>
   </section>
   <section>
      <h4>#06</h4>
      <h5>５で作成したプログラムに、
         ファイルの中身を読み込んで表示する機能を追加してください。</h5>
      <p class="test">

            <?php

            if (isset($_FILES["user_file"])) {
               print_r($_FILES["user_file"]);

               move_uploaded_file($_FILES["user_file"]["tmp_name"], "05_output_file/new_file");
               echo "<br><br>moved file to 05_output_file/new_file";
            }
            else {
               echo "ファイルはまだ読み込まれていません";
            }

            ?>

      </p>
   </section>
   <section>
      <h4>#07 応用編</h4>
      <pre>
         下の機能を実装してください。

         名前・性別・趣味を入力するページを作成してください。
         また、入力された名前・性別・趣味を記憶し、次にアクセスした際に
         記録されたデータを初期値として表示してください。

         ※PHPと同時に、HTMLの知識が必要になります。
         ※入力フィールドの使い方を調べてみましょう。
      </pre>
      <p class="test">

         <a target="_blank" href="05_data_manipulation_07_08.php">課題 #07 のページへ飛ぶ</a>

      </p>
   </section>
   <section>
      <h4>#08 応用編</h4>
      <pre>
         HTMLについて調べましょう。
         HTMLには入力フィールド意外にも様々なタグが存在します。
         Webページをデザインする上で欠かせない知識なので、
         タグを調べ、色々と使ってみましょう。
      </pre>
      <div class="test test_08">

         <table bgcolor="white">
            <tr>
               <th>なまえ</th><th>好きな色</th><th>好きなジョブ</th>
            </tr>
            <tr>
               <td>kiki</td><td bgcolor="honeydew">honeydew</td><td>MCH</td>
            </tr>
            <tr>
               <td>lala</td><td bgcolor="lavenderblush">lavenderblush</td><td>WHM</td>
            </tr>
         </table>

      </div>
   </section>

   <!-- <section>
      <h4>#00</h4>
      <h5></h5>
      <p class="test">

      </p>
   </section> -->
   <!-- <footer></footer> -->
   <footer><div><a href="#">❤︎</a></div></footer>
</body>
</html>
