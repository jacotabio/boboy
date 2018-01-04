<?php
class Transactions{
	public $db;

	public function __construct(){
		$this->db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		if(mysqli_connect_errno()){
			echo "Database connection error.";
			exit;
		}
	}

	//RECEIVE ITEMS TABLE
	public function insert_receive($prodID,$pName,$pDesc,$quantity,$pPrice){
		$sql = "INSERT INTO tbl_receiveitems(p_id,p_name,p_description,p_quantity,p_price,r_date_received,r_time_received) 
				VALUES('$prodID','$pName','$pDesc','$quantity','$pPrice',NOW(),NOW())";
		$res = mysqli_query($this->db,$sql) or die(mysqli_error() . "Cannot Add Quantity");
		return $res;
	}
	
	//PURCHASE
	public function purchase($prodID, $quantity){
		$sql = "UPDATE tbl_products SET p_quantity=p_quantity-'$quantity' where p_id='$prodID'";
		$res = mysqli_query($this->db,$sql) or die(mysqli_error() . "Cannot Add Quantity");
		return $res;
	}
	//PURCHASE ORDER TABLE
	public function insertPO($po_id, $prodID, $prodName, $prodQty, $prodPrice, $subtotal){
		$sql = "INSERT INTO tbl_purchaseorder(po_id,p_id,p_name,p_quantity,p_price,p_subtotal,po_date_purchased,p_time_purchased) VALUES ('$po_id','$prodID','$prodName','$prodQty','$prodPrice','$subtotal',NOW(),NOW())";
		$res = mysqli_query($this->db,$sql) or die(mysqli_error() . "Cannot Insert Purchase");
		return $res;
	}
	
	//Purchase Order Number
	public function po_number(){
		$sql = "SELECT * FROM tbl_purchaseorder order by po_id DESC limit 1";
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_assoc($result)){
			$list[] = $row;
		}
		if(!empty($list)){
			return $list;
		}
	}
}