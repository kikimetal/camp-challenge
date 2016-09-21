<!doctype html>

<!-- sectionで課題を分けています -->

<html lang="ja">
<head>
   <meta charset="utf-8">
   <title>geek jpb camp php practice_01</title>
   <link rel="stylesheet" href="">
   <style>
      *{
         margin: 5px;
         padding: 0px;
         border: 1px dotted hsl(360, 90%, 90%);
         outline: none;
         color: dimgrey;
      }
      body{
         background: mistyrose;
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
      .test{
         box-shadow: 0 0 0px 2px mistyrose;
      }
      footer{
         margin-bottom: 100px;
      }
   </style>
</head>
<body>
   <header>
      <p>phpプログラミング基礎学習_01</p>
      <p>20160905 - 20160906</p>
   </header>
   <h4>以下課題</h4>
   <section><!--------------------------------------------->
      <h4>#01</h4>
      <p class="test">

         <?php
         echo "hello world.";
         ?>

      </p>
   </section><!--------------------------------------------->
   <section><!--------------------------------------------->
      <h4>#02</h4>
      <p class="test">

         <?php
         echo "groove" . "-" . "gear";
         ?>

      </p>
   </section><!--------------------------------------------->
   <section><!--------------------------------------------->
      <h4>#03</h4>
      <p class="test">

         <?php
         echo "こんにちは、高橋真一です。<br>好きな音楽はメタルです。";
          ?>

      </p>
   </section><!--------------------------------------------->
   <section><!--------------------------------------------->
      <h4>#04 ,#05</h4>
      <p>
          定数と変数を宣言し、それぞれに数値を入れて四則演算を行ってください。
      </p>
      <p class="test">

         <?php
         const XX = 10;
         $y = 20;
         echo "x = XX , y = $y <br>";
         $tasu = XX + $y;
         echo "x + y = $tasu <br>";
         $hiku = XX - $y;
         echo "x - y = $hiku <br>";
         $kakeru = XX * $y;
         echo "x * y = $kakeru <br>";
         $waru = XX / $y;
         echo "XX / $y = $waru <br>";
         ?>

      </p>
   </section><!--------------------------------------------->
   <section><!--------------------------------------------->
      <h4>#06</h4>
      <p class="test">

         <?php
         $input="3";
         if($input==1){
            echo "「１です！」";
         }
         elseif($input==2){
            echo "「プログラミングキャンプ！」";
         }
         elseif($input=="a"){
            echo "「文字です！」";
         }
         else{
            echo "その他です！";
         }

         ?>

      </p>
   </section><!--------------------------------------------->
   <section><!--------------------------------------------->
      <h4>#07 応用編 クエリストリングを使おう</h4>
      <p class="test">

         <?php

         $sougaku = null;
         $kosuu = null;
         $shubetu = null;
         $point = null;

         echo "urlの最後に ?sougaku=**&kosuu=**&shubetu=** と入力してね*^v^*<br>";
         echo "(種別は 1:雑貨 2:生鮮食品 3:その他)"."<br>";
         $sougaku = $_GET["sougaku"];
         $kosuu = $_GET["kosuu"];
         $shubetu = $_GET["shubetu"];
         if ($shubetu == 1) {
            $shubetu = "雑貨";
         }
         elseif ($shubetu == 2) {
            $shubetu = "生鮮食品";
         }
         elseif ($shubetu == 3) {
            $shubetu = "その他";
         }
         echo "--お会計--<br>";
         echo "総額: ¥$sougaku- 個数: $kosuu 種別: $shubetu になります"."<br>";
         $price = (int)($sougaku/$kosuu);
         echo "この時、商品１個あたりの値段は: ¥$price- になります<br>";
         echo "ポイントは¥3000-以上で4% ¥5000-以上では5% になりますので<br>";
         if ($sougaku >= 5000) {
            $point = (int)($sougaku/100*5);
         }
         elseif ($sougaku >= 3000) {
            $point = (int)($sougaku/100*4);
         }
         elseif ($sougaku < 3000) {
            $point = "なし";
         }
         echo "今回のポイントは $point になります";

         ?>

      </p>
   </section><!--------------------------------------------->
   <footer></footer>
</body>
</html>
