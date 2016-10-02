<?php
require_once '../common/defineUtil.php';

/**
 * 使用した場所にトップページへのリンクを挿入する
 * @return トップページへのリンクのaタグ
 */
function return_top(){
    return "<div class='link'><a href='".ROOT_URL."'>トップへ戻る</a></div>";
}

// ----add----
// 続けて次のユーザーを登録したい際に使う、インサートページへのリンク
function return_insert(){
    return "<div class='link'><a href='".INSERT."'>続けてユーザー登録を行う</a></div>";
}

// ----add----
// 全く別の検索をしたい場合のために、クリアなサーチページに飛ばしてあげる
function return_search(){
    return "<div class='link'><a href='".SEARCH."'>別の検索を行う</a></div>";
}






/**
 * 種別番号から実際の種別名を返却する
 * @param type $type 種別と対応した数字
 * @return string 種別名
 */
function ex_typenum($type){
    switch ($type){
        case 1;
            return "エンジニア";
        case 2;
            return "営業";
        case 3;
            return "その他";
    }
}

/**
 * フォームの再入力時に、すでにセッションに対応した値があるときはその値を返却する
 * @param type $name formのname属性
 * @return type セッションに入力されていた値
 */
function form_value($name){
    if(isset($_POST['mode']) && $_POST['mode']=='insert_REINPUT'){
        if(isset($_SESSION[$name])){
            return $_SESSION[$name];
        }
    }
}

/**
 * ポストからセッションに存在チェックしてから値を渡す。
 * 二回目以降のアクセス用に、ポストから値の上書きがされない該当セッションは初期化する
 * @param type $name
 * @return type
 */
function bind_p2s($name){
    if(!empty($_POST[$name])){
        $_SESSION[$name] = $_POST[$name];
        return $_POST[$name];
    }else{
        $_SESSION[$name] = null;
        return null;
    }
}

// ----retouch----
// 上のゲットver.
function bind_g2s($name){
    if(!empty($_GET[$name])){
        $_SESSION[$name] = $_GET[$name];
        return $_GET[$name];
    }else{
        $_SESSION[$name] = null;
        return null;
    }
}


// ----add----
// insert.php で使う
// フォーム再入力時に、未入力だった項目のみ、カラー<span>を付ける。
// @param type $str ページのの入力項目名 : おそらく日本語
// @param type $name formのname属性 : おそらく英字
// @return type 未入力だったら<span>付与したものを、入力済みだったらそのまま $str を返す
function insert_input_chk($str, $name1, $name2=null, $name3=null) {
    if (isset($_POST['mode']) and $_POST['mode'] == 'insert_REINPUT') {
        if (empty($_SESSION[$name1])) {
            return "<span class='crimson'>*".$str."</span>";
        } elseif ($name2!=null and empty($_SESSION[$name2])) {
            return "<span class='crimson'>*".$str."</span>";
        } elseif ($name3!=null and empty($_SESSION[$name3])) {
            return "<span class='crimson'>*".$str."</span>";
        }
    }
    return $str;
}

// ----add----
// update.php で使う。上のupdate ver.
function update_input_chk($str, $name1, $name2=null, $name3=null) {
    if (isset($_POST['mode']) and $_POST['mode'] == 'un_complete') {
        if (empty($_SESSION["user_data"][$name1])) {
            return "<span class='crimson'>*".$str."</span>";
        } elseif ($name2!=null and empty($_SESSION["user_data"][$name2])) {
            return "<span class='crimson'>*".$str."</span>";
        } elseif ($name3!=null and empty($_SESSION["user_data"][$name3])) {
            return "<span class='crimson'>*".$str."</span>";
        }
    }
    return $str;
}
