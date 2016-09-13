<!-- functions page -->

<?php

//ログインパスワードチェック
// function pass_check(){
//    if(isset($_POST["pass"])){
//       if($_POST["pass"] == PASSWORD){
//          ログインせ
//       }
//    }else{
//       $return = "ログインパスワードを入力してください";
//    }
// }

$get_data = array();
// $_GETのデータチェック 入っていたら、別変数に格納、true を返す、入ってなかったら false
function chk_get_data($get_name){
   global $get_data;
   if(!empty($_GET["$get_name"])){
      $get_data["$get_name"] = $_GET["$get_name"];
      $chk = true;
   }else {
      $chk = false;
   }
   return $chk;
}


// ログイン画面からインプット画面への間（これは実質３秒しか開かないから関係ない）
// 入力から入力までの間
// 入力ジャンプ後、SHOW 画面の戻るボタンを押すまでの間
// これらのどれかが $period_time をオーバーすると、タイムアウトでセッションデストロイ,SIDはおニューになる
// でもデストロイもページ来場回数はリセットされない、$_COOKIEの方で保存してるからね
function session_chk(){
    $period_time = 120;
   //  session_start();
    if(!empty($_SESSION['last_access'])){
        if((mktime() - $_SESSION['last_access']) > $period_time){
           logout_session();
            echo '<meta http-equiv="refresh" content="0;URL='.REDIRECT.'?mode=timeout">';
            exit;
        }else{
            $_SESSION['last_access']=mktime();
        }
    }else{
        echo '<meta http-equiv="refresh" content="0;URL='.REDIRECT.'">';
        exit;
    }
}


//デストロイ
function logout_session(){
    session_unset();
    if (isset($_COOKIE['PHPSESSID'])) {
        setcookie('PHPSESSID', '', time() - 1800, '/');
    }
    session_destroy();
}


?>
