<?php
class Settings{
	public $db;
	
	public function __construct(){
		$this->db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		if(mysqli_connect_errno()){
			echo "Database connection error.";
			exit;
		}
	}

	public function get_access(){
		$sql = "SELECT * FROM tbl_access";
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_assoc($result)){
			$list[] = $row;
		}
		return $list;
	}

	public function get_settings(){
		$sql = "SELECT * FROM tbl_settings";
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_assoc($result)){
			$list[] = $row;
		}
		if(!empty($list)){
			return $list;
		}	
	}
	
	public function set_settings($companyname,$address,$version,$copyright){
		$sql = "SELECT * FROM tbl_settings";
		$check=$this->db->query($sql);
		$count_row = $check->num_rows;
		if($count_row == 0){
			$sql = "INSERT INTO tbl_settings (set_name,set_address,set_version,set_copyright) VALUES('$companyname','$address','$version','$copyright')";
			$result = mysqli_query($this->db,$sql) or die(mysqli_error() . "Cannot Insert Data");
			return $result;
			exit;
		}
		else{
			$sql = "UPDATE tbl_settings SET set_name = '$companyname',set_address = '$address',set_version = '$version',set_copyright = '$copyright'";
			$result = mysqli_query($this->db,$sql) or die(mysqli_error() . "Cannot Update Data");
			return $result;
			exit;
		}
	}
}