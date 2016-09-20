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


    // #07 ここから課題
    // profileID=1 nameを「松岡 修造」に、ageを48に、birthdayを1967-11-06に 更新してください

    $sql_update = "
        UPDATE
            profiles
        SET
            name = '松岡 修造',
            age = 48,
            birthday = '1967-11-06'
        WHERE
            profilesID = 1;
    ";
    $sql_select = "SELECT * FROM profiles;"; // 確認用

    $pdo->exec($sql_update);
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
