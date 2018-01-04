<?php
class Topic{
	public $db;

	public function __construct(){
		$this->db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		if(mysqli_connect_errno()){
			echo "Database connection error.";
			exit;
		}
	}

	public function get_topic(){

	}

	public function get_top_popular(){
		$sql = "SELECT tbl_topic.to_id,tbl_topic.to_title FROM tbl_topic WHERE to_like != 0 ORDER BY to_like DESC LIMIT 10";
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_array($result)){
			$list[] = $row;
		}
		if(!empty($list)){
			return $list;
		}
	}

	public function get_top_issues(){
		$sql = "SELECT tbl_topic.to_id,tbl_topic.to_title FROM tbl_topic WHERE cat_id = 202 AND to_like != 0 ORDER BY to_like DESC LIMIT 10";
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_array($result)){
			$list[] = $row;
		}
		if(!empty($list)){
			return $list;
		}
	}

	public function get_category(){
		$sql = "SELECT * FROM tbl_category";
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_array($result)){
			$list[] = $row;
		}
		if(!empty($list)){
			return $list;
		}
	}

	public function get_comments($id){
		$sql = "SELECT * FROM tbl_trend WHERE to_id='$id' AND tr_comment != '' ORDER BY comment_datetime_added DESC";
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_array($result)){
			$list[] = $row;
		}
		if(!empty($list)){
			return $list;
		}
	}

	public function check_like($id,$usrid){
		$check = "SELECT * FROM tbl_trend WHERE to_id='$id' AND usr_id='$usrid' AND to_like = 1";
		$result = mysqli_query($this->db,$check);
		$count_row=$result->num_rows;
        if($count_row == 0){
        	return true;
        }else{
        	return false;
        }
	}

	public function send_like($id,$usrid){
		$check = "SELECT * FROM tbl_trend WHERE to_id='$id' AND usr_id='$usrid' AND to_like = 1";
		$result = mysqli_query($this->db,$check);
		$count_row=$result->num_rows;
        if($count_row == 0){
        	$sql = "INSERT INTO tbl_trend(comment_datetime_added,to_id,usr_id,to_like) VALUES(NOW(),'$id','$usrid',1)";
        	$result1 = mysqli_query($this->db,$sql) or die(mysqli_error() . "Cannot Insert Data");
        	$updatelike = "UPDATE tbl_topic SET to_like = to_like + 1 WHERE to_id='$id'";
        	$result2 = mysqli_query($this->db,$updatelike) or die(mysqli_error() . "Cannot Update data");
        }
	}

	public function post_comment($c,$toid,$usrid){
		$sql = "INSERT INTO tbl_trend(tr_comment,comment_datetime_added,to_id,usr_id) VALUES('$c',NOW(),'$toid','$usrid')";
		$result = mysqli_query($this->db,$sql) or die(mysqli_error() . "Cannot Insert Data");
		return $result;
	}

	public function count_comment($id){
		$sql = "SELECT COUNT(tr_id) AS tcomment FROM tbl_trend WHERE tr_comment != '' AND to_id='$id'";
		$result = mysqli_query($this->db,$sql);
		$row = mysqli_fetch_assoc($result);
		$value = $row['tcomment'];
		return $value;
	}

	public function count_likes($id){
		$sql = "SELECT to_like FROM tbl_topic WHERE to_id='$id'";
		$result = mysqli_query($this->db,$sql);
		$row = mysqli_fetch_assoc($result);
		$value = $row['to_like'];
		return $value;
	}
	public function new_topic($title,$desc,$id,$cat){
		$sql = "INSERT INTO tbl_topic(to_title,to_description,to_datetime_added,usr_id,cat_id) VALUES('$title','$desc',NOW(), '$id','$cat')";
		$result = mysqli_query($this->db,$sql) or die(mysqli_error() . "Cannot Insert Data");
		return $result;
	}

	public function get_all_topic(){
		$sql = "SELECT * FROM tbl_topic ORDER BY to_datetime_added DESC";
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_array($result)){
			$list[] = $row;
		}
		if(!empty($list)){
			return $list;
		}
	}

	public function get_all_topic_s($s){
		$sql = "SELECT * FROM tbl_topic WHERE to_title LIKE '%$s%' ORDER BY to_datetime_added DESC";
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_array($result)){
			$list[] = $row;
		}
		if(!empty($list)){
			return $list;
		}
	}

	public function get_topic_cat($id){
		$sql = "SELECT * FROM tbl_topic WHERE cat_id='$id' ORDER BY to_datetime_added DESC";
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_array($result)){
			$list[] = $row;
		}
		if(!empty($list)){
			return $list;
		}
	}

	public function get_topic_cat_s($cid,$s){
		$sql = "SELECT * FROM tbl_topic WHERE cat_id='$cid' AND to_title LIKE '%$s%' ORDER BY to_datetime_added DESC";
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_array($result)){
			$list[] = $row;
		}
		if(!empty($list)){
			return $list;
		}
	}

	public function get_topic_details($id){
		$sql = "SELECT * FROM tbl_topic WHERE to_id='$id'";
		$result = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_array($result)){
			$list[] = $row;
		}
		if(!empty($list)){
			return $list;
		}
	}
}