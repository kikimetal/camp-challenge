<?php
// ----retouch----
// db_connect() > return_top() で必要になるため require を追加致しました。
// また、必要な関数を追加致しました。

require_once "scriptUtil.php";
require_once "defineUtil.php";


//DBへの接続を行う。成功ならPDOオブジェクトを、失敗なら中断、メッセージの表示を行う
function db_connect() {
    try {
        // ----retouch----
        $pdo = new PDO( PDO_DSN , DB_USERNAME , DB_PASSWORD );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;

    } catch (PDOException $e) {
        // ----retouch----
        // die してしまうと、ここで全ての処理が終了されてしまうため、トップへ戻るが表示されなくなってしまうのを変更。
        echo '<p>接続に失敗しました。次記のエラーにより処理を中断します。</p><p>'.$e->getMessage().'</p>';
        echo return_top();
        exit;
    }
}


//レコードの挿入を行う。失敗した場合はエラー文を返却する
function insert_profiles($name, $birthday, $type, $tell, $comment){
    //db接続を確立
    $insert_db = db_connect();

    //DBに全項目のある1レコードを登録するSQL
    // ----retouch----
    $insert_sql = "INSERT INTO user_t(name, birthday, tell, type, comment, newDate)";
    $insert_sql .= "VALUES(:name, :birthday, :tell, :type, :comment, :newDate)";


    //現在時をdatetime型で取得
    $datetime = new DateTime();
    $date = $datetime->format('Y-m-d H:i:s');


    //クエリとして用意
    $insert_query = $insert_db->prepare($insert_sql);

    //SQL文にセッションから受け取った値＆現在時をバインド
    $insert_query->bindValue(':name',$name);
    $insert_query->bindValue(':birthday',$birthday);
    $insert_query->bindValue(':tell',$tell);
    $insert_query->bindValue(':type',$type);
    $insert_query->bindValue(':comment',$comment);
    $insert_query->bindValue(':newDate',$date);

    //SQLを実行
    try {
        $insert_query->execute();
    } catch (PDOException $e) {
        //接続オブジェクトを初期化することでDB接続を切断
        $insert_db = null;
        return $e->getMessage();
    }


    $insert_db = null;
    return null;
}

function serch_all_profiles() {
    //db接続を確立
    $search_db = db_connect();

    $search_sql = "SELECT * FROM user_t";

    //クエリとして用意
    $search_query = $search_db->prepare($search_sql);

    //SQLを実行
    try{
        $search_query->execute();
    } catch (PDOException $e) {
        $search_query=null;
        return $e->getMessage();
    }

    //全レコードを連想配列として返却
    return $search_query->fetchAll(PDO::FETCH_ASSOC);

}

/**
 * 複合条件検索を行う
 * @param type $name
 * @param type $year
 * @param type $type
 * @return type
 */
function serch_profiles($name=null,$year=null,$type=null){
    //db接続を確立
    $search_db = db_connect();

    $search_sql = "SELECT * FROM user_t";
    $flag = false;
    if(!empty($name)){
        $search_sql .= " WHERE name like :name";
        $flag = true;
    }
    // ----retouch----
    if(!empty($year) && $flag == false){
        $search_sql .= " WHERE birthday like :year";
        $flag = true;
    }else if(!empty($year)){
        $search_sql .= " AND birthday like :year";
    }


    // ----retouch----
    // 種別の複合検索を有効化する。checkbox からくる配列を分解できるようにする。
    $type_flg = false;
    if(!empty($type)){
        if($flag){
            $search_sql .= " AND (";
        }else{
            $search_sql .= " WHERE (";
        }

        if(is_array($type)){ // 配列だったらこうする
            $type_arr = array();
            foreach ($type as $key => $value) {
                // if(isset($value)){
                    if($type_flg){
                        $search_sql .= " or";
                    }
                    $search_sql .= " type = :type".$key;
                    $type_arr[$key] = $value; // 下の bindValue で使う！
                    $type_flg = true;
                // }
            }
        }else{
            $search_sql .= " type = :type";
        }

        $search_sql .= " );";
    }



    //クエリとして用意
    // ----retouch----
    // $seatch_query -> $search_query へ修正。
    $search_query = $search_db->prepare($search_sql);

    // ----retouch----
    // 初期のままだと$name,$yearがからっぽでもバインド成功してしまう。
    // 実行されるsqlには like %% がつくためエラーにはならないが...
    // WHERE name like %% AND year like %% というSQL生成はどうなのか。

    // 上記の SQL 生成を empty 分岐に変更したため、存在しないパラムにバインドする命令を弾く
    // こっちにもempty 分岐を追加
    if(!empty($name)){
        $search_query->bindValue(':name','%'.$name.'%');
    }
    if(!empty($year)){
        $search_query->bindValue(':year','%'.$year.'%');
    }

    // ----retouch----
    if(!empty($type)){
        if($type_flg){
            foreach ($type_arr as $key => $value) {
                $search_query->bindValue(':type'.$key, $value);
            }
        }else{
            $search_query->bindValue(':type', $type);
        }
    }

    //SQLを実行
    try{
        $search_query->execute();
    } catch (PDOException $e) {
        $search_query = null;
        return $e->getMessage();
    }

    //該当するレコードを連想配列として返却
    return $search_query->fetchAll(PDO::FETCH_ASSOC);
}


function profile_detail($id){
    //db接続を確立
    $detail_db = db_connect();

    $detail_sql = "SELECT * FROM user_t WHERE userID = :id";

    //クエリとして用意
    $detail_query = $detail_db->prepare($detail_sql);

    $detail_query->bindValue(':id',$id);

    //SQLを実行
    try{
        $detail_query->execute();
    } catch (PDOException $e) {
        $detail_query=null;
        return $e->getMessage();
    }


    //レコードを連想配列として返却
    return $detail_query->fetchAll(PDO::FETCH_ASSOC);
}

function delete_profile($id){
    //db接続を確立
    $delete_db = db_connect();

    // ----retouch----
    // スペルミスを修正。
    $delete_sql = "DELETE FROM user_t WHERE userID = :id";

    //クエリとして用意
    $delete_query = $delete_db->prepare($delete_sql);

    $delete_query->bindValue(':id',$id);

    //SQLを実行
    try{
        $delete_query->execute();
    }catch(PDOException $e){
        $delete_query=null;
        return $e->getMessage();
    }

    return null;
}


// ----retouch----
function update_profile($id, $name, $birthday, $type, $tell, $comment){
    //db接続を確立
    $update_db = db_connect();

    $update_sql = "UPDATE user_t SET name = :name , birthday = :birthday , tell = :tell , type = :type , comment = :comment , newDate = :newDate WHERE userID = :id";

    //現在時をdatetime型で取得し、登録時刻に上書きできるようにする
    $datetime = new DateTime();
    $date = $datetime->format('Y-m-d H:i:s');

    //クエリとして用意
    $update_query = $update_db->prepare($update_sql);

    $update_query->bindValue(':name',$name);
    $update_query->bindValue(':birthday',$birthday);
    $update_query->bindValue(':tell',$tell);
    $update_query->bindValue(':type',$type);
    $update_query->bindValue(':comment',$comment);
    // 日付更新を追加
    $update_query->bindValue(':newDate',$date);

    $update_query->bindValue(':id',$id);

    //SQLを実行
    try{
        $update_query->execute();
    }catch(PDOException $e){
        $update_query=null;
        return $e->getMessage();
    }

    return null;
}
