<?
-----------------------------------
巨大なソースコード修正 02
修正箇所 memo

    * ----retouch----
        機能要件
        変更、追加

    * ----add----
        非機能要件っぽいの
        追加

-----------------------------------
ファイル名.php
    修正箇所 作業見積もり時間
        修正内容
        // 修正済み
-----------------------------------
all
    // 修正箇所の探索 10h
        // 機能要件の欠落の発見
        // 全体的なページレイアウト修正
        // ソースのインデント、スペースの整頓
        // ユーザービリティ（非機能要件）の考慮

    // データベース（今期の場合MySQL）が停止している時の挙動をチェック。 1h

    // DBアクセスエラー以外に、Undefined などのエラーが出る場合はそれを修正。 2h

    // DBアクセスエラー時に表示させる $e->getMessage 周りをHTMLタグで調節して、より、ページの処理の一環として 1h
    // ユーザーに自然に見せてあげるように修正する。
    // （初期では、改行なし & bodyへ直書き状態 で不自然）
    // 箇所は以下
        // インサート結果
        // サーチ結果
        // アップデート結果
        // デリート結果

    !!重要
    // ピックアップリスト修正後、全てのページの挙動チェック。 3h
    //     dbaccessUtil のSQL を変えて Exception の挙動チェック
    //     XAMPP を停止させてのDBアクセスエラーチェック
    //     URLで直接ページに飛んだ時の挙動チェック
    //     検索、挿入、更新、削除、のチェック。
    //     挿入、更新時の、入力漏れに対する挙動チェック。
    //     挿入、更新されたデータ自体のチェック。
    //     登録時刻などが正しく更新されているか。
    //     全てのページにトップへ戻るがあるか。

-----------------------------------
index.php

-----------------------------------

dbaccessUtil.php
    // ファイル名が dbaccesになっていた 10min
        // dbaccessUtil.php に訂正
        // 伴ってすべてのファイルの require を訂正

    // PDOデータソースネーム 10min
        // defineUtil から引用

    // $delete_sql = "DELEtE * FROM user_t WHERE userID=:id"; 5min
        // DELETE FROM に訂正

    // search_profiles(){} 1h
        // 受け取った値がからでも SQL が生成される
        // 値がからの時に出来上がる SQL は
            // where name like %% and year like %% and...
        // 同時に
        // このままだと$name,$yearがからっぽでもバインド成功してしまう。
        // 実行されるsqlには like %% がつくためエラーにはならないが...
        // WHERE name like %% AND year like %% というSQL生成はどうなのか。

            // isset 分岐だと フォームから受け取る、空のstring"" を許可してしまう。
            //  -> 全体的に isset 分岐でなく empty 分岐で処理していく。
                // emoty は空のstring"" に対してきちんと false を返してくれるから。

    // 新しい関数の追加 2h


    追記）
    !!重要
    // データベースconnectの関数内でExceptionが帰ってきた時、dieしてしまうため、トップページへ戻るが出現しない！


defineUtil.php

    // 今回使うデータベースへの接続に必要な情報を定数かして保存 10min

scriptUtil.php

    // 新しい関数の追加 1h
    // トップページへ戻る同様に、 5min
    // サーチページに戻る、 5min
    // インサートページに戻る、 5min


    // インサート未入力の時に、そこの部分の見出しにわかりやすくカラーをつけてあげる関数を追加 1h



-----------------------------------
insert.php
    // 電話番号が テキトーな文字列とかでも登録できてしまう 1h

insert_confirm.php

    // if(!$_POST['mode']=="CONFIRM"){ 10min
        // echo 'アクセスルートが不正です。もう一度トップページからやり直してください<br>';

            // _POST の中身チェックしてない 5min

    // 上記の内容で登録します。よろしいですか？
    // に対して、はい or 登録画面に戻る が不親切なので 要修正 10min


insert.php
    // 何が結局未入力だったか赤文字で表示させたい 2h

insert_result.php
    // if(!$_POST['mode']=="RESULT"){ 5min
        // 同上


    // ブラウザのリロードでフォームが再送信され、手軽なコマンドで同じユーザー登録をいくらでもできてしまう。
    // 前ページでセッションチケットなどを発行してそれを消費する形でDBアクセスするなどしないといけないのか？
        // --> update_result.php も同様に処理しないといけない。
        // INSERT ごとく、何個も追加とはならないが、リロードごとにアップデートされてしまうため、DBアクセスの負荷にも関わり、
        // ユーザーの内容的には、登録時刻が、リロードの度に上書きされてしまうなどがある。

