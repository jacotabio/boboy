<?php
class Table{
	public $db;
	
	public function __construct(){
		$this->db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		if(mysqli_connect_errno()){
			echo "Database connection error.";
			exit;
		}
	}
	
	public function get_tables(){
		$sql = "SELECT * FROM tbl_table";
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_assoc($result)){
			$list[] = $row;
		}
		return $list;
	}
    public function get_name($id){
		$sql = "SELECT tab_code FROM tbl_table WHERE tab_id='$id'";
		$result=mysqli_query($this->db,$sql);
		$row=mysqli_fetch_assoc($result);
		$value = $row['tab_code'];
		return $value;
	}
    public function get_status($id){
		$sql = "SELECT ost_id FROM tbl_table WHERE tab_id='$id'";
		$result=mysqli_query($this->db,$sql);
		$row=mysqli_fetch_assoc($result);
		$value = $row['ost_id'];
		return $value;
	}
    public function get_server($id){
		$sql = "SELECT usr_id FROM tbl_table WHERE tab_id='$id'";
		$result=mysqli_query($this->db,$sql);
		$row=mysqli_fetch_assoc($result);
		$value = $row['usr_id'];
		return $value;
	}
    public function set_server($tid,$userid){
		$sql="UPDATE tbl_table SET usr_id='$userid' WHERE tab_id='$tid'";
            $result=mysqli_query($this->db,$sql);
            return;
	}
    public function set_status($tid,$stat){
		$sql="UPDATE tbl_table SET ost_id='$stat' WHERE tab_id='$tid'";
            $result=mysqli_query($this->db,$sql);
            return;
	}
    public function get_statusname($id){
		$sql = "SELECT ost_name FROM tbl_ostatus WHERE ost_id='$id'";
		$result=mysqli_query($this->db,$sql);
		$row=mysqli_fetch_assoc($result);
		$value = $row['ost_name'];
		return $value;
	}
	
}