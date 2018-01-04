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

	public function check_login($email,$password){
		$sql = "SELECT * FROM tbl_users WHERE 
		user_email='$email' AND user_password='$password'";
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

	public function get_user_id($email,$password){
		$sql = "SELECT user_id FROM tbl_users WHERE 
		user_email='$email' AND user_password='$password'";
		$result = mysqli_query($this->db,$sql);
		$row = mysqli_fetch_assoc($result);
		$value = $row['user_id'];
		return $value;
	}

	public function new_user($email,$password){
	$sql = "SELECT * FROM tbl_users WHERE user_email = '$email'";
	$check=$this->db->query($sql);
	$count_row = $check->num_rows;
		if($count_row == 0){
			$newpassword = md5($password);
			$sql = "INSERT INTO tbl_users(user_email,user_password) VALUES('$email','$newpassword')";
			$result = mysqli_query($this->db,$sql) or die(mysqli_error() . "Cannot Insert Data");
			return $result;
		}else{
			$result = 0;
			return $result;
		}
	}

	public function new_budget($budget, $amount,$id){
		$sql = "INSERT INTO tbl_budget(b_title,b_amount,b_date_created,b_time_created,user_id) VALUES('$budget','$amount',NOW(),NOW(),'$id')";
		$result = mysqli_query($this->db,$sql) or die(mysqli_error() . "Cannot Insert Data");
		return $result;
	}

	public function delete_budget($id){
		$sql = "DELETE FROM tbl_budget WHERE b_id = '$id'";
		$result = mysqli_query($this->db,$sql) or die(mysqli_error(). "Cannot Delete Data");
		return $result;
	}

	public function new_detail($name, $cost){
		$sql = "INSERT INTO tbl_details(d_name,d_cost) VALUES('$name','$cost')";
		$result = mysqli_query($this->db,$sql) or die(mysqli_error() . "Cannot Insert Data");
		return $result;
	}

	public function retrieve_records($id){
		$sql = "SELECT * FROM tbl_budget WHERE user_id='$id'";
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_assoc($result)){
			$list[] = $row;
		}
		return $list;
	}
}