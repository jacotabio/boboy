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
	
	public function check_admin_login($username, $password){
		$sql = "SELECT * FROM tbl_users WHERE usr_username='$username' AND usr_password='$password'";
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
         public function check_medrep_login($username, $password){
		$sql = "SELECT * FROM tbl_medrep WHERE mr_username='$username' AND mr_password='$password'";
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

	public function get_admin_info($username, $password){
		$sql = "SELECT * FROM tbl_users WHERE usr_username='$username' AND usr_password='$password'";
		$result=mysqli_query($this->db,$sql);
		$row = mysqli_fetch_assoc($result);
		return $row;
	}

        public function get_medrep_info($username, $password){
		$sql = "SELECT * FROM tbl_medrep WHERE mr_username='$username' AND mr_password='$password'";
		$result=mysqli_query($this->db,$sql);
		$row = mysqli_fetch_assoc($result);
		return $row;
	}

}