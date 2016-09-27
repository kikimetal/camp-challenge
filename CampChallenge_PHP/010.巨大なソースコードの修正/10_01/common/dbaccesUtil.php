<?php
require_once 'scriptUtil.php';

// DB周りはここ
class Database {

    private function connect() {
        try {
            // $pdo = new PDO('mysql:host=localhost;dbname=Challenge_db;charset=utf8','hayashi','password');
            $dsn = "mysql:host=localhost;dbname=challenge_db;charset=utf8";
            $pdo = new PDO( $dsn , "kiki" , "metal" );
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;

        } catch (PDOException $e) {
            die('<p>接続に失敗しました。次記のエラーにより処理を中断します : </p><p>'.$e->getMessage().'</p>'.return_top());
        }
    }

    private function disconnect($pdo) {
        $pdo = null;
    }


    public function insert_all() {

        $pdo = $this->connect();

        //DBに全項目のある1レコードを登録するSQL
        $insert_sql = "INSERT INTO user_t(name,birthday,tell,type,comment,newDate)"
                . "VALUES(:name,:birthday,:tell,:type,:comment,:newDate)";

        try {
            $insert_query = $pdo->prepare($insert_sql);

            // もしセッションがスタートされていなかったらスタート
            if (session_status() === PHP_SESSION_DISABLED) {
                session_start();
            }

            //SQL文にセッションから受け取った値＆現在時をバインド
            $insert_query->bindValue(':name',$_SESSION['name']);
            $insert_query->bindValue(':birthday',$_SESSION['birthday']);
            $insert_query->bindValue(':tell',$_SESSION['tell']);
            $insert_query->bindValue(':type',$_SESSION['type']);
            $insert_query->bindValue(':comment',$_SESSION['comment']);
            $insert_query->bindValue(':newDate',$_SESSION['datetime']);

            //SQLを実行
            $insert_query->execute();

        } catch (PDOException $e) {
            die('<p>接続に失敗しました。次記のエラーにより処理を中断します : </p><p>'.$e->getMessage().'</p>'.return_top());
        }

        $this->disconnect($pdo);
    }


} // class Database
