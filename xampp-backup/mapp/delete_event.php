<?php
include 'library/config.php';
include 'classes/class.users.php';

$user = new Users();

$id = $_GET['id'];

$delete = $user->delete_budget($id);

if($delete){
	echo "{\"delete\":[{\"check\":\"true\"}]}";
}else{
	echo "{\"delete\":[{\"check\":\"false\"}]}";
}