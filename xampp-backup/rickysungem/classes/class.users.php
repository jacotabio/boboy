<?php
class Users{
	public $db;

	public function __construct(){
		$this->db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		if(mysqli_connect_errno()){
			echo "Database connection error.";
			exit;
		}
	}
	public function get_users(){
		$sql = "SELECT * FROM tbl_users";
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_assoc($result)){
			$list[] = $row;
		}
		return $list;
	}
	
	public function get_area(){
		$sql = "SELECT * FROM tbl_area";
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_assoc($result)){
			$list[] = $row;
		}
		return $list;
	}

	public function get_paylist($id){
		$sql = "SELECT *, tbl_invoice.total_amount FROM tbl_invoice,tbl_ord_invoice,tbl_order WHERE tbl_invoice.invoice_id = tbl_ord_invoice.invoice_id AND tbl_ord_invoice.order_id = tbl_order.order_id AND tbl_order.client_id = '$id'";
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_assoc($result)){
			$list[] = $row;
		}
		return $list;
	}

	public function get_order_history($id){
		$sql = "SELECT * FROM tbl_order WHERE client_id = '$id'";
		$result = mysqli_query($this->db,$sql);
		while($row=mysqli_fetch_array($result)){
			$list[] = $row;
		}
		if(!empty($list)){
			return $list;
		}
	}

	public function get_order_details($id){
		$sql = "SELECT *, pro_brand, pro_generic, pro_formulation, pro_packaging FROM tbl_orditem,tbl_product WHERE tbl_orditem.pro_id = tbl_product.pro_id AND order_id = '$id'";
		$result = mysqli_query($this->db,$sql);
		while($row=mysqli_fetch_array($result)){
			$list[] = $row;
		}
		if(!empty($list)){
			return $list;
		}
	}
	public function get_client($id){
		$sql = "SELECT client_id FROM tbl_client WHERE usr_id = '$id'";
		$result = mysqli_query($this->db,$sql);
		$row = mysqli_fetch_assoc($result);
		$value = $row['client_id'];
		return $value;
	}
	
	public function get_profile_info($id){
		$sql = "SELECT * from tbl_client where client_id='$id'";
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_assoc($result)){
			$list[] = $row;
		}
		return $list;
	}

	public function get_password($usr_id){
		$sql = "SELECT usr_password FROM tbl_client where client_id = '$usr_id'";
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_assoc($result)){
			$list[] = $row;
		}
		return $list;
	}
	
	public function new_user_request($LtoNumber, $CompanyName, $Address, $ContactNumber, $EmailAddress, $Username, $Password, $areaName, $FirstName, $LastName){
	$sql = "SELECT * FROM tbl_client WHERE lto_no = '$LtoNumber'";
	$check=$this->db->query($sql);
	$count_row = $check->num_rows;
		if($count_row == 0){
			$newpassword = md5($Password);
			$sql = "INSERT INTO tbl_requests(lto_no, name, address, contact_no, email, area_id, username, password, date_requested, time_requested, usr_FName, usr_LName)
			VALUES('$LtoNumber', '$CompanyName', '$Address', '$ContactNumber', '$EmailAddress', '$areaName', '$Username', '$newpassword', NOW(), NOW(), '$FirstName', '$LastName')";

			$result = mysqli_query($this->db,$sql) or die(mysqli_error() . "Cannot Insert Data");
			return $result;
		}else{
			return false;
		}
	}

	public function check_login($username,$password){
		$sql = "SELECT * FROM tbl_client WHERE
		usr_username='$username' AND usr_password='$password'";
		$result=mysqli_query($this->db,$sql);
		$userdata=mysqli_fetch_array($result);
		$count = $result->num_rows;
		if($count == 1){
			$_SESSION['c_login']=true;
            $_SESSION['c_userid']=$userdata['client_id'];
            $_SESSION['c_username']=$userdata['usr_username'];
            $_SESSION['c_userfullname']=$userdata['usr_firstname'] . " " . $userdata['usr_lastname'];

            $uid = $_SESSION['c_userid'];
            $sql2 = "SELECT client_id FROM tbl_client WHERE usr_id = '$uid'";
            $result2 = mysqli_query($this->db,$sql2);
            $value = mysqli_fetch_assoc($result2);
            $_SESSION['clientid'] = $value['client_id'];
			return true;
		}
		else{
			return false;
		}
	}


	public function get_session(){
		if(isset($_SESSION['c_login']) && $_SESSION['c_login'] == true){
			return true;
		}
		else{
			return false;
		}
	}
	
	public function edit_prof($name, $address, $contact, $email, $usr_id){
		$sql = "UPDATE tbl_client SET client_name='$name', address='$address', contact_no='$contact', email='$email' WHERE client_id='$usr_id'";
		$result = mysqli_query($this->db,$sql) or die(mysqli_error() . "Cannot Insert Data");
		return $result;
	
	}


	
	public function new_pssword($new_confirmed_pass, $usr_id){
		$sql = "UPDATE tbl_client SET usr_password='$new_confirmed_pass' WHERE client_id='$usr_id'";
		$result = mysqli_query($this->db,$sql) or die(mysqli_error() . "Cannot Insert Data");
		return $results;	
	}

	public function get_sli($id){
		$sql = "SELECT tbl_lot.expiry_date AS expiry,tbl_lot.lot_number AS lotno, tbl_product.pro_brand AS brand,tbl_product.pro_generic AS generic,tbl_product.pro_formulation AS formu,tbl_product.pro_packaging AS pack,tbl_orditem.order_id FROM tbl_lot,tbl_product,tbl_order,tbl_orditem WHERE tbl_order.order_id = tbl_orditem.order_id AND tbl_product.pro_id = tbl_orditem.pro_id AND tbl_order.client_id = '$id' AND tbl_orditem.qty_remaining > 0 AND tbl_lot.lot_id = tbl_orditem.lot_id GROUP BY tbl_orditem.lot_id";
		$result = mysqli_query($this->db,$sql);
		while($row=mysqli_fetch_array($result)){
			$list[] = $row;
		}
		if(!empty($list)){
			return $list;
		}
	}
}
