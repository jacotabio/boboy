<?php
class Order{
	public $db;
	
	public function __construct(){
		$this->db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		if(mysqli_connect_errno()){
			echo "Database connection error.";
			exit;
		}
	}

	public function new_table($tablecode){
		$sql = "INSERT INTO tbl_table (tab_code) VALUES ('$tablecode')";
		$result = mysqli_query($this->db,$sql) or die(mysqli_error() . "Cannot Insert Data");
		return result;
	}
	
	public function new_orderstatus($orderstatus){
		$sql = "INSERT INTO tbl_ostatus (ost_name) VALUES ('$orderstatus')";
		$result = mysqli_query($this->db,$sql) or die(mysqli_error() . "Cannot Insert Data");
		return result;
	}
}