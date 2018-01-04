<?php
class Stocklevel{
	public $db;
	
	public function __construct(){
		$this->db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		if(mysqli_connect_errno()){
			echo "Database connection error.";
			exit;
		}
	}
	
	public function search_stocks($q,$start,$limit){
		$sql = "SELECT * FROM tbl_product WHERE pro_brand like '%$q%' OR pro_generic like '%$q%' LIMIT $start,$limit";
		$result = mysqli_query($this->db,$sql);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_assoc($result)){
				$list[] = $row;
			}
		}else{
			$list = false;
		}
		return $list;
	}
	public function get_current_stocks($start,$limit){
		$sql = "SELECT * FROM tbl_product LIMIT $start,$limit";
		$result = mysqli_query($this->db,$sql);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_assoc($result)){
				$list[] = $row;
			}
		}else{
			$list = false;
		}
		return $list;
	}

	public function count_products(){
		$sql = "SELECT * FROM tbl_product";
		$result = mysqli_query($this->db,$sql);
		$value = mysqli_num_rows($result);
		return $value;
	}

	public function get_client_stock($medrep_id){
		$sql = "SELECT tbl_client.client_id, client_name, tbl_order.order_id,SUM(tbl_orditem.total_remain) AS consign_qty FROM (SELECT client_id, medrep_id, client_name FROM tbl_client where medrep_id='$medrep_id')tbl_client INNER JOIN (SELECT order_id,client_id FROM tbl_order WHERE ordtype_id='11')tbl_order ON tbl_order.client_id=tbl_client.client_id INNER JOIN (SELECT order_id, SUM(qty_remaining) AS total_remain FROM tbl_orditem GROUP BY order_id)tbl_orditem ON tbl_order.order_id=tbl_orditem.order_id ";
		$result = mysqli_query($this->db,$sql);
		if (mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_assoc($result)){
				$list[] = $row;
			}
    }else{
    	$list=false;
    }
    return $list;
	}

public function get_clients(){
		$sql = "SELECT client_id, client_name, address FROM tbl_client ";
		$result = mysqli_query($this->db,$sql);
		if (mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_assoc($result)){
				$list[] = $row;
			}
    }else{
      $list=false;
    }
    return $list;
	}

}