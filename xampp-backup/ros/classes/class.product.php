<?php
class Product{
	public $db;
	
	public function __construct(){
		$this->db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		if(mysqli_connect_errno()){
			echo "Database connection error.";
			exit;
		}
	}
	
	public function get_ptype(){
		$sql = "SELECT * FROM tbl_ptype";
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_assoc($result)){
			$list[] = $row;
		}
		return $list;
	}
    public function get_ptypename($ptyid){
		$sql = "SELECT pty_name FROM tbl_ptype WHERE pty_id='$ptyid'";
		$result=mysqli_query($this->db,$sql);
		$row=mysqli_fetch_assoc($result);
		$value = $row['pty_name'];
		return $value;
	}
    public function get_proname($proid){
		$sql = "SELECT pro_name FROM tbl_product WHERE pro_id='$proid'";
		$result=mysqli_query($this->db,$sql);
		$row=mysqli_fetch_assoc($result);
		$value = $row['pro_name'];
		return $value;
	}
    public function get_productpertype($ptyid){
		$sql = "SELECT * FROM tbl_product WHERE pty_id='$ptyid'";
        $result=mysqli_query($this->db,$sql);
        $count_row=$result->num_rows;
        if($count_row != 0){
		while($row=mysqli_fetch_assoc($result)){
			$list[] = $row;
		}
            return $list;
        }else{
            return false;
        }
	}
}