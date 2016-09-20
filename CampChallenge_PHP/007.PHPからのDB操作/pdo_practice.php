<?php
/*

// define('DB_DATABASE', 'test_db');
// define('DB_USERNAME', 'kiki');
// define('DB_PASSWORD', 'metal');
// // define('DB_CHARSET', '');
// define('PDO_DSN', 'mysql:host=localhost;dbname=' . DB_DATABASE);
//
// try {
//     // cennect
//     $pdo_object = new PDO ( PDO_DSN , DB_USERNAME , DB_PASSWORD );
//     $pdo_object->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//
//     // insert
//     $pdo_object->exec( "insert into user (name) values ('ukon');" );
//     echo "user added! <br>";
//
//     // disconnect
//     $pdo_object = null;
//
// } catch (PDOException $e) {
//     echo $e->getMessage();
//     exit;
// }



const DB_DATABASE = "challenge_db";
const DB_USERNAME = "kiki";
const DB_PASSWORD = "metal";
const DB_CHARSET = ";charset = utf8";
// DSN : データソースネーム : 接続するために必要な情報
const PDO_DSN = "mysql:host=localhost;dbname=" . DB_DATABASE;

try{
    // connect
    $pdo_object = new PDO ( PDO_DSN . DB_CHARSET , DB_USERNAME , DB_PASSWORD );
    $pdo_object->setAttribute ( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION );

    // ----action----
    $_="exec() を使ってみる";
    // $pdo_object->exec ( "insert into profiles (name) values ('hello man');" );
    // echo "user added^^!! <br>";

    $_="prepare () を使ってみる";
    // $sql = "insert into profiles ( profilesID , name ) values ( ? , ? );";
    // $stmt_object = $pdo_object->prepare( $sql );  // stmt : ステートメント
    // $stmt_object->execute( ['97', 'kikimetal'] );
    // echo "inserted id : " . $pdo_object->lastInsertId();

    // prepare( ...... ( ? , ? ) ); でなく
    $_="名前付きパラメータを使ってみる";
    // $sql_02 = "insert into profiles (name, tell) values ( :name, :tell );";
    // $stmt_02 = $pdo_object->prepare( $sql_02 );
    // $stmt_02->execute( [ ':name' => 'lalametal' , ':tell' => '111-11' ] );
    // echo "inserted!";


    $_=" bindValue() を使ってみる ";
    // $sql_03 = "insert into profiles ( name , tell ) values ( :name , :tell );";
    // $stmt_03 = $pdo_object->prepare( $sql_03 );
    // $stmt_03->bindValue( ":name" , "バインドバリュー奴" );
    // $stmt_03->bindValue( ":tell" , "9999-9999!" );
    // $stmt_03->execute();
    // echo "バインドバリュー奴 gone!!";

    $_="bindValue() もっかい！";
    $sql = "insert into profiles ( name , tell ) values ( :name , :tell ) ";
    $stmt = $pdo_object->prepare($sql);
    $stmt->bindValue( ":name" , "ukon vasara" , PDO::PARAM_STR);
    $stmt->bindValue( "tell" , "999-999" , PDO::PARAM_STR);
    $stmt->execute();
    echo "inserted ukon !!";


    $_=" 他の第３引数 ";
    // $stmt00->bindValue( "name" , "purple heart" , "ここの部分！！");
    // PDO::PARAM_STR
    // PDO::PARAM_INT
    // PDO::PARAM_NULL
    // PDO::PARAM_BOOL


    // disconnect
    $pdo_object = null;
}catch( PDOException $e ){
    die ( '<br> 接続に失敗しました : ' . $e->getMessage() );
}


*/
?>



