<!doctype html>

<!-- sectionで課題を分けています -->

<html lang="ja">
<head>
   <meta charset="utf-8">
   <title>geek jpb camp php practice_02</title>
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
      header p {
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
         opacity: 0;
         display: block;
         height: 8px;
      }

   </style>
</head>
<body>
   <header>
      <p>phpプログラミング基礎学習_02</p>
      <p>20160906 - 20160907</p>
   </header>
   <h4>*- memo -*</h4>
   <section><!--------------------------------------------->
      <h4>条件分岐 switch</h4>

         <pre>
             $num = 2;
             $sum = 0;
             switch($num) {
                 case 1:
                     $sum = $sum + 1;
                 case 2:
                     $sum = $sum + 2;
                 case 3:
                     $sum = $sum + 3;
                 case 10:
                     $sum = $sum + 10;
             }
             echo "num=$num, sum=$sum";
         </pre>

      <h4>ループ処理 foreach</h4>

         <pre>
             $arr = array(
                       1 => 'soeda.',
                       2 => 'hayashi.',
                       3 => 'geekjob.',
                  );

             // 要素のみをループ処理する場合
             foreach($arr as $value) {
                 echo $value;
             }
             echo "string";

             // キーワードと要素の両方を利用する場合
            //  foreach($arr as $key => $value) {
            //      echo 'key:' . $key . ' value:' . $value;
            //  }
         </pre>

      <h4>文字列の先頭から nこ削除</h4>
         <pre>
            PHPで文字列の前後から指定した数の文字を削除する方法のメモ。
            2バイト文字が混じっていない場合はsubstr()とstrlen()を使う。
            全角を含む場合はmb_substr()とmb_strlen()を使う。

            substr( $string , $start , $length )は第1引数に与えた文字列から、
            第2引数で指定した位置から第3引数で指定した長さの文字列を返す。

            strlen( $string )は与えられた文字列の長さを返す。
            なので、substr()にstrlen()を与え、カットしたい文字数を文字長から引く。
               substr($string, n, strlen($string)-n)

            substr()とstrlen()は2バイト文字に対応していないので、
            全角が混じっている場合はmb_substr()とmb_strlen()を使う。

               $string = "hello";
               $cut = 3;
               $string = substr($string, $cut, strlen($string)-$cut);
               echo $string;
                  -->lo
         </pre>
         <p>
            <?php
            $string = "hello";
            $cut = 3;
            $string = substr($string, $cut, strlen($string)-$cut);
            echo $string;
            ?>
         </p>

   </section><!--------------------------------------------->
   <h4>以下課題</h4>
   <section><!--------------------------------------------->
      <h4>#01</h4>
      <p class="test">

         <?php

         $key=3;
         switch ($key) {
            case "1":
               echo "one";
               break;
            case "2":
               echo "two";
               break;
            default:
               echo "これは想定外<button>^o^</button>";
         }
         ?>

      </p>
   </section><!--------------------------------------------->
   <section><!--------------------------------------------->
      <h4>#02</h4>
      <p class="test">

         <?php

         $key="A";
         switch ($key) {
            case "A":
               echo "英語です";
               break;
            case "あ":
               echo "日本語です";
               break;
         }

         ?>

      </p>
   </section><!--------------------------------------------->
   <section><!--------------------------------------------->
      <h4>#03 8^20=?</h4>
      <p class="test">

         <?php

         $number = 8;
         $log = $number;
         $count = null;
         echo "わざと経過を見せると...<br>(1) 8=8<br>";
         for ($i=0;$i<19;$i++) {
            $log .= "*8";
            $number = $number * 8;
            $count = $i + 2;
            echo "($count) $log = $number <br>";
         }

         ?>

      </p>
   </section><!--------------------------------------------->
   <section><!--------------------------------------------->
      <h4>#04 Aを30こ連結</h4>
      <p class="test">

         <?php
         $word = "A";
         $output = null;
         for ($i=0;$i<30;$i++) {
            $output .= $word;
         }
         echo "$output";
         ?>

      </p>
   </section><!--------------------------------------------->
   <section><!--------------------------------------------->
      <h4>#05 (0-100)までを全部足す</h4>
      <h5>for文を利用して、0から100を全部足す処理を実現してください。</h5>
      <p class="test">

         <?php
         $i = null;
         $log = 0;
         $answer = null;
         for ($i=1;$i<101;$i++) {
            $log .= "+$i";
            $answer = $answer + $i;
         }
         // echo "$log = $answer";
         echo "0+1+2+...+99+100 = $answer";
         ?>

      </p>
   </section><!--------------------------------------------->
   <section><!--------------------------------------------->
      <h4>#06 </h4>
      <h5>while文を利用して、以下の処理を実現してください。
         <br>1000を2で割り続け、100より小さくなったらループを抜ける処理</h5>
      <p class="test">

         <?php

         $number = 1000;
         while ($number >= 100) {
            $number = $number/2;
            echo "$number <br>";
         }
         echo "number=$number : 100を下回ったのでroopを抜けたよ^^";

         ?>


      </p>
   </section><!--------------------------------------------->
   <section><!--------------------------------------------->
      <h4>#07</h4>
      <h5>以下の順番で、要素が格納された配列を作成してください。
         <br>10, 100, 'soeda', 'hayashi', -20, 118, 'END'</h5>
      <p class="test">

         <?php

         $x = array(10, 100, 'soeda', 'hayashi', -20, 118, 'END');
         print_r($x);

         ?>

      </p>
   </section><!--------------------------------------------->
   <section><!--------------------------------------------->
      <h4>#08</h4>
      <h5>７で作成した配列の'soeda'を33に変更してください。</h5>
      <p class="test">

         <?php

         echo "soeda は 要素番号[2]の位置なので...<br>";
         $x[2] = 33;
         print_r($x);

         ?>

      </p>
   </section><!--------------------------------------------->
   <section><!--------------------------------------------->
      <h4>#09</h4>
      <h5>以下の順で、連想配列を作成してください。
         <br>1に'AAA', 'hello'に'world', 'soeda'に33, 20に20</h5>
      <p class="test">

         <?php

         $array = array("1"=>"AAA","hello"=>"world","soeda"=>"33",20=>20);
         print_r($array);

         ?>

      </p>
   </section><!--------------------------------------------->
   <section>
      <span></span>
      <h4>#10 応用編</h4>
      <h5>クエリストリングから渡された数値を1ケタの素数で可能な限り分解し、
         <br>元の値と素因数分解の結果を表示するようにしてください。
         <br>2ケタ以上の素数が含まれた数値の場合は、
         <br>「元の値　1ケタの素因数　その他」と表記して、その他　に含んでください。</h5>
      <p><i>urlの最後に ?num=** を追加してみてね！ ?num=0 も試してみ！</i></p>
      <p class="test">

         <?php

         $num = (int)$_GET["num"]; //受け取った値
         echo "一桁の素数は 2 3 5 7 <br>受け取った数値は <q> $num </q> <br>";
         if ($num != 0) {
            $sosu = array(2,3,5,7);
            $i = 0; //@sosu の要素番号
            $ans = $num; //割ってった値
            $count = array(0,0,0,0);
            $siki = null;
            $j = 0;

            for ($i=0; $i<4; $i++) {
               while ($ans % $sosu[$i] == 0) {
                  $ans = $ans / $sosu[$i];
                  $count[$i]++;
               }
            }

            // 日本語----
            echo "<br>$num の中には ";
            $i = 0;
            for ($i=0; $i<4; $i++) {
               if ($count[$i] > 0) {
                  echo "$sosu[$i]"."が"."$count[$i]"."こ ";
               }
            }
            if ($ans != 1) {
               echo "+その他が $ans";
            }
            //----

            //式----
            echo "<br>式だと<br>$num = ";
            $i = 0;
            for ($i=0; $i<4; $i++) {
               if ($count[$i] > 0) {
                  $j = 0;
                  while ($count[$i] > $j) {
                     $siki .= " x $sosu[$i]";
                     $j++;
                  }
               }
            }
            if ($ans != 1) {
               $siki .= " x $ans";
            }
            $siki = substr($siki , 2, strlen($siki)-2);
            echo "$siki<br>";
            //----

         }

         elseif ($num = null) {
            echo "今は何も値が入っていません<br>";
         } // ?num= が未入力だと強制的に =０ になるっぽいけどこの記述不必要かな？

         else {
            echo "<br>入力されていないか,入力値が 0 です
                  <br>0 で分岐させておかないと無限ループなのです<button>ひゃん</button>";
         }

         //大変でした

         ?>

      </p>
      <span></span>
   </section>

   <footer></footer>
</body>
</html>
