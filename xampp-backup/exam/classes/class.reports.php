<?php
class Reports{
	public $db;

	public function __construct(){
		$this->db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		if(mysqli_connect_errno()){
			echo "Database connection error.";
			exit;
		}
	}

	public function getUserAccess(){
		$sql = "";
	}

	public function getTotalIn($p_id,$dateTo,$dateFrom){
		if($dateTo=='' && $dateFrom==''){
				$sql = "SELECT SUM(p_quantity) as totalIN FROM tbl_receiveitems where p_id='$p_id'";
			}
			else{
				$sql = "SELECT SUM(p_quantity) as totalIN FROM tbl_receiveitems where p_id='$p_id' AND r_date_received>='$dateFrom' AND r_date_received<='$dateTo'";
			}
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_assoc($result)){
			$list[] = $row;
		}
		return $list;
	}
	public function getTotalOut($p_id,$dateTo,$dateFrom){
		if($dateTo=='' && $dateFrom==''){
				$sql = "SELECT SUM(p_quantity) as totalOut FROM tbl_purchaseorder where p_id='$p_id'";
			}
			else{
				$sql = "SELECT SUM(p_quantity) as totalOut FROM tbl_purchaseorder where p_id='$p_id' AND po_date_purchased>='$dateFrom' AND po_date_purchased<='$dateTo'";
			}
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_assoc($result)){
			$list[] = $row;
		}
		return $list;
	}
	public function generate_report($subsub,$dateTo,$dateFrom){
		switch($subsub){
			case 'products':
				$sql = "SELECT * FROM tbl_products order by p_name ASC";
			break;
			case 'receive':
			if($dateTo=='' && $dateFrom==''){
				$sql = "SELECT * FROM tbl_receiveitems order by r_date_received ASC";
			}
			else{
				$sql = "SELECT * FROM tbl_receiveitems where r_date_received>='$dateFrom' AND r_date_received<='$dateTo' ORDER BY r_date_received ASC";
			}
			break;
			case 'purchase':
			if($dateTo=='' && $dateFrom==''){
				$sql = "SELECT * FROM tbl_purchaseorder order by po_date_purchased ASC";
			}
			else{
				$sql = "SELECT * FROM tbl_purchaseorder where po_date_purchased>='$dateFrom' AND po_date_purchased<='$dateTo' ORDER BY po_date_purchased ASC";
			}
			break;
		}
		
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_assoc($result)){
			$list[] = $row;
		}
		if(!empty($list)){
			return $list;
		}
	}
}	