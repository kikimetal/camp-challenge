<?php
require_once '../common/defineUtil.php';


  function return_top(){
      return "<div style='height:50px;line-height:50px;'><a href='".ROOT_URL."'>トップへ戻る</a></div>";
  }

// あったら echo
function echo_post($key) {
    if (!empty($_POST[$key])) {
        echo $_POST[$key];
    }
}

// あるかないか bool を返す
function chk_post($key) {
    if (!empty($_POST[$key])) {
        return $_POST[$key];
    }
}
