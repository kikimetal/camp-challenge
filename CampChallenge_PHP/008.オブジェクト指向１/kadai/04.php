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

        <h4>課題 #04</h4>
        <h5 class="pre">
          3のクラスを継承し、以下の機能を持つクラスを作成してください。
          ・2つの変数の中身をクリアするパブリクな関数

        </h5>
        <p class="test">

            <?php
                // 課題 #03 のクラス
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


            ?>

            <?php
                // #04

                class Kadai_04 extends Kadai_03 {
                    public function clear_value() {
                        $this->dream = null;
                        $this->theater = null;
                    }
                }

                $test_02 = new Kadai_04();
                $test_02->set_value("ドリーム", "シアター");
                $test_02->echo_value(); // echo １回目

                echo "<br>";
                var_dump($test_02->dream);

                $test_02->clear_value();
                $test_02->echo_value(); // echo ２回目 出てこないはず

                echo "<br>";
                var_dump($test_02->dream);

            ?>

        </p>

    </section>
</body>
</html>