-----------------------------------
search.php
    // トップへ戻るが存在しない 5min
    // 種別の選択の際、全て、という選択肢が無い。また複合検索なので、２種選択をさせたい 2h

    // サーチ結果画面から戻ってきた時に、前回の検索ワードが保持されていない 3h
    // しかし安易に定義済みの form_value() を使ってしまうと 例えば $_SESSION["name"]などは
    // INSERT.php の方で使われているため、ユーザーの想定外の操作で、INSERTで入力したものが
    // SEARCHで初期表示されるなどの不具合が起こるはず。
    // これを解決する手段として、
    //     ①
    //         INSERT で使われている ["name"] などを、["insert_name"] に
    //         SEARCH で使う ["name"] を ["search_name"] にする。
    //         デメリット:
    //             insert,search 以外が追加されていくたびに、
    //             長い要素名の記述が半強制させられる可能性
    //     ②
    //         INSERT / SEARCH ごとに配列で格納する
    //         e.g.)   $_SESSION["insert"]["name"]
    //                 $_SESSION["search"]["name"]
    //         デメリット:
    //             配列から常に呼び出すため、foreach の多用や
    //             配列の配列ということで後見者が見にくい可能性
    //
    //     今回は ① で進める。


    // 機能要件を満たした状態のままだと、 1h
    // 全て空欄での検索で全ユーザーを表示するようになっているが
    // その意図が伝わらな買った場合、
    // あるいはどっか入力しちゃったけど、やっぱり全ユーザーを出したい場合、
    // になった時のために、全ユーザー表示ボタンを実装。

    // リザルト画面で直接IDを入力したい有識ユーザー向けに、明示的に直接ID検索へ飛ばしてあげる、ボタンの実装。


search_result.php
    // 検索ページに戻るが存在しない 5min
    // トップページに戻るも無い 5min


    // 何件ヒット！があると見やすそう 1h


    // 表示されるバースデーが 0000-00-00 という表記になっている 1h
    // 年月日にフォーマットさせた方が見やすいかも？ -> 全ページで年月日で統一
        // これ使えそう
            // echo date('Y年n月j日', strtotime($value['birthday']));

    // dbaccessUtil.phpからエラーが返ってきた時の処理/分岐がない 30min



    // 追記)
    // DB接続エラーの時、エラー文とともに、空のHTMLテーブルのテーブルヘッドだけ出現してしまう。
    // これは不自然であるため、エラー時の分岐処理を修正。 30min

    // DBアクセスエラーの時、トップへ戻るが出現しない。


-----------------------------------
result_detail.php

    // トップページに戻るも無い 5min
    // 検索結果画面へ戻るが存在しない 5min

    // !重要
    // 検索結果画面に戻る際に、前回の検索結果を保持させるようにする。
        // 修正前だと、毎回全件表示になる。
        // これを、前回の検索で絞り込んだ状態を保持させる。利用者目線だと確実のこの挙動が自然。

    // 表示項目はDBカラムの全てなので、このままでは userID が表示されていない 10min

    // UPDATE DELETE に遷移する際に、向こうでDBアクセスしなくて済むように 1h
    // ユーザーのデータをすべて送ってあげる

    // 表示されるバースデーが 0000-00-00 という表記になっている 1h
    // 年月日にフォーマットさせた方が見やすいかも？



-----------------------------------
update.php
update_result.php
    // 不正アクセス対策 30min

    // 未実装ボタンの追加 1h

    // 初期状態で、未定義の変数を呼び出し、存在しない配列の指定、value= の後の何かがおかしいなど。要修正。 3h

    // このままだと新しい値が未入力でもOKになってしまう。しかしINSERTページのように、 2h
    // もともと確認画面が単体で存在しない。どのタイミングで空欄になってしまっているかをチェックスするか。
    // ① update_confirm.php を追加で作成し、リザルト画面に行く前に差し込む。
    //     INSERT 同様にそこでチェック。
    // ② update.php からのフォームをリザルト画面に飛ばすのでなく、 update.php にもう一度飛ばす。
    //     そこで未入力チェックをし、すべて入力されていたことに true した場合のみ、
    //     全入力データを $_SESSION["update_user_data"] に保存し、refresh でリザルト画面へ飛ばす…
    //
    //         update_result.php での不正アクセス判別は…
    //             !empty($_SESSION["update_user_data"]) == true
    //             そして、true 処理の後、
    //             $_SESSION["update_user_data"] = null
    //                 これでダイレクト時、リロード時に対して不正アクセス判別ができる

    // リロード対策。 30min
    // result でブラウザリロード時、フォームの再入力機能で、登録時刻の更新が永遠とできてしまう。



-----------------------------------
delete.php
delete_result.php
    // 不正アクセス対策 30min

    // 未実装ボタンの追加 2h