<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>07_PDO_practice</title>
        <link rel="stylesheet" href="../00/style.css">
    </head>
    <body>
        <h3>07 phpからのデータベース操作</h3>
        <h4>*- memo -*</h4>
        <section>
            <h4>PDO で MySQL に接続する</h4>
            <pre>
            try{
                // connect
                $pdo = new PDO( PDO_DSN , DB_USERNAME , DB_PASSWORD );
                $pdo->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION );

                // do
                $pdo->exec( "CREATE TABLE fc_member( id int , name varchar(255) );" );

                // disconnect
                $pdo = null;
            }catch( PDOException $e ){
                die( "接続失敗しました : " . $e->getMessage() );
            }
            </pre>
            <h4>PDO で SQL を実行する際の手段</h4>
            <pre>
                1) exec() : 結果を返さない、なおかつ安全な SQL を実行するのに適している
                2) query() : 結果を返す、安全な SQL 、何回も実行されない SQL
                3) prepare() : 結果を返す、安全対策が必要、複数回実行される SQL
            </pre>
            <h4>$stmt->bindValue();</h4>
            <pre>
                $stmt = $pdo->prepare( "INSERT INTO fc_member( id , name ) VALUES ( :id , :name );" );
                $stmt->bindValue( ":id" , "入れたい値");
                $stmt->bindValue( ":name" , "入れたい値" );
                $stmt->execute();
            </pre>
            <h4>$stmt-><span>bindParam();</span> 複数連続で入れるときはこっちの方が便利かも!</h4>
            <pre>
                bindValue は、そのときの値を bind する
                <span>bindParam</span> は、とりあえず $変数 を bind し、
                execute() するまで変数の中身を変えられる！

                e.g.)
                $stmt = $pdo->prepare( "INSERT INTO test_table ( name , dps ) VALUES ( :name , :dps );" );
                $stmt->bindParam( ":name" , $name , PDO::PARAM_STR );
                $stmt->bindParam( ":dps" , $dps , PDO::PARAM_INT );
                $name = "kiki";
                $dps = 990;
                $stmt->execute();
                $dps = 1044;
                $stmt->execute();
                $dps = 1120;
                $stmt->execute();

                // これで ３つのレコードが挿入される
                name : dps
                kiki : 990
                kiki : 1044
                kiki : 1120
            </pre>
            <h4><span>bind するときの第３引数</span>の種類</h4>
            <pre>
                // $stmt00->bindValue( "name" , "purple heart" , "ここの部分！！");
                // PDO::PARAM_STR
                // PDO::PARAM_INT
                // PDO::PARAM_NULL
                // PDO::PARAM_BOOL
            </pre>
            <h4>SELECT で引っ張り出すとき</h4>
            <pre>
                // 連想配列形式で $resultに結果を格納

                // $stmt = $pdo->prepare("SELECT * FROM ---");
                // $stmt->execute();
                // $result = $stmt->fetchall(PDO::FETCH_ASSOC);
                // $result に配列形式で格納される
            </pre>
        </section>
        <section>
            <div class="test">
                <pre>
    // define('DB_DATABASE', 'test_db');
    // define('DB_USERNAME', 'kiki');
    // define('DB_PASSWORD', 'metal');
    // // define('DB_CHARSET', '');
    // define('PDO_DSN', 'mysql:host=localhost;dbname=' . DB_DATABASE);
    //
    // try {
    //     // cennect
    //     $pdo_object = new PDO ( PDO_DSN , DB_USERNAME , DB_PASSWORD );
    //     $pdo_object->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //
    //     // insert
    //     $pdo_object->exec( "insert into user (name) values ('ukon');" );
    //     echo "user added! <br>";
    //
    //     // disconnect
    //     $pdo_object = null;
    //
    // } catch (PDOException $e) {
    //     echo $e->getMessage();
    //     exit;
    // }



    const DB_DATABASE = "challenge_db";
    const DB_USERNAME = "kiki";
    const DB_PASSWORD = "metal";
    const DB_CHARSET = ";charset = utf8";
    // DSN : データソースネーム : 接続するために必要な情報
    const PDO_DSN = "mysql:host=localhost;dbname=" . DB_DATABASE;

    try{
        // connect
        $pdo_object = new PDO ( PDO_DSN . DB_CHARSET , DB_USERNAME , DB_PASSWORD );
        $pdo_object->setAttribute ( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION );

        // ----action----
        $_="exec() を使ってみる";
        // $pdo_object->exec ( "insert into profiles (name) values ('hello man');" );
        // echo "user added^^!! <br>";

        $_="prepare () を使ってみる";
        // $sql = "insert into profiles ( profilesID , name ) values ( ? , ? );";
        // $stmt_object = $pdo_object->prepare( $sql );  // stmt : ステートメント
        // $stmt_object->execute( ['97', 'kikimetal'] );
        // echo "inserted id : " . $pdo_object->lastInsertId();

        // prepare( ...... ( ? , ? ) ); でなく
        $_="名前付きパラメータを使ってみる";
        // $sql_02 = "insert into profiles (name, tell) values ( :name, :tell );";
        // $stmt_02 = $pdo_object->prepare( $sql_02 );
        // $stmt_02->execute( [ ':name' => 'lalametal' , ':tell' => '111-11' ] );
        // echo "inserted!";


        $_=" bindValue() を使ってみる ";
        // $sql_03 = "insert into profiles ( name , tell ) values ( :name , :tell );";
        // $stmt_03 = $pdo_object->prepare( $sql_03 );
        // $stmt_03->bindValue( ":name" , "バインドバリュー奴" );
        // $stmt_03->bindValue( ":tell" , "9999-9999!" );
        // $stmt_03->execute();
        // echo "バインドバリュー奴 gone!!";

        $_="bindValue() もっかい！";
        $sql = "insert into profiles ( name , tell ) values ( :name , :tell ) ";
        $stmt = $pdo_object->prepare($sql);
        $stmt->bindValue( ":name" , "ukon vasara" , PDO::PARAM_STR);
        $stmt->bindValue( "tell" , "999-999" , PDO::PARAM_STR);
        $stmt->execute();
        echo "inserted ukon !!";


        $_=" 他の第３引数 ";
        // $stmt00->bindValue( "name" , "purple heart" , "ここの部分！！");
        // PDO::PARAM_STR
        // PDO::PARAM_INT
        // PDO::PARAM_NULL
        // PDO::PARAM_BOOL


        // disconnect
        $pdo_object = null;
    }catch( PDOException $e ){
        die ( '<br> 接続に失敗しました : ' . $e->getMessage() );
    }
            </pre>
            </div>
        </section>
    </body>
</html>
