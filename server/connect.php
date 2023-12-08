<?php

/*$host_name = '127.0.0.1';
$user_name = 'root';
$password = 'root';
$db_name = 'BAKERY_SHOP';
$con = mysqli_connect($host_name, $user_name, $password, $db_name);
if (!$con) {
  die('database connect failed!');
}*/

$host_name = 'localhost';
$user_name = 'zdvalszw_BAKERY_SHOP';
$password = 'BAKERY_SHOP2023@';
$db_name = 'zdvalszw_BAKERY_SHOP';
$con = mysqli_connect($host_name, $user_name, $password, $db_name);
if (!$con) {
  die('database connect failed!');
}

?>