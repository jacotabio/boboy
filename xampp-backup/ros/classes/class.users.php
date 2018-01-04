<?php
class Users{
	public $db;
	
	public function __construct(){
		$this->db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		if(mysqli_connect_errno()){
			echo "Error: Could connect to Database.";
			exit;
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
	public function get_user($id){
		$sql = "SELECT usr_id FROM tbl_users WHERE usr_userid = '$id'";
		$result = mysqli_query($this->db,$sql);
		$row=mysqli_fetch_assoc($result);
		$usrid = $row['usr_id'];
		return $usrid;
	}
	
	public function check_login($username,$password){
		$sql = "SELECT * FROM tbl_user WHERE 
		user_name='$username' AND user_pswd='$password' AND user_stat=1";
		$result=mysqli_query($this->db,$sql);
		$userdata=mysqli_fetch_array($result);
		$count = $result->num_rows;
		if($count == 1){
			$_SESSION['login']=true;
            $_SESSION['access']=$userdata['utype_id'];
            $_SESSION['userid']=$userdata['user_id'];
			$_SESSION['userdata']= $userdata['user_lname'].','.$userdata['user_fname'];
			return true;
		}
		else{
			return false;
		}
	}
    public function start_login($username){
		$sql = "SELECT * FROM tbl_users WHERE 
		usr_userid='$username' AND usr_stat=1";
		$result=mysqli_query($this->db,$sql);
		$userdata=mysqli_fetch_array($result);
		$count = $result->num_rows;
		if($count == 1){
			return true;
		}
		else{
			return false;
		}
	}
    public function get_username($id){
		$sql = "SELECT usr_firstname, usr_lastname FROM tbl_users WHERE usr_id='$id'";
		$result=mysqli_query($this->db,$sql);
		$row=mysqli_fetch_assoc($result);
		$value = $row['usr_lastname'].' '.$row['usr_firstname'];
		return $value;
	}
}