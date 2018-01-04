<?php
class Inventory{
	public $db;
	
	public function __construct(){
		$this->db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		if(mysqli_connect_errno()){
			echo "Database connection error.";
			exit;
		}
	}

	public function new_ingredient($ing_name,$ing_qty,$ing_unit){
		$sql = "INSERT INTO tbl_ingredient (ing_name,ing_qty,unt_id) VALUES('$ing_name','$ing_qty','$ing_unit')";
		$result = mysqli_query($this->db,$sql) or die(mysqli_error() . "Cannot Insert Data");
		return $result;
	}

	public function new_unit($unt_name,$unt_symbol){
		$sql = "INSERT INTO tbl_unit (unt_name,unt_symbol) VALUES('$unt_name','$unt_symbol')";
		$result = mysqli_query($this->db,$sql) or die(mysqli_error() . "Cannot Insert Data");
		return $result;
	}

	public function get_units(){
		$sql = "SELECT * FROM tbl_unit";
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_array($result)){
			$list[] = $row;
		}
		if(!empty($list)){
			return $list;
		}
	}

	public function get_ingredients(){
		$sql = "SELECT * FROM tbl_ingredient";
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_array($result)){
			$list[] = $row;
		}
		if(!empty($list)){
			return $list;
		}
	}

	public function get_ing_name($id){
		$sql = "SELECT ing_name FROM tbl_ingredient WHERE ing_id='$id'";
		$result = mysqli_query($this->db,$sql);
		$row = mysqli_fetch_assoc($result);
		$value = $row['ing_name'];
		return $value;
	}

	public function get_recipe($id){
		$sql = "SELECT rec_id,ing_name,tbl_recipe.ing_id,tbl_ingredient.ing_id,unt_id,rec_qty FROM tbl_ingredient,tbl_recipe WHERE tbl_recipe.ing_id=tbl_ingredient.ing_id AND pro_id='$id' ORDER BY rec_id ASC";
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_array($result)){
			$list[] = $row;
		}
		if(!empty($list)){
			return $list;
		}
	}

	public function get_unit_details($id){
		$sql = "SELECT unt_name,unt_symbol FROM tbl_unit WHERE unt_id = '$id'";
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_array($result)){
			$list[] = $row;
		}
		return $list;
	}

	public function get_unit_symbol($id){
		$sql = "SELECT unt_symbol FROM tbl_unit WHERE unt_id = '$id'";
		$result = mysqli_query($this->db,$sql);
		$row = mysqli_fetch_assoc($result);
		$value = $row['unt_symbol'];
		return $value;
	}

	public function get_per_unit($id){
		$sql = "SELECT unt_symbol FROM tbl_unit WHERE unt_id = '$id'";
		$result = mysqli_query($this->db,$sql);
		$row = mysqli_fetch_assoc($result);
		$value = $row['unt_symbol'];
		return $value;
	}
}