<?php
class Chats{
  public $db;
  
  public function __construct(){
    try{
    $this->db = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_DATABASE, DB_USERNAME, DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    }catch(PDOException $e){
      echo "Connection failed: " . $e->getMessage();
      exit;
    }
  }

  public function get_convo($uid,$bid){
    //
    $query = $this->db->prepare("SELECT convo_id AS cid,COUNT(convo_id) AS result FROM conversations WHERE usr_id = ? AND brand_id = ?");
    $query->bindParam(1,$uid);
    $query->bindParam(2,$bid);
    $query->execute();

    $row = $query->fetch(PDO::FETCH_ASSOC);
    if(!empty($row['cid'])){
      return $row['cid'];
    }
    $this->db = null;
  }
  
  public function updateNotif($id){
		try
		{
			$stmt = $this->db->prepare("UPDATE messages SET show_notif = 0 WHERE show_notif >= 0 AND msg_id = :id");
			$stmt->bindParam("id", $id);
			$stmt->execute();
			$stat[0] = true;
			$stat[1] = 'sukses';
			return $stat;
		}
		catch(PDOException $ex)
		{
			$stat[0] = false;
			$stat[1] = $ex->getMessage();
			return $stat;
		}
    $this->db = null;
  }
  
  public function user_all_convo($uid){
    $query = $this->db->prepare("SELECT msg_id,messages.convo_id,usr_name,msg,messages.created_at,usr_img FROM messages,conversations,users WHERE conversations.convo_id = messages.convo_id AND show_notif = 1 AND conversations.usr_id = ? AND sender_id = users.brand_id");
    $query->bindParam(1,$uid);
    $query->execute();
    $stat[0] = true;
    $stat[1] = $query->fetchAll(PDO::FETCH_ASSOC);
    $stat[2] = $query->rowCount();
    return $stat;
    $this->db = null;
  }

  public function brand_all_convo($bid){
    $query = $this->db->prepare("SELECT msg_id,messages.convo_id,usr_name,msg,messages.created_at,usr_img FROM messages,conversations,users WHERE conversations.convo_id = messages.convo_id AND show_notif = 1 AND conversations.brand_id = ? AND sender_id = users.usr_id");
    $query->bindParam(1,$bid);
    $query->execute();
    $stat[0] = true;
    $stat[1] = $query->fetchAll(PDO::FETCH_ASSOC);
    $stat[2] = $query->rowCount();
    return $stat;
    $this->db = null;
  }

  public function admin_chat_counter($bid){
    $sth = $this->db->prepare("SELECT COUNT(msg_id) AS total FROM messages,conversations WHERE usr_id = 1 AND brand_id = ? AND sender_id = 1 AND msg_open = 1");
    $sth->bindParam(1,$bid);
    $sth->execute();
    $row = $sth->fetch(PDO::FETCH_ASSOC);
    return $row['total'];
    $this->db = null;
  }
  public function retrieve_messages($cid){
    $upd = $this->db->prepare("UPDATE messages SET msg_open = 0 WHERE convo_id = ? AND msg_open = 1");
    $upd->bindParam(1,$cid);
    $upd->execute();

    $query = $this->db->prepare("SELECT * FROM messages,conversations,users WHERE conversations.brand_id = users.brand_id AND conversations.convo_id = ? AND conversations.convo_id = messages.convo_id ORDER BY messages.created_at ASC");
    $query->bindParam(1,$cid);
    $query->execute();

    while($row = $query->fetch(PDO::FETCH_ASSOC)){
      $list[] = $row;
    }
    if(!empty($list)){
      return $list;
    }
    $this->db = null;
  }

  public function all_messages($cid,$id){
    $query = $this->db->prepare("SELECT * FROM messages WHERE convo_id = ? AND sender_id != ? ORDER BY created_at DESC");
    $query->bindParam(1,$cid);
    $query->bindParam(2,$id);
    $query->execute();

    while($row = $query->fetch(PDO::FETCH_ASSOC)){
      $list[] = $row;
    }
    if(!empty($list)){
      return $list;
    }
    $this->db = null;
  }

  public function shops_for_chat($oid){
    $query = $this->db->prepare("SELECT users.brand_id,users.usr_name,usr_img,brand_status FROM oitem,items,users,brands WHERE order_id = ? AND items.item_id = oitem.item_id AND items.brand_id = users.brand_id AND brands.brand_id = users.brand_id GROUP BY users.brand_id");
    $query->bindParam(1,$oid);
    $query->execute();

    while($row = $query->fetch(PDO::FETCH_ASSOC)){
      $list[] = $row;
    }
    if(!empty($list)){
      return $list;
    }
    $this->db = null;
  }

  public function send_message($uid,$bid,$msg,$utype){
    if($utype == 1){
      $sender = $uid;
    }else{
      $sender = $bid;
    }

    // Get usr_id of the order
    $query = $this->db->prepare("SELECT convo_id AS cid FROM conversations WHERE usr_id = ? AND brand_id = ?");
    $query->bindParam(1,$uid);
    $query->bindParam(2,$bid);
    $query->execute();

    $row = $query->fetch(PDO::FETCH_ASSOC);
    $convo = $row['cid'];

    if($convo == null || $convo == ""){
      $create = $this->db->prepare("INSERT INTO conversations(usr_id,brand_id,created_at) VALUES(?,?,NOW())");
      $create->bindParam(1,$uid);
      $create->bindParam(2,$bid);
      $create->execute();
      $convo = $this->db->lastInsertId();
      
      $send = $this->db->prepare("INSERT INTO messages(convo_id,msg,sender_id,created_at,show_notif) VALUES(?,?,?,NOW(),1)");
      $send->bindParam(1,$convo);
      $send->bindParam(2,$msg);
      $send->bindParam(3,$sender);
      $send->execute();
      return true;
    }else{
      $send = $this->db->prepare("INSERT INTO messages(convo_id,msg,sender_id,created_at,show_notif) VALUES(?,?,?,NOW(),1)");
      $send->bindParam(1,$convo);
      $send->bindParam(2,$msg);
      $send->bindParam(3,$sender);
      $send->execute();
      return true;
    }
    $this->db = null;
  }
  

  public function send_to_admin($bid,$msg){
    $chk = $this->db->prepare("SELECT convo_id FROM conversations WHERE usr_id = 1 AND brand_id = ?");
    $chk->bindParam(1,$bid);
    $chk->execute();
    $row = $chk->fetch(PDO::FETCH_ASSOC);
    $cid = $row['convo_id'];
    
    $count = $chk->rowCount();

    if($count == 0){
      //create convo
      $c = $this->db->prepare("INSERT INTO conversations(usr_id,brand_id,created_at) VALUES(1,?,NOW())");
      $c->bindParam(1,$bid);
      $c->execute();
      $convo_id = $this->db->lastInsertId();

      $send = $this->db->prepare("INSERT INTO messages(convo_id,msg,sender_id,created_at,show_notif) VALUES(?,?,?,NOW(),1)");
      $send->bindParam(1,$convo_id);
      $send->bindParam(2,$msg);
      $send->bindParam(3,$bid);
      return $send->execute();
    }else{
      //send message
      $send = $this->db->prepare("INSERT INTO messages(convo_id,msg,sender_id,created_at,show_notif) VALUES(?,?,?,NOW(),1)");
      $send->bindParam(1,$cid);
      $send->bindParam(2,$msg);
      $send->bindParam(3,$bid);
      return $send->execute();
    }
    $this->db = null;
  }
}