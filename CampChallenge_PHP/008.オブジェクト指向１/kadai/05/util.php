<?php
require_once "define.php";
// 関数保存


// 今回ユーザーは何ができる？
// -> ログイン、ログアウト、商品を登録、登録一覧を見る、user name
class User {
    // ログイン
    public function login() {
        try {
            $pdo = pdo_connect();
            $sql = "SELECT * FROM obj_user WHERE name = :name and password = :password";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue( ":name" , $_POST["name"] );
            $stmt->bindValue( ":password" , $_POST["password"] );
            $stmt->execute();
            $result = $stmt->fetchall(PDO::FETCH_ASSOC);
            // var_dump($result);
            if ($result) {
                // 登録ユーザーが見つかった場合
                echo "<p>ログイン成功！３秒後にユーザーページへ飛びます。</p>";
                $html = '<meta http-equiv="refresh" content="3;URL=' . "'user.php'" . '">';
                echo $html;
            } else {
                echo "<p>その組み合わせは登録されていません！</p><p>name か password が間違っています！</p>";
            }

            $pdo = null;
        } catch (PDOException $e) {
            die("ログイン : 接続エラー : " . $e->getMessage());
        }
    }


    // ログアウト
    public function logout() {
        session_set_cookie_params(1);
        session_start();
        session_regenerate_id();
        session_unset();
        session_destroy();
    }


    // 自分のユーザーIDをDBから取得する
    public function get_my_user_id() {
        try {
            $pdo = pdo_connect();
            $sql = "SELECT id FROM obj_user WHERE name = :name";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue( ":name" , $this->name );
            $stmt->execute();
            $result = $stmt->fetchall(PDO::FETCH_ASSOC);
            return $result[0]["id"];

            $pdo = null;
        } catch (PDOException $e) {
            die("userID取得 : 接続エラー : " . $e->getMessage());
        }

    }


    // 商品確認
    public function select_all_my_product() {
        try {
            $pdo = pdo_connect();
            $sql = "SELECT name FROM obj_product WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue( ":id" , $_SESSION["user_id"] );
            $stmt->execute();
            $result = $stmt->fetchall(PDO::FETCH_ASSOC);

            $product_list = array();
            foreach ($result as $record_row => $record) {
                foreach ($record as $column => $value) {
                    if ($column == "name") {
                        $product_list[] = $value;
                    }
                }
            }
            // これで[0]..[1]..[2] のような単純な配列になる
            return $product_list;

            $pdo = null;
        } catch (PDOException $e) {
            die("一覧参照 : 接続エラー : " . $e->getMessage());
        }
    }


    // 商品登録
    public function insert_product() {
        try {
            if (!empty($_POST["product_name"]) and !empty($_SESSION["user_id"])) {
                $pdo = pdo_connect();

                $sql = "INSERT INTO obj_product VALUES (:user_id , :product_name);";
                $stmt = $pdo->prepare($sql);

                $stmt->bindValue( ":user_id" , $_SESSION["user_id"] , PDO::PARAM_INT );
                $stmt->bindValue( ":product_name" , $_POST["product_name"] , PDO::PARAM_STR );
                $stmt->execute();

            }

            $pdo = null;
        } catch (PDOException $e) {
            die("登録 : 接続エラー : " . $e->getMessage());
        }
    }




    // user name 直接セッションに入れちゃえば不必要か...
    public $name;

    public function set_name($str) {
        $this->name = $str;
    }

    public function get_name() {
        if (!empty($this->name)) {
            return $this->name;
        }
    }


}
// ----------User



// PDO connect
function pdo_connect() {
    $pdo = new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
}


// セッションクッキーの存在を返す、あったら true
function session_cookie_chk() {
    if (isset($_COOKIE["PHPSESSID"])) {
        $bool = true;
    } else {
        $bool = false;
    }
    return $bool;
}


?>
