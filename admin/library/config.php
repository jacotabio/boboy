<?php
session_start();

$localhost = true;

if($localhost){
define('DB_SERVER','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_DATABASE','db_boboy');
}