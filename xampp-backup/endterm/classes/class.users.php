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
	
	public function user_profile($id){
		$sql = "SELECT * FROM tbl_users WHERE usr_id='$id'";
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_array($result)){
			$list[] = $row;
		}
		if(!empty($list)){
			return $list;
		}
	}

	public function new_user($username,$password,$fname,$lname,$email,$contact){
	$sql = "SELECT * FROM tbl_users WHERE usr_username = '$username'";
	$check=$this->db->query($sql);
	$count_row = $check->num_rows;
		if($count_row == 0){
			$newpassword = md5($password);
			$sql = "INSERT INTO tbl_users(usr_username,usr_password,usr_firstname,usr_lastname,usr_email,usr_contact) VALUES('$username','$newpassword','$fname','$lname','$email','$contact')";
			$result = mysqli_query($this->db,$sql) or die(mysqli_error() . "Cannot Insert Data");
			return $result;
		}else{
			$result = 0;
			return $result;
		}
	}

	public function get_name($id){
		$sql = "SELECT usr_firstname,usr_lastname FROM tbl_users WHERE usr_id='$id'";
		$result = mysqli_query($this->db,$sql);
		$row = mysqli_fetch_assoc($result);
		$value = $row['usr_firstname']." ".$row['usr_lastname'];
		return $value;
	}

	public function check_login($username,$password){
		$sql = "SELECT * FROM tbl_users WHERE 
		usr_username='$username' AND usr_password='$password'";
		$result=mysqli_query($this->db,$sql);
		$userdata=mysqli_fetch_array($result);
		$count = $result->num_rows;
		if($count == 1){
			$_SESSION['login']=true;
            $_SESSION['access']=$userdata['acc_id'];
            $_SESSION['userid']=$userdata['usr_id'];
            $_SESSION['current_user']=$userdata['usr_username'];
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