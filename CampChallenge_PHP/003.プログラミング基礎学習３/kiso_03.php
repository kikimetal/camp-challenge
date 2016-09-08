<!doctype html>

<!-- sectionで課題を分けています -->

<html lang="ja">
<head>
   <meta charset="utf-8">
   <title>geek jpb camp php practice_03</title>
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
         border-radius: 5px;
         margin: 5px 150px;
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
      }
      footer a{
         color: white;
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
         animation-duration: 10s;
         animation-timing-function: ease-in-out;
         animation-delay: 0.3s;
         animation-direction: alternate;
         animation-iteration-count: infinite;
      }
      @keyframes korokoro {
         0%{
            right -70px;
         }
         5%{
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
         95%{
            right: 100%;
            opacity: 0;
            transform: rotate(-1000deg);
         }
         100%{
            right: 100%;
         }
      }

   </style>
</head>
<body>
   <header>
      <p>phpプログラミング基礎学習_03</p>
      <p>20160908 - 20160908</p>
   </header>
   <h4>*- memo -*</h4>
   <section class="memo">
      <h4>関数</h4>
      <pre>
         <span>- ユーザー定義関数(サブルーチン)</span>
            複数行の処理をひとまとめにして再利用できるようにしする
               function 関数名(){
                  処理１...
                  処理２...
               }
            これでいつでも 関数名(); が使える！
            <?php
            function test(){
               $a = 2;
               $a = $a*$a;
               echo "test-->hello $a=" . $a;
            }
            test(); // 4
            ?>

      </pre>
      <h4>引数 戻り値/帰り値</h4>
      <pre>
         <span>引数(ひきすう) と 戻り値</span>
            関数ではこちらから値を渡して、それを処理してもらうことができる
            その時渡す値が引数

               例)
               function 関数名(引数1, 引数2, 引数3=デフォ値) {
                  処理;
                  $x = ...;
                  <span>return $x;</span>
               }
               $output = 関数名(数値, 数値);
               // $output に <span>$x</span> の値が入る

                  戻り値に不空の値を欲しい場合、関数内 $x を配列にしておく
                     $x = array($a, $b, $c)
                        -->戻り値は２つ持てないってことかな？

            <?php
            function test02 ($a=3 ,$b=5){
               $c = $a * $b;
               $c++;
               return $c;
               $c = 1;
            }
            $c = test02(5, 2);
            echo "test02--> 5x2+1= " . $c;
            ?>

      </pre>
      <h4>グローバル変数 ローカル変数</h4>
      <pre>
         <span>functionの中で使う$変数の扱いに注意</span>

