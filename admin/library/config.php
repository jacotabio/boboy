<?php
session_start(); 

// Select a server
$localhost = true;
$hosted = false;
$webhost = false;
$x10host = false;


if($hosted){
  define('DB_SERVER','52.77.240.48');
  define('DB_USERNAME','admin');
  define('DB_PASSWORD','howtoforge');
  define('DB_DATABASE','db_sleepnotgo');
}
if($webhost){
  define('DB_SERVER','localhost');
  define('DB_USERNAME','id4138457_boboyexpress');
  define('DB_PASSWORD','ProjectUrbanite01');
  define('DB_DATABASE','id4138457_db_boboy');
}
if($localhost){
  define('DB_SERVER','localhost');
  define('DB_USERNAME','root');
  define('DB_PASSWORD','');
  define('DB_DATABASE','db_boboy');
}
if($x10host){
  define('DB_SERVER','localhost');
  define('DB_USERNAME','boboyx12_boboy');
  define('DB_PASSWORD','developermode16');
  define('DB_DATABASE','boboyx12_db');
}

?>