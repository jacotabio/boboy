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
		while($row=mysqli_fetch_array($result)){
			$list[] = $row;
		}
		return $list;
	}
}