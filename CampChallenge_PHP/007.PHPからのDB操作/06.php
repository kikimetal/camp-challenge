<?php

const DB_DATABASE_NAME = "challenge_db";
const DB_USERNAME = "kiki";
const DB_PASSWORD = "metal";
const DB_CHARSET = ";charset=utf8";
const PDO_DSN = "mysql:host=localhost;dbname=" . DB_DATABASE_NAME . DB_CHARSET;


try {
    // connect
    // $pdo = new PDO(PDO_DSN . DB_DATABASE_NAME . DB_CHARSET , DB_USERNAME , DB_PASSWORD);
    $pdo = new PDO(PDO_DSN , DB_USERNAME , DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    // action
    echo "接続 start <br>";


    // #06 ここから課題
    // 課題2でINSERTしたレコードを指定して削除してください。SELECT*で結果を表示してください

    // 課題にでinsert したのはテストくんだっけ...
    $sql_delete = "DELETE FROM profiles WHERE name LIKE '%テスト%';";
    $sql_select = "SELECT * FROM profiles;";

    $pdo->exec($sql_delete);
    $stmt = $pdo->prepare($sql_select);
    $stmt->execute();
    $result = $stmt->fetchall(PDO::FETCH_ASSOC);


    echo "<pre>";
    var_dump($result);
    echo "</pre>";



// memo
// 連想配列形式で $resultに結果を格納
// $stmt = $pdo->prepare("SELECT * FROM ---");
// $stmt->execute();
// $result = $stmt->fetchall(PDO::FETCH_ASSOC);
// $result に配列形式で格納される


    // disconnect
    $pdo = null;
    echo "<br> 接続 end";

} catch (PDOException $e) {
    die("接続に失敗しちゃった＞＜ <br>" . $e->getMessage() );
}

?>
