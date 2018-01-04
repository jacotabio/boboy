<?php
class Products{
	public $db;

	public function __construct(){
		$this->db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		if(mysqli_connect_errno()){
			echo "Database connection error.";
			exit;
		}
	}
	public function get_products(){
		$sql = "SELECT * FROM tbl_products ORDER BY p_name ASC";
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_assoc($result)){
			$list[] = $row;
		}
		if(!empty($list)){
			return $list;	
		}
	}
	// ADD PRODUCTS
	public function new_product($product_name,$product_desc,$quantity,$price){
		$sql = "INSERT INTO tbl_products (p_name,p_description,p_quantity,p_price,p_date_added,p_time_added)
				VALUES ('$product_name','$product_desc','$quantity','$price',NOW(),NOW())";
		$result = mysqli_query($this->db,$sql) or die(mysqli_error() . "Cannot Insert Data");
			return $result;
	}
	//SELECT SPECIFIC PRODUCT
	public function select_product($prodID){
		$sql = "SELECT * FROM tbl_products where p_id=$prodID";
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_assoc($result)){
			$list[] = $row;
		}
		return $list;
	}
	//SELECT LAST Record
	public function prod_last(){
		$sql = "SELECT * FROM tbl_products ORDER BY p_id DESC LIMIT 1";
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_assoc($result)){
			$list[] = $row;
		}
		return $list;
	}
	
	//SEARCH PRODUCTS
	public function search_product($searchvalue){
		$sql = "SELECT * FROM tbl_products where p_name like '%$searchvalue%' OR p_description like '%$searchvalue%'";
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_assoc($result)){
			$list[] = $row;
		}
		if(!empty($list)) {
			return $list;
		}
	}
	// EDIT PRODUCTS
	public function update_product($prodID,$prodName,$prodDesc,$prodQty,$prodPrice){
		$sql = "UPDATE tbl_products SET p_name='$prodName',p_description='$prodDesc',p_quantity='$prodQty',p_price='$prodPrice',p_date_modified=NOW(),
		p_time_modified=NOW() where p_id='$prodID'";
		$res = mysqli_query($this->db,$sql) or die(mysqli_error() . "Cannot Update Record");
		return $res;
	}
	
	//DELETE PRODUCT
	public function delete_product($prodID){
		$sql = "DELETE FROM tbl_products where p_id=$prodID";
		$res = mysqli_query($this->db,$sql);
		return $res;
	}
	//ADD QUANTITY
	public function add_quantity($prodID, $quantity){
		$sql = "UPDATE tbl_products SET p_quantity=p_quantity+'$quantity' where p_id='$prodID'";
		$res = mysqli_query($this->db,$sql) or die(mysqli_error() . "Cannot Add Quantity");
		return $res;
	}
}