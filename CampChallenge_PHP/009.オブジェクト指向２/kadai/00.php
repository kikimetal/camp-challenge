<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>php_オブジェクト指向_02</title>
        <link rel="stylesheet" href="../00/style.css">
    </head>
    <body>
        <header>
            <h3>php_オブジェクト指向_02 課題</h3>
        </header>
        <section>
            <pre>
                1~6までのステップを踏んで、「DBからデータを取得、取得したデータを表示できる、2種類のクラス」を作成して ください。期限:4日
                1.DBに人の情報を入れたテーブルを作成してください。
                2.DBに駅の情報を入れたテーブルを作成してください。
                3.baseという抽象クラスを作成し、以下を実装してください。
                ・loadというprotectedな関数を用意してください。
                ・showという公開関数を用意してください。
                4.3で作成した抽象クラスを継承して、以下のクラスを作成してください。
                ・人の情報を扱うHumanクラス
                ・駅の情報を扱うStationクラス
                    また、各クラスに隠匿変数でtableという変数を用意し、
                    各クラスの初期化処理で   table変数にテーブル名を設定してください。
                5.load関数でDBから全情報を取得するように各クラスの関数を実装してください。
                    その際、table変数を利用して、データを取得するようにしてください。
                6.show関数で各テーブルの情報の一覧を表示されるようにしてください。
            </pre>
        </section>
        <h4>以下課題</h4>
        <section>

            <?php
            const DATABASENAME = "challenge_db";
            const DB_USERNAME = "kiki";
            const DB_PASSWORD = "metal";
            const PDO_DSN = "mysql:host=localhost;dbname=".DATABASENAME.";charset=utf8";


            abstract class Base {
                abstract protected function load();
                abstract public function show();
            }


            class Human extends Base {
                private $table;
                public function __construct($str) {
                    $this->table = $str;
                }
                function load() {
                    try {
                        // connect
                        $pdo = new PDO( PDO_DSN, DB_USERNAME, DB_PASSWORD );
                        $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

                        // do
                        $sql = "SELECT * FROM ";
                        $sql .= $this->table;

                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();

                        $result = $stmt->fetchall(PDO::FETCH_ASSOC);
                        return $result;

                        // disconnect
                        $pdo = null;
                    } catch (PDOException $e) {
                        die( "接続エラー : " . $e->getMessage() );
                    }

                }

                function show() {
                    $station = $this->load();

                    echo "<p>".$this->table."</p>";
                    echo "<table>";
                    echo "<tr><th>id</th><th>station name</th></tr>";
                        foreach ($station as $record_row => $record) {
                            echo "<tr>";
                            foreach ($record as $column => $value) {
                                echo "<td>".$value."</td>";
                            }
                            echo "</tr>";
                        }
                    //     echo "<tr><td>".$key."</td></tr>";
                    echo "</table>";
                }
            }


            class Station extends Base {
                private $table;
                public function __construct($str) {
                    $this->table = $str;
                }
                function load() {
                    try {
                        // connect
                        $pdo = new PDO( PDO_DSN, DB_USERNAME, DB_PASSWORD );
                        $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

                        // do
                        $sql = "SELECT * FROM ";
                        $sql .= $this->table;

                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();

                        $result = $stmt->fetchall(PDO::FETCH_ASSOC);
                        return $result;

                        // disconnect
                        $pdo = null;
                    } catch (PDOException $e) {
                        die( "接続エラー : " . $e->getMessage() );
                    }

                }

                function show() {
                    $station = $this->load();

                    echo "<p>".$this->table."</p>";
                    echo "<table>";
                    echo "<tr><th>id</th><th>station name</th></tr>";
                        foreach ($station as $record_row => $record) {
                            echo "<tr>";
                            foreach ($record as $column => $value) {
                                echo "<td>".$value."</td>";
                            }
                            echo "</tr>";
                        }
                    //     echo "<tr><td>".$key."</td></tr>";
                    echo "</table>";
                }
            }



            $hm = new Human("user");
            $hm->show();

            $st = new Station("station");
            $st->show();


            ?>

        </section>
    </body>
</html>
