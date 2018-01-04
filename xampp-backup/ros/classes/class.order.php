<?php
class Order{
	public $db;
	
	public function __construct(){
		$this->db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		if(mysqli_connect_errno()){
			echo "Database connection error.";
			exit;
		}
	}
	
	public function set_order($tid,$pid){
		$sql="INSERT INTO tbl_otemp(tab_id,pro_id,ord_qty,ote_remarks) VALUES('$tid','$pid','1','');";
            $result=mysqli_query($this->db,$sql);
            return;
	}
	
	public function get_new_oid(){
		$sql = "SELECT * FROM tbl_order ORDER BY ord_id DESC limit 1";
		$result = mysqli_query($this->db,$sql);
		$row = mysqli_fetch_assoc($result);
		$oid = $row['ord_id'];
		return $oid;
	}
	public function set_oitamount($id){
		$select = "SELECT SUM(oit_amount) AS total_amount FROM tbl_oitems WHERE ord_id='$id'";
		$result = mysqli_query($this->db,$select);
		$row = mysqli_fetch_assoc($result);
		$amount = $row['total_amount'];
		$updatesql = "UPDATE tbl_order SET ord_amount = ord_amount + '$amount' WHERE ord_id='$id'";
		$update = mysqli_query($this->db,$updatesql);
		return;
	}
	public function pay_order($name,$count,$ostid,$tabid,$usrid){
		$sql = "INSERT INTO tbl_order(ord_customer,ord_items,ord_date_added,ord_time_added,ost_id,tab_id,usr_id) VALUES('$name',$count,NOW(),NOW(),'$ostid','$tabid',$usrid)";
		$result = mysqli_query($this->db,$sql) or die(mysqli_error() . "Cannot Insert Data");
		return $result;
	}
	
    public function get_orderpertable($tabid){
		$sql = "SELECT tbl_otemp.pro_id AS pro_id, ord_qty, tbl_product.pro_id, pro_price, ote_print FROM tbl_otemp, tbl_product WHERE tab_id='$tabid' AND tbl_otemp.pro_id=tbl_product.pro_id";
        $result=mysqli_query($this->db,$sql);
        $count_row=$result->num_rows;
        if($count_row != 0){
			while($row=mysqli_fetch_assoc($result)){
				$list[] = $row;
			}
				return $list;
			}else{
				return false;
        }
	}
	
	public function insert_item($proid,$ordqty,$amount,$orderid,$tabid,$usrid){
		$sql="SELECT * FROM tbl_oitems WHERE pro_id='$proid' AND ord_id='$orderid'";
		$result = mysqli_query($this->db,$sql);
		$count_row=$result->num_rows;
		if($count_row > 0){
			$sql_update = "UPDATE tbl_oitems SET oit_qty = oit_qty + '$ordqty', oit_amount = oit_amount + '$amount' WHERE pro_id = '$proid' AND ord_id = '$orderid'";
		}else{
			$sql_update = "INSERT INTO tbl_oitems(pro_id, oit_qty, oit_amount, ord_id, tab_id, usr_id) VALUES('$proid','$ordqty','$amount','$orderid','$tabid','$usrid')";
		}
		$asd = mysqli_query($this->db,$sql_update) or die(mysqli_error() . "Cannot Insert Data");
		return $asd;
	}
	
    public function get_orderpertableforprint($tabid){
		$sql = "SELECT * FROM tbl_otemp WHERE tab_id='$tabid' AND ote_print='0'";
        $result=mysqli_query($this->db,$sql);
        $count_row=$result->num_rows;
        if($count_row != 0){
		while($row=mysqli_fetch_assoc($result)){
			$list[] = $row;
		}
            return $list;
        }else{
            return false;
        }
	}
    public function set_printed($id){
		$sql="UPDATE tbl_otemp SET ote_print='1' WHERE ote_id='$id'";
            $result=mysqli_query($this->db,$sql);
            return;
	}
    public function close_order($id){
		$sql="DELETE FROM tbl_otemp WHERE tab_id='$id'";
            $result=mysqli_query($this->db,$sql);
            return;
	}

	public function select_recipe($id){
		$sql = "SELECT * FROM tbl_recipe WHERE pro_id='$id'";
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_array($result)){
			$list[] = $row;
		}
		return $list;
	}
	public function check_availability($id){
		$sql = "SELECT tbl_recipe.ing_id,tbl_ingredient.ing_id AS ing_id,ing_qty,rec_qty FROM tbl_ingredient,tbl_recipe WHERE tbl_recipe.ing_id=tbl_ingredient.ing_id AND ing_qty >= rec_qty AND rec_id='$id'";
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_array($result)){
			$list[] = $row;
		}
		return $list;
	}

	public function deduct_ingredients($rid,$id,$rec_qty){
		$sql = "UPDATE tbl_ingredient SET ing_qty = ing_qty - $rec_qty WHERE ing_id='$id'";
		$result = mysqli_query($this->db,$sql) or die(mysqli_error() . "Cannot Update Data");
		return $result;
	}
}