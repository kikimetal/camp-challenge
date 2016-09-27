<?php
const ROOT_URL = 'http://localhost/camp/10_01/app';     //indexディレクトリへのURL
const TOP_URI = '/';                                //トップページ
const INSERT = 'insert.php';                   //登録ページ
const INSERT_CONFIRM = 'insert_confirm.php';   //登録確認ページ
const INSERT_RESULT = 'insert_result.php';     //登録完了ページ
const SEARCH = 'search.php';                   //検索ページ


// フォームで入力されるであろう、重要なキーの配列。未入力吐き出す時に便利にするために値を日本語で格納。
const FORM_ARR = array(
    "name" => "名前",
    "year" => "生年月日",
    "month" => "生年月日",
    "day" => "生年月日",
    "type" => "種別",
    "tell" => "電話番号",
    "comment" => "コメント"
);
