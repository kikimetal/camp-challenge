<?php echo $_COOKIE["PHPSESSID"]; ?>
<?php session_set_cookie_params(1); ?>
<?php session_start(); ?>

<?php

setcookie("hello", "helooooooooo!");


echo $_COOKIE["hello"];


?>
