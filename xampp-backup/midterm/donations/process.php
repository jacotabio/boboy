<?php
include '../library/config.php';
include '../classes/class.settings.php';
include '../classes/class.users.php';
include '../classes/class.donations.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';
$sID = (isset($_GET['sID']) && $_GET['sID'] != '') ? $_GET['sID'] : '';
$dID = (isset($_GET['dID']) && $_GET['dID'] != '') ? $_GET['dID'] : '';
switch($action){
	case 'newsponsor': fn_newsponsor();
		break;
	case 'newdonation': fn_newdonation();
		break;
	case 'editprofile': fn_editprofile();
		break;
	case 'deleteprofile': fn_deleteprofile();
		break;
	case 'editdonation': fn_editdonation();
		break;
	case 'deletedonation': fn_deletedonation();
		break;
	case 'searchproduct': fn_searchdonation();
		break;
	case 'searchdonor': fn_searchdonor();
		break;
}

function fn_searchdonor(){
	if(isset($_GET['searchval']) && $_GET['searchval']='all')
	{
		$searchvalue = '';	
	}
	else{
		$searchvalue = $_POST['searchvalue'];
	}
	$donations = new Donations();
	$donations->search_donors($searchvalue);
	header("location: ../index.php?mod=donations&sub=sponsors&search=$searchvalue");
	exit;
}

function fn_searchdonation(){
	if(isset($_GET['searchval']) && $_GET['searchval']='all')
	{
		$searchvalue = '';	
	}
	else{
		$searchvalue = $_POST['searchvalue'];
	}
	$donations = new Donations();
	$donations->search_donations($searchvalue);
	if(isset($_GET['mode']) && $_GET['mode']!='')
	{
		switch($_GET['mode']){
			case 'all':
				header("location: ../index.php?mod=donations&sub=overview&pro=all&search=$searchvalue");
				break;
			case 'items':
				header("location: ../index.php?mod=donations&sub=overview&pro=item&search=$searchvalue");
				break;
			case 'cash':
				header("location: ../index.php?mod=donations&sub=overview&pro=cash&search=$searchvalue");
				break;
		}
	}
	exit;
}

function fn_newsponsor(){
	$s_userid = $_POST['s_userid'];
	$firstname = ucwords($_POST['firstname']);
	$lastname = ucwords($_POST['lastname']);
	$donations = new Donations();
	$new = $donations->new_sponsor($s_userid,$firstname,$lastname);
	if(!$new){
		header("location: ../index.php?mod=donations&sub=sponsors&pro=newsponsor&n=");
		exit;
	}else{
		$message = "Sponsor created successfully!";
		header("location: ../index.php?mod=donations&sub=sponsors");
		exit;
	}
}

function fn_newdonation(){
	$donations = new Donations();

	$title = ucwords($_POST['title']);
	$sponsorid = $_POST['sponsorid'];
	$date = $_POST['date'];
	$time = $_POST['time'];
	echo $time;
	$description = $_POST['description'];
	$amount = $_POST['amount'];
	$dtype = $_POST['dtype'];
	$itemname = $_POST['itemname'];
	$itemqty = $_POST['itemqty'];
	
	if($dtype == 301){
		$donations->new_donation_item($title,$sponsorid,$description,$itemname,$itemqty,$dtype);
	}
	if($dtype == 302){
		$donations->new_balance($amount,$sponsorid);
		$donations->new_donation_cash($title,$sponsorid,$description,$amount,$dtype);
	}
	header("location: ../index.php?mod=donations&sub=sponsors&pro=profile&sID=$sponsorid");
	exit;
}

function fn_editprofile(){
	$sID = $_GET['sID'];
	$edit_fname = $_POST['edit_fname'];
	$edit_lname = $_POST['edit_lname'];
	$donations = new Donations();
	$donations->edit_profile($edit_fname,$edit_lname,$sID);
	header("location: ../index.php?mod=donations&sub=sponsors&pro=profile&sID=$sID");
	exit;
}

function fn_deleteprofile(){
	$sID = $_GET['sID'];
	$donations = new Donations();
	$donations->delete_profile($sID);
	header("location: ../index.php?mod=donations&sub=sponsors");
	exit;
}

function fn_editdonation(){
	$dID = $_GET['dID'];
	$edit_title = $_POST['edit_title'];
	$edit_description = $_POST['edit_description'];
	$donations = new Donations();
	$donations->edit_donation($dID,$edit_title,$edit_description);
	header("location: ../index.php?mod=donations&sub=overview&pro=view&dID=$dID");
	exit;
}

function fn_deletedonation(){
	$dID = $_GET['dID'];
	$donations = new Donations();
	$donations->delete_donation($dID);
	header("location: ../index.php?mod=donations&sub=overview&pro=all");
	exit;
}