<?php

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



// もう一度さらから自分でやってみる

const DB_DATABASE = "challenge_db";
const DB_USERNAME = "kiki";
const DB_PASSWORD = "metal";
const DB_CHARSET = ";charset = utf8";
// DSN : データソースネーム : 接続するために必要な情報
const PDO_DSN = "mysql:host=localhost;dbname=" . DB_DATABASE;

try{
    // connect
    $pdo_object = new PDO( PDO_DSN . DB_CHARSET , DB_USERNAME , DB_PASSWORD );
    $pdo_object->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION );

    // ----action----
    echo "接続成功っ！";

    // disconnect
    $pdo_object = null;
    
}catch( PDOException $e ){
    die ( '<br> 接続に失敗しました : ' . $e->getMessage() );
}







?>
