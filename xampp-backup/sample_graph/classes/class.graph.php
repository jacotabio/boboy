<?php
class Graph{
	public $db;
	
	public function __construct(){
		$this->db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		if(mysqli_connect_errno()){
			echo "Database connection error.";
			exit;
		}
	}
	
	public function get_clients(){
		$sql = "SELECT * from tbl_client";
		
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_assoc($result)){
			$list[] = $row;
		}
		return $list;
	}

	public function get_json_clients(){
		$sql = "SELECT area_name, tbl_area.area_id, tbl_client.area_id, COUNT(client_id) AS total_client from tbl_client, tbl_area WHERE tbl_client.area_id=tbl_area.area_id GROUP BY tbl_area.area_id";
		
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_assoc($result)){
			$list[] = $row;
		}
		return $list;
	}
}