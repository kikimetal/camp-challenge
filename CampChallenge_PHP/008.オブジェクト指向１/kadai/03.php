<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>php_オブジェクト指向_01</title>
    <link rel="stylesheet" href="../00/style.css" media="screen" title="no title">
</head>
<body>
   <header>
      <p>オブジェクト指向_01</p>
   </header>
   <section>
      <h4>課題 #03</h4>
      <h5 class="pre">
          以下の機能を持つクラスを作成してください。
          ・パブリックな2つの変数
          ・2つの変数に値を設定するパブリックな関数
          ・2つの変数の中身をechoするパブリックな関数

      </h5>
      <p class="test">

         <?php
            class Kadai_03 {
                public $dream;
                public $theater;
                public function set_value($a, $b) {
                    $this->dream = $a;
                    $this->theater = $b;
                }
                public function echo_value() {
                    echo $this->dream;
                    echo $this->theater;
                }
            }

            $test = new Kadai_03();
            $test->set_value("ドリーム", "シアター");
            $test->echo_value();


         ?>

      </p>
   </section>
</body>
</html>
