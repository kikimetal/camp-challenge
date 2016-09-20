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
    echo "接続 start";

    // 前の課題のテーブル profiles 一度消しちゃったのでもう一回作る
    $sql_create_table = "
        DROP TABLE IF EXISTS `profiles`;
        CREATE TABLE profiles(
            profilesID int auto_increment unique not null,
            name varchar(255),
            tell varchar(255),
            age int,
            birthday date,
            primary key (profilesID)
        );

        INSERT INTO profiles (name, tell, age, birthday) VALUES
            ('tanaka minoru', '012-345-6789', 30, '1994-02-01'),
            ('suzuki sigeru', '090-1122-3344', 37, '1987-08-12'),
            ('suzuki minoru', '080-5566-7788', 24, '2000-12-24'),
            ('satou kiyoshi', '012-0987-6543', 19, '2005-08-01'),
            ('takahashi kiyoshi', '090-9900-1234', 24, '2000-12-24');
    ";
    $pdo->exec($sql_create_table);


    // #02 ここから課題
    $name = "テストくん";
    $tell = "999-0000-0000";
    $age = 27;
    $birthday = "2099-12-12";

    $sql_insert = "
        INSERT INTO profiles (name, tell, age, birthday)
        VALUES (:name, :tell, :age, :birthday );
    ";

    $stmt = $pdo->prepare($sql_insert);
    $stmt->bindValue(":name", $name);
    $stmt->bindValue(":tell", $tell);
    $stmt->bindValue(":age", $age);
    $stmt->bindValue(":birthday", $birthday);
    $stmt->execute();


    // disconnect
    $pdo = null;
    echo "<br> 接続 end";

} catch (PDOException $e) {
    die("接続に失敗しちゃった＞＜ <br>" . $e->getMessage() );
}




?>
