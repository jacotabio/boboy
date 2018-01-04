<?php
class Sales{
	public $db;
	
	public function __construct(){
		$this->db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		if(mysqli_connect_errno()){
			echo "Database connection error.";
			exit;
		}
	}

	public function get_daily($id){
		$sql = "SELECT * FROM tbl_order WHERE ord_date_added = '$id'";
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_array($result)){
			$list[] = $row;
		}
		if(!empty($list)){
			return $list;
		}
	}
	
	public function get_table($id){
		$sql = "SELECT tab_code FROM tbl_table WHERE tab_id='$id'";
		$result=mysqli_query($this->db,$sql);
		$row=mysqli_fetch_assoc($result);
		$value = $row['tab_code'];
		return $value;
	}
	
	public function get_server_total(){
		$sql = "SELECT * FROM tbl_users";
		$result=mysqli_query($this->db,$sql);
		while($row=mysqli_fetch_array($result)){
			$list[] = $row;
		}
		return $list;
	}
	
	public function get_table_total(){
		$sql = "SELECT * FROM tbl_table";
		$result=mysqli_query($this->db,$sql);
		while($row=mysqli_fetch_array($result)){
			$list[] = $row;
		}
		return $list;
	}
	
	public function get_nbr_total(){
		$date = date('Y-m-d');
		$sql = "SELECT SUM(ord_items) AS total FROM tbl_order WHERE ord_date_added=CURDATE()";
		$result=mysqli_query($this->db,$sql);
		$row = mysqli_fetch_assoc($result);
		$value = $row['total'];
		return $value;
	}
	
	public function get_server_sales($id){
		$sql = "SELECT SUM(ord_amount) AS total FROM tbl_order WHERE usr_id='$id' AND ord_date_added=CURDATE()";
		$result = mysqli_query($this->db,$sql);
		$row = mysqli_fetch_assoc($result);
		$value = $row['total'];
		return $value;
	}
	
	public function get_table_sales($id){
		$sql = "SELECT SUM(ord_amount) AS total FROM tbl_order WHERE tab_id='$id' AND ord_date_added=CURDATE()";
		$result = mysqli_query($this->db,$sql);
		$row = mysqli_fetch_assoc($result);
		$value = $row['total'];
		return $value;
	}
	
	public function get_name($id){
		$sql = "SELECT usr_firstname, usr_lastname FROM tbl_users WHERE usr_id='$id'";
		$result=mysqli_query($this->db,$sql);
		$row=mysqli_fetch_assoc($result);
		$value = $row['usr_firstname'].' '.$row['usr_lastname'];
		return $value;
	}
	
}