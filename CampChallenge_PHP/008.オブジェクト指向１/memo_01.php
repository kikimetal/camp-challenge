<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>08_object_oriented</title>
    <link rel="stylesheet" href="../00/style.css" media="screen" title="no title">
</head>
<body>
<h3>the object</h3>
<section>
<?php

// クラスの名前の最初の文字は必ず大文字

// User クラスを作ってみる
class User {
    // property
    public $name;
    public $hobby;

    // constructor (これもメソッドの一種だから function )
    public function __construct($name, $hobby) {
        $this->name = $name;
        $this->hobby = $hobby;
    }

    // method
    public function hello() {
        echo "hello !!" . "<br>";
    }

    public function my_name() {
        echo "my name is $this->name" . "<br>";
    }

    public function my_hobby() {
        echo "my hobby is $this->hobby" . "<br>";
    }
}

$kiki = new User("kiki","metal");


$kiki->hello();
$kiki->my_name();
$kiki->my_hobby();
// $lala->hello();
// $ukon->my_hobby();


// クラスの継承
// 子クラス
class New_User extends User {
    public function wow(){
        echo "wow!! $this->name" . "<br>";
    }

    // override してみる
    public function my_name() {
        echo "my name is $this->name from Little_Twin_Stars" . "<br>";
    }
}

$ukon = new New_User("ukon","dragoon");

$ukon->wow();

$kiki->my_name();
$ukon->my_name();

// override させたくない場合は、親クラスの方のメソッドに
// final を付け加える
// e.g.)
    // final public function ***(){}



// アクセス権について 安全なプログラムを書くために必要
// - private : そのクラス内 からのみアクセス可能
// - protected : そのクラス内＋親子クラス からのみアクセス可能
// - public : どこからでもアクセス可能





?>

</section>
<h3>以下練習</h3>
<section>

<?php
// ------------------------------以下練習-----------------------------------
// member っぽいクラス
class Member {
    public $name;
    public $job;

    // public constructor
    public function __construct ( $name , $job ) {
        $this->name = $name;
        $this->job = $job;
    }

    // method
    public function echo_mainjob () {
        echo $this->name . "のメインジョブは" . $this->job . "です <br>";
    }
}

$case_ukon = new Member ( "ukon" , "dragoon" );
$case_ukon->echo_mainjob();

$case_kiki = new Member ( "kiki" , "warrior" );
$case_kiki->echo_mainjob();

$case_lala = new Member ( "lala" , "white mage" );
$case_lala->echo_mainjob();


// 継承
class Add_Member extends Member {
    public function echo_dream () {
        echo $this->name . "は立派な" . $this->job . "になりたい";
    }
}

$case_mint = new Add_Member ( "mint" , "paladin" );
$case_mint->echo_dream();





























?>

</section>
</body>
</html>
