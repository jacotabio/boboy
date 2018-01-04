<?php
class Donations{
	public $db;

	public function __construct(){
		$this->db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		if(mysqli_connect_errno()){
			echo "Database connection error.";
			exit;
		}
	}

	public function get_dtype(){
		$sql = "SELECT * FROM tbl_dtype";
		$result = mysqli_query($this->db,$sql);
		while($row=mysqli_fetch_array($result)){
			$list[] = $row;
		}
		if(!empty($list)){
			return $list;
		}
	}



	public function get_access(){
		$sql = "SELECT * FROM tbl_access";
		$result = mysqli_query($this->db,$sql);
		while($row=mysqli_fetch_array($result)){
			$list[] = $row;
		}
		return $list;
	}

	public function get_sponsors(){
		$sql="SELECT * FROM tbl_sponsor ORDER BY sponsor_lastname ASC";
		$result = mysqli_query($this->db,$sql);
		while($row=mysqli_fetch_array($result)){
			$list[] = $row;
		}
		if(!empty($list)){
			return $list;
		}
	}

	public function get_donations(){
		$sql="SELECT * FROM tbl_donation ORDER BY don_date_added DESC, don_time_added DESC";
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_array($result)){
			$list[] = $row;
		}
		if(!empty($list)){
			return $list;
		}
	}

	public function search_donors($searchvalue){
		$sql = "SELECT * FROM tbl_sponsor WHERE sponsor_firstname like '%$searchvalue%'";
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_assoc($result)){
			$list[] = $row;
		}
		if(!empty($list)) {
			return $list;
		}
	}

	public function search_donations($searchvalue){
		$sql = "SELECT * FROM tbl_donation WHERE don_title like '%$searchvalue%' OR don_date_added like '%$searchvalue%'";
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_assoc($result)){
			$list[] = $row;
		}
		if(!empty($list)) {
			return $list;
		}
	}

	public function search_donations_item($searchvalue){
		$sql = "SELECT * FROM tbl_donation WHERE don_title like '%$searchvalue%' OR don_date_added like '%$searchvalue%'";
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_assoc($result)){
			$list[] = $row;
		}
		if(!empty($list)) {
			return $list;
		}
	}

	public function count_donations(){
		$sql = "SELECT * FROM tbl_donation";
		$check=$this->db->query($sql);
		$count_row = $check->num_rows;
		return $count_row;
	}

	public function count_donations_cash(){
		$sql = "SELECT * FROM tbl_donation WHERE dtype_id = 302";
		$check=$this->db->query($sql);
		$count_row = $check->num_rows;
		return $count_row;
	}

	public function count_donations_item(){
		$sql = "SELECT * FROM tbl_donation WHERE dtype_id = 301";
		$check=$this->db->query($sql);
		$count_row = $check->num_rows;
		return $count_row;
	}

	public function get_donations_item(){
		$sql="SELECT * FROM tbl_donation WHERE dtype_id = 301";
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_array($result)){
			$list[] = $row;
		}
		if(!empty($list)){
			return $list;
		}
	}

	public function get_donations_cash(){
		$sql="SELECT * FROM tbl_donation WHERE dtype_id = 302";
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_array($result)){
			$list[] = $row;
		}
		if(!empty($list)){
			return $list;
		}
	}

	public function get_total_cash(){
		$sql = "SELECT SUM(don_amount) AS tsum FROM tbl_donation";
		$result = mysqli_query($this->db,$sql);
		$row = mysqli_fetch_assoc($result);
		$sum = $row['tsum'];
		return $sum;
	}
	public function select_sponsor($sID){
		$sql="SELECT * FROM tbl_sponsor WHERE sponsor_userid = $sID";
		$check=$this->db->query($sql);
		$count_row = $check->num_rows;
		if($count_row == 0){
			return false;
		}else{
			$result = mysqli_query($this->db,$sql);
			while($row=mysqli_fetch_array($result)){
				$list[] = $row;
			}
			if(!empty($list)){
				return $list;
			}
		}
	}

	public function select_sponsor_name($sponsor_userid){
		$sql="SELECT * FROM tbl_sponsor WHERE sponsor_userid = $sponsor_userid";
		$check=$this->db->query($sql);
		$count_row = $check->num_rows;
		if($count_row == 0){
			return false;
		}else{
			$result = mysqli_query($this->db,$sql);
			while($row=mysqli_fetch_array($result)){
				$list[] = $row;
			}
			if(!empty($list)){
				return $list;
			}
		}
	}

	public function select_donation($dID){
		$sql = "SELECT * FROM tbl_donation WHERE don_id = $dID";
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_array($result)){
			$list[] = $row;
		}
		if(!empty($list)){
			return $list;
		}
	}

	public function select_sponsor_donation($sID){
		$sql="SELECT * FROM tbl_donation WHERE sponsor_userid = $sID";
		$check=$this->db->query($sql);
		$count_row = $check->num_rows;
		if($count_row == 0){
			return false;
		}else{
			$result = mysqli_query($this->db,$sql);
			while($row=mysqli_fetch_array($result)){
				$list[] = $row;
			}
			if(!empty($list)){
				return $list;
			}
		}
	}

	public function select_dtype_name($dtype_id){
		$sql="SELECT dtype_name FROM tbl_dtype WHERE dtype_id = $dtype_id";
		$result = mysqli_query($this->db,$sql);
		$row=mysqli_fetch_assoc($result);
		echo $row['dtype_name'];

	}
	public function new_sponsor($s_userid,$firstname,$lastname){
		$sql="SELECT * FROM tbl_sponsor WHERE sponsor_userid = '$s_userid'";
		$check=$this->db->query($sql);
		$count_row = $check->num_rows;
		if($count_row == 0){
			$_firstname = mysqli_real_escape_string(mysqli_connect(),$firstname);
			$_lastname = mysqli_real_escape_string(mysqli_connect(),$lastname);
			$sql="INSERT INTO tbl_sponsor (sponsor_userid,sponsor_firstname,sponsor_lastname) VALUES('$s_userid','$_firstname','$_lastname')";
			$result = mysqli_query($this->db,$sql) or die(mysqli_error() . "Cannot Insert Data");
			return $result;
		}else{
			return false;
		}
	}

	public function new_donation_cash($title,$sponsorid,$description,$amount,$dtype){
		$_title = mysqli_real_escape_string(mysqli_connect(),$title);
		$_description = mysqli_real_escape_string(mysqli_connect(),$description);
		$sql="INSERT INTO tbl_donation (don_title,don_description,don_amount,don_date_added,don_time_added,sponsor_userid,dtype_id) 
								 VALUES ('$_title','$_description',$amount,NOW(),NOW(),$sponsorid,$dtype)";
		$result = mysqli_query($this->db,$sql) or die(mysqli_error() . "Cannot Insert Data");
		return $result;
	}

	public function get_balance($sponsorid){
		$sql="SELECT sponsor_balance FROM tbl_sponsor WHERE sponsor_userid = '$sponsorid'";
		$result = mysqli_query($this->db,$sql);
		while($row=mysqli_fetch_array($result)){
			$balance[] = $row;
		}
	}

	public function new_balance($amount,$sponsorid){
		$sql="UPDATE tbl_sponsor SET sponsor_balance = sponsor_balance + $amount WHERE sponsor_userid = '$sponsorid'";
		$result = mysqli_query($this->db,$sql) or die(mysqli_error() . "Cannot Update Data");
		return $result;
	}

	public function new_donation_item($title,$sponsorid,$description,$itemname,$itemqty,$dtype){
		$_title = mysqli_real_escape_string(mysqli_connect(),$title);
		$_description = mysqli_real_escape_string(mysqli_connect(),$description);
		$_itemname = mysqli_real_escape_string(mysqli_connect(),$itemname);
		$sql="INSERT INTO tbl_donation (don_title,don_description,don_item,don_item_qty,don_date_added,don_time_added,sponsor_userid,dtype_id) 
								 VALUES ('$_title','$_description','$_itemname',$itemqty,NOW(),NOW(),$sponsorid,$dtype)";
		$result = mysqli_query($this->db,$sql) or die(mysqli_error() . "Cannot Insert Data");
		return $result;
	}

	public function edit_profile($edit_fname,$edit_lname,$sID){
		$_edit_fname = mysqli_real_escape_string(mysqli_connect(),$edit_fname);
		$_edit_lname = mysqli_real_escape_string(mysqli_connect(),$edit_lname);
		$sql="UPDATE tbl_sponsor SET sponsor_firstname = '$_edit_fname', sponsor_lastname = '$_edit_lname' WHERE sponsor_userid = $sID";
		$result = mysqli_query($this->db,$sql) or die(mysqli_error() . "Cannot Update Data");
		return $result;
	}

	public function delete_profile($sID){
		$sql = "DELETE FROM tbl_donation WHERE sponsor_userid = $sID";
		$result = mysqli_query($this->db,$sql) or die(mysqli_error() . "Cannot Delete Data");
		$sql1 = "DELETE FROM tbl_sponsor WHERE sponsor_userid = $sID";
		$result = mysqli_query($this->db,$sql1) or die(mysqli_error() . "Cannot Delete Data");
		return $result;
	}

	public function edit_donation($dID,$edit_title,$edit_description){
		$_edit_title = mysqli_real_escape_string(mysqli_connect(),$edit_title);
		$_edit_description = mysqli_real_escape_string(mysqli_connect(),$edit_description);
		$sql = "UPDATE tbl_donation SET don_title = '$_edit_title', don_description = '$_edit_description' WHERE don_id = $dID";
		$result = mysqli_query($this->db,$sql) or die(mysqli_error() . "Cannot Update Data");
		return $result;
	}

	public function delete_donation($dID){
		$checker = "SELECT * FROM tbl_donation WHERE don_id = $dID";
		$result = mysqli_query($this->db,$checker);
		while($row = mysqli_fetch_array($result)){
			$list[] = $row;
 		}
 		foreach($list as $value);
 		if($value['dtype_id'] = 302){
 			$old = $value['don_amount'];
 			$id = $value['sponsor_userid'];
 			$update = "UPDATE tbl_sponsor SET sponsor_balance = sponsor_balance - $old WHERE sponsor_userid = $id";
 			$r = mysqli_query($this->db,$update) or die(mysqli_error() . "Cannot Update Data");
			$sql = "DELETE FROM tbl_donation WHERE don_id = $dID";
			$result = mysqli_query($this->db,$sql) or die(mysqli_error() . "Cannot Delete Data");
			return $result;
 		}else{
 			$sql = "DELETE FROM tbl_donation WHERE don_id = $dID";
			$result = mysqli_query($this->db,$sql) or die(mysqli_error() . "Cannot Delete Data");
			return $result;
 		}

		
	}
}