<?php
require_once "define.php";
// 関数保存



// SELECT_SQL
function pdo_select($sql) {
    try {
        // connect
        $pdo = new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // do
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchall(PDO::FETCH_ASSOC);
        // disconnect
        $pdo = null;
        // return
        return $result;

    } catch (PDOException $e) {
        die("接続エラー（SELECT） : " . $e->getMessage());
    }
}




// timetable から取り出した値を分解して echo
function echo_subject_and_teacher($value) {
    if ( mb_strpos($value, "@") ) {
        $subject = mb_strstr( $value, "@", true );
        $teacher = mb_substr( mb_strstr($value, "@"), 1 );
        $result = "<p>".$subject."</p><p>".$teacher."</p>";
        echo $result;
    } else {
        echo "<p>" . htmlspecialchars_decode("&nbsp;") . "</p>";
        echo "<p>" . htmlspecialchars_decode("&nbsp;") . "</p>";
    }
}



// この課題の中では、INSERT はしない感じになる
// すでに時間割に沿ってフィールドが作られているため（NULLが入っている）、
// UPDATE で新しい時間割をセットしていく
function pdo_update($sql) {
    // $sql = "UPDATE timetable SET :day = :s_and_t WHERE timetable_id = :time;";
    $s_and_t = combine_subject_and_teacher();
    try {
        // connect
        $pdo = new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // do
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":time" , $_POST["time"] , PDO::PARAM_STR);
        $stmt->bindValue(":s_and_t" , $s_and_t , PDO::PARAM_STR);
        $stmt->execute();

        // disconnect
        $pdo = null;
    } catch (PDOException $e) {
        die("接続エラー（UPDATE） : " . $e->getMessage());
    }
}




// _POST を分解
function combine_subject_and_teacher() {
    $str = $_POST["subject"];
    $str .= "@";
    $str .= $_POST["teacher"];
    return $str;
}





// teacher テーブルに接続して、radio ボタンのリストとして echo で吐き出すまでの一連
function look_list_of_teacher() {
    $sql = "SELECT teacher_name FROM teacher";
    $teacher = pdo_select($sql);
    echo "<div>";
    foreach ($teacher as $val) {
        foreach ($val as $value) {
            echo "<p><label><input type='radio' name='teacher' value='". $value ."'>". $value ."</label></p>";
        }
    }
    echo "</div>";
}

// subject テーブルに接続して、radio ボタンのリストとして echo で吐き出すまでの一連
function look_list_of_subject() {
    $sql = "SELECT subject_name FROM subject";
    $subject = pdo_select($sql);
    echo "<div>";
    foreach ($subject as $val) {
        foreach ($val as $value) {
            echo "<p><label><input type='radio' name='subject' value='". $value ."'>". $value ."</label></p>";
        }
    }
    echo "</div>";
}












?>
