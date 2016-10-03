<?php
const ROOT_URL = 'http://localhost/camp/10_02/app';     //indexディレクトリへのURL
const TOP_URI = '/';                                //トップページ
const INSERT = 'insert.php';                        //登録ページ
const INSERT_CONFIRM = 'insert_confirm.php';        //登録確認ページ
const INSERT_RESULT = 'insert_result.php';          //登録完了ページ
const SEARCH = 'search.php';                         //検索ページ
const SEARCH_RESULT = 'search_result.php';          //検索結果ページ
const RESULT_DETAIL = 'result_detail.php';          //検索詳細ページ
const DELETE = 'delete.php';                        //検索詳細ページ
const DELETE_RESULT = 'delete_result.php';          //検索詳細ページ
const UPDATE = 'update.php';                         //検索詳細ページ
const UPDATE_RESULT = 'update_result.php';          //検索詳細ページ


// DBアクセスする際の情報を変更致しました。
const DB_DATABASE = "challenge_db";
const DB_USERNAME = "kiki";
const DB_PASSWORD = "metal";
const PDO_DSN = "mysql:host=localhost;dbname=" . DB_DATABASE . ";charset=utf8";
