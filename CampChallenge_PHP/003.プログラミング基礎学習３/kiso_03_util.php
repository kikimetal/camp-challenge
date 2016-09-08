<?php


//#01
function test08_01(){
   echo "hello 私はききるんです"."<br>";
   echo "生まれは 西暦1993年の霊5月10日 月神メネフィナの月です"."<br>";
   echo "melodic death metal が大好物です"."<br>";
}
for ($i=0; $i<10; $i++) {
   test08_01();
}


//#02
function test08_02($number = null){
   if($number % 2 == 0){
      echo "$number は偶数です";
   }
   else {
      echo "$number は奇数です";
   }
}
$x = 81;
test08_02($x);

?>
