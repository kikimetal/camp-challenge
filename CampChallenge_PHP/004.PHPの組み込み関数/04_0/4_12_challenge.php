<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
      <title>4_12_answer</title>
</head>
<body>
   <hr>
   <h3>php組み込み関数 課題 #12</h3>
   <pre>
      ・「坊ちゃん」の文章を、「。」の位置で改行して表示する
      ・元の文章の12行目までに対し処理するように
      ・最初に「元の文章」と、後に「変更後の文章」を表示すること
   </pre>
   <hr>
   <h4>*- memo -*</h4>
   <pre>
      strstr ( string $haystack , mixed $needle [, bool $before_needle = false ] )

      <b>$haystack</b>
      検索を行う文字列。

      <b>$needle</b>
      needle が文字列でない場合は、 それを整数に変換し、
      その番号に対応する文字として扱う。

      <b>$before_needle</b>
      <u>TRUE</u> にすると、strstr() の返り値は、
      haystack の中で最初に needle があらわれる箇所より前の部分となる
       (needle は含まない)。

      帰り値
      マッチした部分文字列を返す。
      needle が見つからない場合は FALSE を返す。
   </pre>
   <pre>
      探す対象が見つかんなかった時、帰り値 false をほしいだけなら
      確か strpos が一番早かったはず
   </pre>

   <hr>
   <h3>- 元の文章 -</h3>
   <p>

      <?php

      //読み込む行の指定
      $read_line = 12;

      //元の文章の表示
      $txt = fopen("4_12_bocchan.txt","r");
      for ($i = 0; $i < $read_line; $i++) {
         $output = fgets($txt);
         echo $output . "<br>";
      }
      fclose($txt);

      ?>

   </p>
   <hr>
   <h3>- 変更後の文章 -</h3>
   <p>

      <?php

      $turning_point = "。";

      $txt = fopen("4_12_bocchan.txt","r");

      for ($i = 0; $i < $read_line; $i++) {

         $txt_one_line = fgets($txt); //一行取得

         //ポシションを取りたいんじゃない、あるかないか、わかりやすく bool にしとく
         $found_it = (bool) strpos($txt_one_line, $turning_point);

         //「。」があったら改行処理を行う
         while ($found_it != false) {
            $output = strstr($txt_one_line, $turning_point, true);
            $output .= $turning_point; // このままだと文末に「。」がないから、くっつける
            $output .= "<br>"; //そんで改行させて
            echo $output; //出力だ！
            //「。」前は出力したので、「。」以降に入れ替える
            $txt_one_line = strstr($txt_one_line, $turning_point);
            //このままだと文章の先頭に「。」があるから、削る
            $txt_one_line = mb_substr($txt_one_line, 1);
            // 削ったのち、まだ「。」があるか更新する
            $found_it = (bool) strpos($txt_one_line, $turning_point);
            // var_dump($found_it); //確認
         }
      }

      fclose($txt);

      ?>

   </p>
   <hr>
   <div style="height:100px;"></div>

</body>
