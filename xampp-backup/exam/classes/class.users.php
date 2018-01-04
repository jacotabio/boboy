<?php
class Users{
	public $db;
	
	public function __construct(){
		$this->db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		if(mysqli_connect_errno()){
			echo "Database connection error.";
			exit;
		}
	}
	
	public function get_users(){
		$sql = "SELECT * FROM tbl_users";
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_assoc($result)){
			$list[] = $row;
		}
		return $list;
	}
	
	public function check_user($userid){

	}
	public function new_user($userid,$access,$password,$lastname,$firstname){
	$sql = "SELECT * FROM tbl_users WHERE usr_userid = '$userid'";
	$check=$this->db->query($sql);
	$count_row = $check->num_rows;
		if($count_row == 0){
			$newpassword = md5($password);
			$sql = "INSERT INTO tbl_users(usr_userid,usr_password,usr_lastname,
			usr_firstname,usr_date_added,usr_time_added,acc_id) 
			VALUES('$userid','$newpassword','$lastname','$firstname',NOW(),NOW(),'$access')";
			
			$result = mysqli_query($this->db,$sql) or die(mysqli_error() . "Cannot Insert Data");
			return $result;
		}else{
			$result = 0;
			return $result;
		}
	}
	
	public function edit_user($edit_fname,$edit_lname,$edit_newpassword){
		$current_user = $_SESSION['current_user'];
		$convert_password = md5($edit_newpassword);
		$sql = "UPDATE tbl_users set usr_firstname='$edit_fname', usr_lastname='$edit_lname', usr_password='$convert_password' WHERE usr_userid=$current_user";
		$result = mysqli_query($this->db,$sql) or die(mysqli_error() . "Cannot Update Data");
		return $result;
	}
	
	public function check_login($userid,$password){
		$sql = "SELECT * FROM tbl_users WHERE 
		usr_userid='$userid' AND usr_password='$password'";
		$result=mysqli_query($this->db,$sql);
		$userdata=mysqli_fetch_array($result);
		$count = $result->num_rows;
		if($count == 1){
			$_SESSION['login']=true;
            $_SESSION['access']=$userdata['acc_id'];
            $_SESSION['userid']=$userdata['usr_id'];
            $_SESSION['current_user']=$userdata['usr_userid'];
            $_SESSION['current_password']=$userdata['usr_password'];
            $_SESSION['userfname']=$userdata['usr_firstname'];
            $_SESSION['userlname']=$userdata['usr_lastname'];
			$_SESSION['userdata']= $userdata['usr_lastname'].', '.$userdata['usr_firstname'];
			return true;
		}
		else{
			return false;
		}
	}

	public function get_session(){
		if(isset($_SESSION['login']) && $_SESSION['login'] == true){
			return true;
		}
		else{
			return false;
		}
	}
}