<?php
            $global_number=5;
            function check_scope(){
               static $local_number = 1; //この =1 がマジキチ staticくそくそ
               //毎回代入してるのになんで増えてんだよ
               // $local_number = 1;
               global $global_number; // こっちの =** つけるとエラー吐くし
               echo "ローカル:$local_number"."<br>";
               echo "グローバル:$global_number"."<br>";
               $local_number+=1;
               $global_number+=1;
               return $local_number;
            }

            check_scope();
            check_scope();

            // echo $local_number."<br>";//エラー
            echo $global_number."<br>";
         ?>
      </pre>
      <p style="padding:8px;">
         <u>引数とグローバル/ローカル変数</u><br>
         <span>注意！</span>関数名(**)に入れる値は引数っていうんだからな
         <br>関数内で定義してる変数へは外部からの代入はできないからな！
      </p>
      <h4>外部.phpファイルを呼び出す</h4>
      <pre>
         <span>require と include</span>
            別のファイルに記述した処理を読み込める
      </pre>
      <h4>continue; / break;</h4>
      <pre>
         繰り返し処理を繰り返し処理を効率的に使うために用意されている命令

         - <span>continue;</span>
            残りの処理を飛ばして次のループに移行する
            (ループからは抜け出さない)

               foreach($array as $key => $value){
                  if($value == null){
                     continue;
                  }
                  echo "$key : $value";
               }
               // value == null の場合その後の処理をスキップして次のループへ
               // valueに値がある部分だけ$key $valueが表示される

         - <span>break;</span>
            処理を終了させる
               foreach($array as $key => $value){
                  if($value == "hello"){
                     echo "$key";
                     break;
                  }
               }
               // hello が出てきた時点で$keyを表示して終了
      </pre>

   </section>

   <h4>以下課題</h4>
   <section>
      <h4>#01</h4>
      <h5>自分のプロフィール(名前、生年月日、自己紹介)を3行に分けて表示するユーザー定義関数を作り、関数を10回呼び出して下さい</h5>
      <p class="test">

         <?php

         function profile(){
            echo "hello 私はききるんです"."<br>";
            echo "生まれは 西暦1993年の霊5月10日 月神メネフィナの月です"."<br>";
            echo "melodic death metal が大好物です"."<br>";
         }
         for ($i=0; $i<10; $i++) {
            profile();
         }

         ?>

      </p>
   </section>
   <section>
      <h4>#02</h4>
      <h5>引数として数値を受け取り、その値が奇数か偶数か判別＆表示する処理を関数として制作し、
         適当な数値に対して奇数・偶数の判別を行ってください</h5>
      <p class="test">

         <?php
         function guki($number = null){
            if($number % 2 == 0){
               echo "$number は偶数です";
            }
            else {
               echo "$number は奇数です";
            }
         }
         $x = 81;
         guki($x);

         ?>

      </p>
   </section>
   <section>
      <h4>#03</h4>
      <h5>引き数が3つの関数を定義する。1つ目は適当な数値を、2つ目はデフォルト値が5の数値を、
         最後はデフォルト値がfalse(bool値)の$typeを引き数として定義する。
         1つ目の引き数に2つ目の引き数を掛ける計算をする関数を作成し、
         $typeがfalseの時はその値を表示、trueのときはさらに2乗して表示する。</h5>
      <p class="test">

         <?php

         function kake ($num01, $num02=5, $type = false) {
            if ($type == false){
               $return = $num01 * $num02;
               echo $return;
            }
            elseif ($type == true) {
               $return = ($num01 * $num02)**2;
               echo $return;
            }
         }

         kake(3,2,true); // (3x2)の二乗で 36

         ?>

      </p>
   </section>
   <section>
      <h4>#04</h4>
      <h5>課題1で定義した関数に追記する形として、戻り値　true(bool値)　を返却するように修正し、
         関数の呼び出し側でtrueを受け取れたら「この処理は正しく実行できました」、
         そうでないなら「正しく実行できませんでした」と表示する</h5>
      <p class="test">

         <?php

         //課題01のfunction
         function profile_02(){
            echo "hello 私はききるんです"."<br>";
            echo "生まれは 西暦1993年の霊5月10日 月神メネフィナの月です"."<br>";
            echo "melodic death metal が大好物です"."<br>";
            $prof_return = true;
            return $prof_return;
         }
         $bool = profile_02();
         if ($bool == true) {
            echo "この処理は正しく実行できました<br>";
         }
         else {
            echo "正しく実行できませんでした<br>";
         }

         var_dump($bool); // ちゃんとbooleanになっているか

         ?>

      </p>
   </section>
   <section>
      <h4>#05</h4>
      <h5>戻り値としてある人物の
         id(数値),名前,生年月日、住所を返却し、受け取った後は全情報を表示する</h5>
      <p class="test">

         <?php

         function id_search ($name) {
            if ($name == "elisa"){
               $id_return = array("id"=>"02","name"=>"elisa kobayashi","birthday"=>"1994/04/22","country"=>"UK");
            }
            return $id_return;
         }
         $id = id_search ("elisa");
         foreach ($id as $key => $value) {
            echo "$key : $value <br>";
         }
         // print_r($id);

         ?>

      </p>
   </section>
   <section>
      <h4>#06</h4>
      <h5>名前による検索プログラムを実装する。
         3人分のプロフィール(項目は課題5参照)をあらかじめ定義しておく。
         引き数にそれらのプロフィールと文字列をとり、戻り値は1人分のプロフィール情報を返却する。
         引き数の文字が名前に含まれる(部分一致)
         プロフィール情報(複数名合致する場合は最初のプロフィールとする)を戻り値として返却する。
         それ以降などは課題5と同じ扱いに</h5>
      <p class="test">

         <?php

         function id_search_02 ($name){
            $list = array();
            $list[0] = array("id"=>"00","name"=>"kiki metal","birthday"=>"1993/10/09","country"=>"JPN");
            $list[1] = array("id"=>"01","name"=>"ukon vasara","birthday"=>"1987/07/10","country"=>"Eorzea");
            $list[2] = array("id"=>"02","name"=>"elisa kobayashi","birthday"=>"1994/04/22","country"=>"UK");
            foreach($list as $list_key => $list_value){
               if (strpos($list_value["name"], $name) !== false){
                  foreach ($list[$list_key] as $id_key => $id_value) {
                     echo "$id_key : $id_value <br>";
                  }
                  break;
               }
            }
         }

         $input = "lisa";
         id_search_02($input);
         // foreach ２重がヘヴィでした
         // このやり方で良いのか、もっといいやり方あったら教えてください

         ?>

      </p>
   </section>
   <section>
      <h4>#07</h4>
      <h5>引き数、戻り値はなしの関数を用意。
         初期値3のglobal値を2倍していく、ローカルな値はstaticとして
         その関数が何回実行されたのかを保持していくような関数である。
         この関数を20回呼び出す</h5>
      <p class="test">

         <?php

         echo "戻り値なしとあるが何回呼び出したのかわからなくなるので、回数を戻り値にしておく。<br>";

         $global = 3;
         function test07(){
            static $static = 0;
            global $global;
            $global = $global*2;
            $static++;

            return $static;
         }
         for ($i=0; $i<19; $i++) {  //19回
            test07();
         }
         $kaisuu = test07();        // +1回
         echo "$global : $kaisuu 回め";

         ?>

      </p>
   </section>
   <section>
      <h4>#08</h4>
      <h5>課題1、課題2のユーザー定義箇所を含んだutil.phpを作成し、requireで呼び出して表示する</h5>
      <p class="test">

         <?php

         require "kiso_03_util.php";
         // これあれじゃないっすか
         // 定義ファイルの方で関数名書き換えないと、
         // 同じ関数名使ってるからダメってエラー出ませんか？
         // 別ファイルの方の関数名変えたら実行できました

         ?>

      </p>
   </section>
   <section>
      <h4>#09</h4>
      <h5>3人分のプロフィールについてIDと住所以外を表示する処理を実行する。
         2重のforeachとcontinueを必ず用いること</h5>
      <p class="test">

         <?php

         // あれ？ここでも２重のforeach ...?

         function id_search_03($name){
            $list = array();
            $list[0] = array("id"=>"00","name"=>"kiki metal","birthday"=>"1993/10/09","country"=>"JPN");
            $list[1] = array("id"=>"01","name"=>"ukon vasara","birthday"=>"1987/07/10","country"=>"Eorzea");
            $list[2] = array("id"=>"02","name"=>"elisa kobayashi","birthday"=>"1994/04/22","country"=>"UK");
            foreach($list as $list_key => $list_value){
               if (strpos($list_value["name"], $name) !== false){
                  foreach ($list[$list_key] as $id_key => $id_value) {
                     if ($id_key == "id" or $id_key == "country") {
                        continue;
                     }
                     echo "$id_key : $id_value <br>";
                  }
                  break;
               }
            }
         }

         $input = "lisa";
         id_search_03($input);
         echo "<br>name と birthday が表示されているはず (id と country 以外)<br>";

         // continue 面白い

         ?>

      </p>
   </section>
   <section>
      <h4>#10</h4>
      <h5>課題9の処理のうち2人目まででforeachのループを抜けるようにする</h5>
      <p>...２重foreachを使うが,検索対象は２人目で終了ってことかしら？<br>
      つまり、２人目までは探索に引っかかるけど、
      <br>３人目のelisaのみが持つキーワードを引数であげてる時、探索失敗すればいいのかな</p>
      <p class="test">

         <?php

         function id_search_04($name){
            static $count = 0;
            $list = array();
            $list[0] = array("id"=>"00","name"=>"kiki metal","birthday"=>"1993/10/09","country"=>"JPN");
            $list[1] = array("id"=>"01","name"=>"ukon vasara","birthday"=>"1987/07/10","country"=>"Eorzea");
            $list[2] = array("id"=>"02","name"=>"elisa kobayashi","birthday"=>"1994/04/22","country"=>"UK");
            foreach($list as $list_key => $list_value){

               if ($count >= 2) {
                  echo "2人目まででは引っかかりませんでした。3人目の探索は行いません。<br>";
                  break;
               }

               if (strpos($list_value["name"], $name) !== false){
                  foreach ($list[$list_key] as $id_key => $id_value) {
                     if ($id_key == "id" or $id_key == "country") {
                        continue;
                     }
                     echo "$id_key : $id_value <br>";
                  }
                  break;
               }
               $count++;
            }
         }

         $input = "lisa";
         id_search_04($input);
         echo "<br>２人目まででひっかかれば...<br>name と birthday が表示されているはず (id と country 以外)<br>";

         ?>

      </p>
   </section>
   <footer><div><a href="#">Topへ</a></div></footer>
</body>
</html>
