<?php
class Delivery{
	public $db;
	
	public function __construct(){
		$this->db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		if(mysqli_connect_errno()){
			echo "Database connection error.";
			exit;
		}
	}
	
	public function get_delivery($medrep_id){
		$sql = "SELECT tbl_client.client_id, client_name, address, delivery_id, tbl_delivery.order_id, tbl_order.order_id, tbl_order.client_id, tbl_client.medrep_id FROM tbl_client, tbl_order, tbl_delivery WHERE tbl_delivery.order_id=tbl_order.order_id AND tbl_order.client_id=tbl_client.client_id AND tbl_delivery.medrep_id='$medrep_id' AND delivery_status='0'";
		$result=mysqli_query($this->db,$sql);
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
		$result=mysqli_query($this->db,$sql);
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