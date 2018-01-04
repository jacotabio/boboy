<?php
class Food{
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
	
	public function get_name($pty_id){
		$sql = "SELECT * FROM tbl_ptype WHERE pty_id = $pty_id";
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_assoc($result)){
			$list[] = $row;
		}
		if(!empty($list)){
			return $list;
		}
	}

	public function get_all_foodtype(){
		$sql = "SELECT * FROM tbl_ptype";
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_assoc($result)){
			$list[] = $row;
		}
		if(!empty($list)){
			return $list;
		}
	}
	
	public function get_profile($id){
		$sql = "SELECT * FROM tbl_product WHERE pro_id = '$id'";
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_array($result)){
			$list[] = $row;
		}
		if(!empty($list)){
			return $list;
		}
	}
	public function food_listings(){
		$sql = "SELECT pro_id, pro_name, pro_price, pty_name FROM tbl_product INNER JOIN tbl_ptype ON tbl_product.pty_id = tbl_ptype.pty_id";
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_assoc($result)){
			$list[] = $row;
		}
		if(!empty($list)){
			return $list;
		}
	}

	public function assign_ing($ing_id,$pro_id,$ing_qty){
		$sql = "INSERT INTO tbl_recipe(ing_id,pro_id,rec_qty) VALUES('$ing_id','$pro_id','$ing_qty')";
		$result = mysqli_query($this->db,$sql) or die(mysqli_error() . "Cannot Insert Data");
		return $result;
	}

	public function delete_ing($id){
		$sql = "DELETE FROM tbl_recipe WHERE rec_id='$id'";
		$result = mysqli_query($this->db,$sql) or die(mysqli_error() . "Cannot Delete Data");
		return $result;
	}

	public function new_food($pro_name,$pro_desc,$pro_type,$pro_price){
		$sql = "SELECT * FROM tbl_product WHERE pro_name = '$pro_name'";
		$check=$this->db->query($sql);
		$count_row = $check->num_rows;
		if($count_row == 0){
			$newpassword = md5($password);
			$sql = "INSERT INTO tbl_product (pro_name,pro_desc,pro_price,pty_id) VALUES('$pro_name','$pro_desc',$pro_price,$pro_type)";
			$result = mysqli_query($this->db,$sql) or die(mysqli_error() . "Cannot Insert Data");
			return $result;
		}else{
			return false;
		}
	}

	public function new_type($pro_type){
		$sql = "SELECT * FROM tbl_ptype WHERE pty_name = '$pro_type'";
		$check=$this->db->query($sql);
		$count_row = $check->num_rows;
		if($count_row == 0){
			$sql = "INSERT INTO tbl_ptype (pty_name) VALUES('$pro_type')";
			$result = mysqli_query($this->db,$sql) or die(mysqli_error() . "Cannot Insert Data");
			return $result;
		}else{
			return false;
		}		
	}
}