<?php
include '../../library/config.php';
include '../../classes/class.users.php';

$user = new Users();

if(isset($_POST['delete_customer'])){
	if($user->delete_customer($_POST['usr_id'])){
		echo "delete_success";
	}else{
		echo "delete_failed";
	}
}