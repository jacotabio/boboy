<?php
class Dashboard{
	public $db;

	public function __construct(){
		try{
    		$this->db = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_DATABASE, DB_USERNAME, DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
	    }catch(PDOException $e){
	      echo "Connection failed: " . $e->getMessage();
	      exit;
	    }
	}

	public function init_dash($id){
		$sth = $this->db->prepare("SELECT 
  (SELECT COUNT(DISTINCT orders.order_id) FROM orders,oitem,items WHERE orders.order_id = oitem.order_id AND items.item_id = oitem.item_id AND items.brand_id = ? AND oi_status = 0) AS t_pending,
  (SELECT COUNT(DISTINCT orders.order_id) FROM orders,oitem,items WHERE orders.order_id = oitem.order_id AND items.item_id = oitem.item_id AND items.brand_id = ? AND oi_status = 1 AND oi_delivery != 2) AS t_ongoing,
  (SELECT COUNT(msg_id) FROM conversations,messages WHERE brand_id = ? AND usr_id = 1 AND conversations.convo_id = messages.convo_id AND sender_id = 1 AND msg_open = 0) AS admin_msg");
		$sth->bindParam(1,$id);
		$sth->bindParam(2,$id);
		$sth->bindParam(3,$id);
		$sth->execute();

		while($row = $sth->fetch(PDO::FETCH_ASSOC)){
			$list[] = $row;
		}
		if(!empty($list)){
			return $list;
		}
	}
}