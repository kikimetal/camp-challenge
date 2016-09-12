<!doctype html>

<!-- sectionで課題を分けています -->

<html lang="ja">
<head>
   <meta charset="utf-8">
   <title>built_in_function</title>
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
         max-width: 600px;
         margin: 5px auto;
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
         animation-duration: 16s;
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
            opacity: 1;
         }
         60%{
            opacity: 1;
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
      a:first-child{
         color: hotpink;
      }

   </style>
</head>
<body>
   <header>
      <p>phpの組み込み関数</p>
      <p>20160908 - 20160909</p>
   </header>
   <h4><a href="#kadai">課題へ</a><h4>
   <h4>*- memo -*</h4>
   <section class="memo">
      <h4>前章からの教訓</h4>
      <pre>
         strpos,strstr,preg_matchではstrposが最も早いので<span>strpos</span>を使う。
         PHPマニュアルにもそのように書いてある。
      </pre>
      <pre>
         *-<span>心がけて！</span>-*
         カラフルな英単語を使おう
         簡素さだけを留意してちゃダメ！
         変数や関数の名前はわかりやすくする！
         コードも後から見て何をしてるか分かりやすく！
         他人が見るかもしれないし、未来の自分が見るかもしれない
         多少文字数が伸びても、<span>具体的で</span>、<span>目的</span>がわかりやすいようにするんだ
      </pre>
      <h4>組み込み関数 日付け編</h4>
      <p class="test">

         <?php

         echo "タイムスタンプ生成 mktime <br>";
         echo "mktime(時, 分, 秒, 月, 日, 年) <br>";
         $stamp = mktime(1,1,1,1,1,99);
         echo "$stamp"."<br>これはこのままだと使えない<br><br>";

         echo "日時の書式化";
         $today = date("y/m/d");
         $Today = date("Y/M/D");
         $today_jpn = date("y年m月d日");
         echo "<br>Y と y で表示する桁数が変わるだと...？！！<br>";
         echo "today('y/m/d') = $today <br>";
         echo "Today('Y/M/D') = $Today <br>";
         echo "today_jpn('y年m月d日') = $today_jpn <br><br>";

         $info_date = getdate();
         print_r($info_date);

         echo "<br><br>";
         $today = date("Y/m/d", $stamp);
         echo "$today <br>";

         ?>

      </p>
      <pre>
         "(y/m/d)"以外もなんかいろいろあるっぽい -v
         <a href="http://php.net/manual/ja/function.date.php">http://php.net/manual/ja/function.date.php</a>
      </pre>
      <h4>strtotime</h4>
      <pre>
         2通り使い方がある？

         <q>文字列</q>が与えられた時は<q>総秒</q>に変換する
            $date = 文字列での日付;
            $stamp = <span>strtotime</span>($date);

         <q>総秒</q>の状態のものへ "+1 year" "+3 hour" という形で<q>総秒</q>を加算できる
            $stamp_old = 総秒;
            $stamp_new = <span>strtotime</span>("+24 minute", $stamp_old);

            $stamp_new <-- これは<q>総秒</q>が入っている
      </pre>
      <pre>
         $today_second = mktime(1,2,3,10,10,16);
         $today = date("y-m-d H:i:s",$today_second);
         echo "today : " . "$today";
         $yesterday_second = strtotime("+1 day",strtotime($today));
         $yesterday = date("y-m-d H:i:s",$yesterday_second);
         echo "yesterday : " . $yesterday;

         これでどうなる...?
      </pre>
      <p>

         <?php
         $today_second = mktime(1,2,3,10,10,16);
         $today = date("y-m-d H:i:s",$today_second);
         echo "today     : " . "$today <br>";
         $yesterday_second = strtotime("+1 day",strtotime($today));
         $yesterday = date("y-m-d H:i:s",$yesterday_second);
         echo "yesterday : " . $yesterday;

         echo "<br>こうなる";
         ?>

      </p>

      <h4>php組み込み関数 文字列編</h4>
      <pre>
         - 文字列長
         echo strlen('あああ');   // 9バイト
         echo mb_strlen('あああ');    // 3文字 マルチバイトで見てくれる

         - 部分文字列の取得
            substr(先頭からn番目, そこからx個表示);
            文字の最初は0番目
         echo substr('abcdef', 3, 2);   // de
         echo substr('abcdef', 0, 3);   // abc
         echo mb_substr('あいう', 1, 1);    // い

         - 空白除去
         echo trim('    あああ  ');

         - 文字列比較
         echo strcmp('AAAA', 'あいう');
      </pre>
      <pre>
         - 文字検索 strpos(対象文字列, 検索文字列);
         echo strpos('soeda', 'd'); //3

         - 指定文字列以降を取得する
         echo strstr('soeda-r@groove-gear.jp', '@');

         - 文字列の置換
            対象文字列中の 検索文字を 置換文字に置き換える
            str_replace(検索文字, 置換文字, 対象文字列)
         echo str_replace('o', 'a', 'soeda’);

         - 特定文字での配列化、文字列化
            explode は特定の文字を対象に文字列を分割し、配列にする
            implode は指定文字を利用して配列を連結し、一つの文字列にする
         $sample = "aaa,bbb,ccc,ddd";
         $arr = explode(",", $sample);  //sampleの「,」を
         $str = implode(",", $arr);
      </pre>
      <h4>phpの組み込み関数 ファイル編</h4>
      <pre>
         ファイル操作にはモードが存在し、
         基本的に読み込み(r)・書き込み(w)・追記(a)を指定
         流れは、opne -> 操作 -> close

         - ファイルを読み込みモードで開く
            $fp = fopen('xxx.txt', 'r');

         - 読み取り操作 - １行読み取り
            $file_txt = fgets($fp);

         - ファイルを閉じる
            fclose($fp);

         - ファイルを書き込みモードで開く
            $fp = fopen('xxx.txt', 'w');

         - 書き込み操作 - １行書き込み
            fwrite($fp, 'www');

         - ファイルを閉じる
            fclose($fp);
      </pre>
      <h4>fopen -> fclose</h4>
      <pre>
         fopenの操作モードは r(読み込み) w(書き込み) a(追記)
         open したら必ず <span>close</span> すること

         - ファイルを追記モードで開く
               $fp = fopen('xxx.txt', 'a');
         - 書き込み操作 - １行追記
               fwrite($fp, 'www');
         - ファイルを閉じる
               fclose($fp);
      </pre>
      <h4>fwrite / fgets</h4>
      <pre>
         //４行、行数+hello を生成
         $txt = fopen("test.txt","w");
         for ($i=1; $i<5; $i++) {
            $string = "$i : hello".PHP_EOL;
            fwrite($txt, $string);
         }
         fclose($txt);

         //それを表示させる
         $txt = fopen("test.txt","r");
         for ($i=1; $i<5; $i++) {
            $output = fgets($txt);
            echo $output . "< br >";
         }
         fclose($txt);

         /*
         ゆえに、fgets() は１行読み込む度に、
         その行は読み込み済みということになって、以降では対象外？のような状態になる
         読み込むというより、取り出してしまってるイメージか
         */

         --v php実行
      </pre>
      <p>
         <?php

         // ４行、行数+hello を生成
         $txt = fopen("test.txt","w");
         for ($i=1; $i<5; $i++) {
            $string = "$i : hello".PHP_EOL;
            fwrite($txt, $string);
         }
         fclose($txt);

         // それを表示させる
         $txt = fopen("test.txt","r");
         for ($i=1; $i<5; $i++) {
            $output = fgets($txt);
            echo $output . "<br>";
         }
         fclose($txt);

         /*
         ゆえに、fgets() は１行読み込む度に、
         その行は読み込み済みということになって、以降では対象外？のような状態になる
         読み込むというより、取り出してしまってるイメージか
         */

         ?>
      </p>
   </section>

   <h4>以下課題</h4>
   <section>
      <h4>#01</h4>
      <h5>2016年1月1日 0時0分0秒のタイムスタンプを作成し、表示してください。</h5>
      <p class="test">

         <?php

         $today = mktime(0,0,0,1,1,16);
         $today_00 = date("Y年m月d日H時i分s秒", $today);
         $today_01 = date("Y年m月d日G時i分s秒", $today);
         echo "$today_00"."<br>";
         echo "$today_01"."<br>";
         echo "<span>一桁の0にできないです...</span>";

         ?>

      </p>

   </section>
   <section>
      <h4>#02</h4>
      <h5>現在の日時を「年-月-日 時:分:秒」で表示してください。</h5>
      <p class="test">

         <?php

         $today_02 = date("Y年m月d日H時i分s秒");
         echo "$today_02 <br>";
         // php.iniのデフォルトタイムゾーンを変更するのが大変でした

         ?>

      </p>
   </section>
   <section>
      <h4>#03</h4>
      <h5>2016年11月4日 10時0分0秒のタイムスタンプを作成し、「年-月-日 時:分:秒」で表示してください。</h5>
      <p class="test">

         <?php

         $time_stamp_03 = mktime(10, 0, 0, 11, 4, 16);
         $today_03 = date("Y年m月d日H時i分s秒",$time_stamp_03);
         echo "$today_03 <br>";

         ?>

      </p>
   </section>
   <section>
      <h4>#04</h4>
      <h5>2015年1月1日 0時0分0秒と2015年12月31日 23時59分59秒の差（総秒）を表示してください。</h5>
      <p class="test">

         <?php

         $second_0101 = mktime(0,0,0,1,1,15);
         $second_1231 = mktime(23,59,59,12,31,15);
         echo "$second_1231 - $second_0101 = ";
         echo $second_1231 - $second_0101 . "(差)";

         ?>

      </p>
   </section>
   <section>
      <h4>#05</h4>
      <h5>自分の氏名について、バイト数と文字数を取得して、表示してください。</h5>
      <p class="test">

         <?php

         $my_name = "高橋伸二";
         echo "$my_name <br>";
         echo "バイト : " . strlen($my_name) . "<br>";
         echo "文字数 : " . mb_strlen($my_name);


         ?>

      </p>
   </section>
   <section>
      <h4>#06</h4>
      <h5>自分のメールアドレスの「@」以降の文字を取得して、表示してください。</h5>
      <p class="test">

         <?php

         $mail = "kikimetal@me.com";
         $at_ikou_mail = strstr($mail, "@");
         echo $at_ikou_mail;

         ?>

      </p>
   </section>
   <section>
      <h4>#07</h4>
      <h5>以下の文章の「I」⇒「い」に、「U」⇒「う」に入れ替える処理を作成し、結果を表示してください。<br>
      「きょUはぴIえIちぴIのくみこみかんすUのがくしゅUをしてIます」</h5>
      <p class="test">

         <?php

         $lunatic_str = "「きょUはぴIえIちぴIのくみこみかんすUのがくしゅUをしてIます」";
         $replace_str = str_replace("I","い",$lunatic_str);
         $replace_str = str_replace("U","う",$replace_str);
         echo $replace_str;
         // ひとまとめにはできないのかな？

         ?>

      </p>
   </section>
   <section>
      <h4>#08</h4>
      <h5>ファイルに自己紹介を書き出し、保存してください。</h5>
      <p class="test">

         <?php

         $write_me = fopen("write_me.txt","w");
         $add_str_me = "ききるん　ゆめゆめ　叶えるっちゃ<br>プロプロ　グラグラ　がんばるっちゃ"; // 代入する自己紹介本文
         fwrite($write_me, $add_str_me);
         fclose($write_me);

         $write_me = fopen("write_me.txt","a"); // 追記練習
         fwrite($write_me,"<br>以上！");
         fclose($write_me);

         echo "// 書き出し --> write_me.txt";

         ?>

      </p>
      <p>改行させたり複数行読み込ませんるのを調べたほうがいいかもね</p>
      <p>
         そうか!! 出力するのはただのテキストだけど、<br>
         それを読み込んで解釈するのはブラウザ上だから、<span>HTMLタグ</span>が有効なんだ！！
      </p>
   </section>
   <section>
      <h4>#09</h4>
      <h5>ファイルから自己紹介を読み出し、表示してください。</h5>
      <p class="test">

         <?php

         $read_me = fopen("write_me.txt","r");
         $me_txt = fgets($read_me);
         echo $me_txt;
         fclose($read_me);

         ?>

      </p>
      <pre>
         複数行なくてもtxt内の &lt;br&gt; で調節すればブラウザ上では改行されるか...
      </pre>
   </section>
   <section>
      <h4>#10 応用編</h4>
      <pre>
      紹介していないPHPの組み込み関数を利用して、処理を作成してください。

      講義では紹介されていないPHPの組み込み関数はたくさん存在します。
      PHPの公式サイトから関数を選び、実際にロジックを作成してみてください。

      また、この処理を作成するに当たり、下記を必ず実装してください。

      ①処理の経過を書き込むログファイルを作成する。
      ②処理の開始、終了のタイミングで、ログファイルに開始・終了の書き込みを行う。
      ③書き込む内容は、「日時 - 状況（開始・終了）」の形式で書き込む。
      ④最後に、ログファイルを読み込み、その内容を表示してください。
      </pre>
      <p class="test">

         <?php

         // ログファイルの雛形　ページリロードごとに生成される
         $log = fopen("log.txt","w");
         fwrite($log,"<br><br> log: <br>");
         fclose($log);

         // タイムスタンプ表示させる関数
         // START/END を 0/1 とかで if で分岐させてもいいが
         // あえて引数で明示的に書くことでコード上で始まりと終わりが見えやすいようにする
         function timestamp ($function_name, $start_end){
            global $log;
            $log = fopen("log.txt","a");
            $time_stamp = date("Y年m月d日H時i分s秒");
            $time_stamp .= " - $function_name ($start_end) <br>";
            fwrite($log, $time_stamp);
            fclose($log);
         }

         // もっと組み込み関数を使ってみる
         // htmlspecialchars();
         timestamp("htmlspecialchars","START");
         echo "- <span>htmlspecialchars(タグ含む文字列);</span> を使ってみる <br>";
         $string = '<a target="_blank" href="http://google.com">google</a>';
         echo $string . "<br>";                         // 普通の表示
         $result_01 = htmlspecialchars($string);
         echo $result_01 . "<br>";    // htmlspecialcharsした後の表示
         timestamp("htmlspecialchars","END");


         // array_merge();
         timestamp("array_merge","START");
         echo "<br>- <span>array_merge(配列, 配列);</span> を使ってみる <br>";
         $array_01 = array("kiki"=>"blm","lala"=>"whm");
         $array_02 = array("ukon"=>"dragoon","mint"=>"whm");
         $result_02 = array_merge($array_01, $array_02);
         print_r($array_01); echo "<br>";
         print_r($array_02); echo "<br>";
         print_r($result_02); echo "<br>";
         timestamp("array_merge","END");


         //isset(); // nl2br // ログファイルのタイプスタンプが入れ子になるはず
         timestamp("iseet","START");
         echo "<br>- <span>isset(値);</span> と <span>nl2br(文字列);</span> を使ってみる <br>";

         timestamp("nl2br","START");
         $php_manual = '○PHPマニュアル
                        [manual func=”empty”] — 変数が空であるかどうかを検査する
                        [manual func=”isset”] — 変数がセットされていること、そして NULL でないことを検査する';
         $result_manual = nl2br($php_manual);
         echo "$result_manual <br>";
         timestamp("nl2br","END");
         echo "<br>";
         $test_number = "入力値";
         if (isset($test_number)) {
            echo "中身入ってます <br>";
         }
         else {
            echo "中身入ってません <br>";
         }
         timestamp("isset","END");


         //wait 処理とかあるかな？... あった！！！！
         timestamp("sleep","START");
         echo "<br>- <span>sleep(seconds);</span> を使ってみる*^^* <br>";
         echo "2秒止めるよ! 次のタイムスタンプが2秒遅延するはずよ <br>";
         sleep(2);
         echo "指定した秒数 seconds が負の場合、 この関数は E_WARNING を発生させるらしい <br>";
         timestamp("sleep","END");


         // ログファイルのブラウザへの出力
         timestamp("logファイルの読み込み","START");
         $log_text = fopen("log.txt","r");
         $log_output = fgets($log_text);
         echo "$log_output"; // ログファイルのブラウザへの出力
         fclose($log_text);
         timestamp("logファイルの読み込み","END"); // 順序的にこれはブラウザでは表示されないはず

         echo "<br>logファイルの読み込みの(END)は出力後に書き込みされるので、表示されません";

         ?>

      </p>
   </section>


   <footer><div><a href="#">Top❤︎</a></div></footer>
</body>
</html>
