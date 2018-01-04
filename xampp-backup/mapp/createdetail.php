<?php
include 'library/config.php';
include 'classes/class.users.php';

$user = new Users();

$name = $_GET['name'];
$cost = $_GET['cost'];

$new = $user->new_detail($name,$cost);

if($new){
	echo "{\"newbudget\":[{\"check\":\"true\"}]}";
}else{
	echo "{\"newbudget\":[{\"check\":\"false\"}]}";
}