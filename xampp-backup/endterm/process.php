<?php
include 'library/config.php';
include 'classes/class.topic.php';
include 'classes/class.users.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch($action){
	case 'submit': fn_newtopic();
		break;
	case 'register': fn_register();
		break;
	case 'comment': fn_comment();
		break;
	case 'like': fn_like();
		break;
	case 'search': fn_search();
		break;
}

function fn_search(){
	$topic = new Topic();
	$sval = $_POST['search'];
	if(isset($_GET['filter'])){
		$filter = $_GET['filter'];
		//$topic->search_topic_filtered($search,$filter);
		header("location: index.php?filter=$filter&search=$sval");
		exit;
	}else{
		//$topic->search_topic($search);
		header("location: index.php?search=$sval");
		exit;
	}
}

function fn_like(){
	$toid = isset($_GET['topic']) ? $_GET['topic'] : '';
	$topic = new Topic();
	$topic->send_like($toid,$_SESSION['userid']);
	header("location: index.php?topic=$toid");
	exit;
}

function fn_comment(){
	$toid = isset($_GET['topic']) ? $_GET['topic'] : '';
	$text = $_POST['comment'];
	$topic = new Topic();
	$topic->post_comment($text,$toid,$_SESSION['userid']);
	header("location: index.php?topic=$toid");
	exit;
}

function fn_newtopic(){
	$cat = $_POST['cat'];
	$title = $_POST['title'];
	header("location: index.php?cat=".$cat);
	$desc = nl2br(htmlentities($_POST['desc'], ENT_QUOTES, 'UTF-8'));
	$topic = new Topic();
	$topic->new_topic($title,$desc,$_SESSION['userid'],$cat);
	//header("location: index.php");
	exit;
}

function fn_register(){
	$fname = $_POST['firstname'];
	$lname = $_POST['lastname'];
	$email = $_POST['email'];
	$contact = $_POST['contact'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$copassword = $_POST['copassword'];
	if($password == $copassword){
		$user = new Users();
		$user->new_user($username,$password,$fname,$lname,$email,$contact);
		header("location: index.php");
		exit;
	}else{
		$msg = "Passwords do not match";
		header("location: register.php?msg=".$msg);
	}
}