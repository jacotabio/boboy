<?php
include 'library/config.php';
include 'classes/class.users.php';

$user = new Users();

$title = $_GET['title'];
$amount = $_GET['amount'];
$id = $_GET['id'];

$new = $user->new_budget($title,$amount,$id);

if($new){
	echo "{\"newbudget\":[{\"check\":\"true\"}]}";
}else{
	echo "{\"newbudget\":[{\"check\":\"false\"}]}";
}