<?php
class Orders{
  public $db;

  public function __construct(){
    try{
    $this->db = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_DATABASE, DB_USERNAME, DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    }catch(PDOException $e){
      echo "Connection failed: " . $e->getMessage();
      exit;
    }
  }

  public function order_dashboard($bid){
    $sth = $this->db->prepare("SELECT (SELECT COUNT(order_status) FROM orders,oitem,items WHERE items.item_id = oitem.item_id AND orders.order_id = oitem.order_id AND items.brand_id = ? AND order_status = 0) AS t_pending,(SELECT COUNT(order_status) FROM orders,oitem,items WHERE items.item_id = oitem.item_id AND orders.order_id = oitem.order_id AND items.brand_id = ? AND order_status < 3) AS t_ongoing,(SELECT COUNT(order_status) FROM orders,oitem,items WHERE items.item_id = oitem.item_id AND orders.order_id = oitem.order_id AND items.brand_id = ?) AS t_total");
    $sth->bindParam(1,$bid);
    $sth->bindParam(2,$bid);
    $sth->bindParam(3,$bid);
    $sth->execute();

    while($row = $sth->fetch(PDO::FETCH_ASSOC)){
      $list[] = $row;
    }
    return $list;
    //return $pending = $row['t_pending'];
  }
  public function pending_brand_orders($bid){
    $query = $this->db->prepare("SELECT *,orders.created_at AS date_ordered FROM orders,oitem,items,users WHERE orders.order_id = oitem.order_id AND oitem.item_id = items.item_id AND items.brand_id = ? AND users.usr_id = orders.usr_id GROUP BY orders.order_id ORDER BY orders.created_at DESC");
    $query->bindParam(1,$bid);
    $query->execute();

    while($row = $query->fetch(PDO::FETCH_ASSOC)){
      $list[] = $row;
    }
    if(!empty($list)){
      return $list;
    }
    $db = null;
  }

  public function pending_user_orders($id){
    $query = $this->db->prepare("SELECT * FROM orders WHERE usr_id = ? GROUP BY order_id ORDER BY created_at DESC");
    $query->bindParam(1,$id);
    $query->execute();

    while($row = $query->fetch(PDO::FETCH_ASSOC)){
      $list[] = $row;
    }
    if(!empty($list)){
      return $list;
    }
    $db = null;
  }
  public function accept_cpanel_order($id){
    $query = $this->db->prepare("UPDATE oitem SET oi_status = 1 WHERE oi_id = ? AND oi_status != 2");
    $query->bindParam(1,$id);
    return $query->execute();
  }

  public function ready_cpanel_order($id){
    $query = $this->db->prepare("UPDATE oitem SET oi_delivery = 1 WHERE oi_id = ?");
    $query->bindParam(1,$id);
    return $query->execute();
  }

  public function claim_cpanel_order($id){
    $query = $this->db->prepare("UPDATE oitem SET oi_delivery = 2 WHERE oi_id = ?");
    $query->bindParam(1,$id);
    return $query->execute();
  }

  public function decline_cpanel_order($id,$oid){
    $minus = $this->db->prepare("SELECT oi_subtotal FROM oitem WHERE oi_id = ?");
    $minus->bindParam(1,$id);
    $minus->execute();
    $value = $minus->fetch(PDO::FETCH_ASSOC);

    $query = $this->db->prepare("UPDATE oitem SET oi_status = 2 WHERE oi_id = ?");
    $query->bindParam(1,$id);
    $query->execute();

    $deduct = $this->db->prepare("UPDATE orders SET order_total = order_total - ? WHERE order_id = ?");
    $deduct->bindParam(1,$value);
    $deduct->bindParam(2,$oid);
    return $deduct->execute();
  }

  public function remove_oi($id,$oid,$bid){
    $q1 = $this->db->prepare("SELECT SUM(oi_qty*oi_subtotal) AS total_deduct FROM oitem WHERE oi_id = ?");
    $q1->bindParam(1,$id);
    $q1->execute();
    $row1 = $q1->fetch(PDO::FETCH_ASSOC);
    $total_deduct = $row1['total_deduct'];
    
    $q2 = $this->db->prepare("SELECT order_total AS total FROM orders WHERE order_id = ?");
    $q2->bindParam(1,$oid);
    $q2->execute();
    $row2 = $q2->fetch(PDO::FETCH_ASSOC);
    $order_total = $row2['total'];

    $new_total = $order_total - $total_deduct;
    if($new_total > 0){
      $q3 = $this->db->prepare("UPDATE orders SET order_total = ? WHERE order_id = ? AND order_status = 0");
      $q3->bindParam(1,$new_total);
      $q3->bindParam(2,$oid);
      $q3->execute();

      $query = $this->db->prepare("UPDATE oitem SET oi_status = 2 WHERE oi_id = ? AND oi_status = 0");
      $query->bindParam(1,$id);
      $query->execute();

      return "oi_removed";
    }else{
      $drop_oi = $this->db->prepare("UPDATE oitem SET oi_status = 2 WHERE oi_id = ? AND oi_status = 0");
      $drop_oi->bindParam(1,$id);
      $drop_oi->execute();

      $drop_order = $this->db->prepare("UPDATE orders SET order_status = 5 WHERE order_id = ?");
      $drop_order->bindParam(1,$oid);
      $drop_order->execute();

      return "order_removed";
    }
    
    
  }

  public function get_order_subtotal($oid,$bid){
    $query = $this->db->prepare("SELECT SUM(oi_subtotal) AS subtotal FROM oitem,items WHERE order_id = ? AND oitem.item_id = items.item_id AND items.brand_id = ? AND oi_status != 2");
    $query->bindParam(1,$oid);
    $query->bindParam(2,$bid);
    $query->execute();

    $row = $query->fetch(PDO::FETCH_ASSOC);
    $subtotal = $row['subtotal'];
    return $subtotal;
  }

  public function get_order_details($oid,$bid){
    $query = $this->db->prepare("SELECT * FROM oitem,users,items WHERE order_id = ? AND oitem.usr_id = users.usr_id AND oitem.item_id = items.item_id AND items.brand_id = ? ORDER BY oi_status ASC");
    $query->bindParam(1,$oid);
    $query->bindParam(2,$bid);
    $query->execute();

    while($row = $query->fetch(PDO::FETCH_ASSOC)){
      $list[] = $row;
    }
    if(!empty($list)){
      return $list;
    }
    $db = null;
  }

  public function shop_oitems_id($oid,$bid){
    
    // Count total order item of order ID
    $query = $this->db->prepare("SELECT oi_id FROM oitem,items WHERE order_id = ? AND items.item_id = oitem.item_id AND brand_id = ?");
    $query->bindParam(1,$oid);
    $query->bindParam(2,$bid);
    $query->execute();
    
    while($row = $query->fetch(PDO::FETCH_ASSOC)){
      $list[] = $row;
    }
    if(!empty($list)){
      return $list;
    }
    $db = null;
  }

  public function get_order_datetime($oid){
    $query = $this->db->prepare("SELECT created_at FROM orders WHERE order_id = ?");
    $query->bindParam(1,$oid);
    $query->execute();

    $row = $query->fetch(PDO::FETCH_ASSOC);
    $value = $row['created_at'];
    return $value;
  }

  public function count_total_items($oid){
    $query = $this->db->prepare("SELECT COUNT(oi_id) AS total_items FROM oitem WHERE order_id = ?");
    $query->bindParam(1,$oid);
    $query->execute();

    $row = $query->fetch(PDO::FETCH_ASSOC);
    $value = $row['total_items'];
    return $value;
  }

  public function get_order_items($oid,$uid){
    $query = $this->db->prepare("SELECT * FROM oitem,items WHERE items.item_id = oitem.item_id AND order_id = ? AND usr_id = ?");
    $query->bindParam(1,$oid);
    $query->bindParam(2,$uid);
    $query->execute();

    while($row = $query->fetch(PDO::FETCH_ASSOC)){
      $list[] = $row;
    }
    if(!empty($list)){
      return $list;
    }
  }

  public function get_approved_items($oid,$uid){
    $query = $this->db->prepare("SELECT * FROM oitem,items WHERE items.item_id = oitem.item_id AND order_id = ? AND usr_id = ? AND oi_status = 1");
    $query->bindParam(1,$oid);
    $query->bindParam(2,$uid);
    $query->execute();

    while($row = $query->fetch(PDO::FETCH_ASSOC)){
      $list[] = $row;
    }
    if(!empty($list)){
      return $list;
    }
  }

  public function count_pending_items($oid){
    $q1 = $this->db->prepare("SELECT COUNT(oi_id) AS total_pending FROM oitem WHERE order_id = ? AND oi_status = 0");
    $q1->bindParam(1,$oid);
    $q1->execute();

    $row = $q1->fetch(PDO::FETCH_ASSOC);
    return $row['total_pending'];
  }

  public function cancel_order($oid,$total){
    $q = $this->db->prepare("SELECT COUNT(oi_id) AS total_approved FROM oitem WHERE order_id = ? AND oi_status = 1");
    $q->bindParam(1,$oid);
    $q->execute();
    $row = $q->fetch(PDO::FETCH_ASSOC);
    $approved = $row['total_approved'];
    
    if($approved > 0){
      return "cancel_too_late";
    }else{
      $q2 = $this->db->prepare("DELETE FROM oitem WHERE order_id = ?");
      $q2->bindParam(1,$oid);
      $q2->execute();

      $q3 = $this->db->prepare("DELETE FROM orders WHERE order_id = ? AND order_status = 0");
      $q3->bindParam(1,$oid);
      $q3->execute();
      return "order_cancelled";
    }
  }

  public function count_total_declined($oid){
    $query = $this->db->prepare("SELECT COUNT(oi_id) AS total_declined FROM oitem WHERE order_id = ? AND oi_status = 2");
    $query->bindParam(1,$oid);
    $query->execute();

    $row = $query->fetch(PDO::FETCH_ASSOC);
    $value = $row['total_declined'];
    return $value;
  }

  public function approve_order_status($oid){
    $query = $this->db->prepare("UPDATE orders SET order_status = 1 WHERE order_id = ?");
    $query->bindParam(1,$oid);
    return $query->execute();
  }

  public function order_pending_complete($oid){
    $query = $this->db->prepare("UPDATE orders SET order_status = 1 WHERE order_id = ?");
    $query->bindParam(1,$oid);
    return $query->execute();
  }

  public function ready_order_status($oid){
    $query = $this->db->prepare("UPDATE orders SET order_status = 2 WHERE order_id = ?");
    $query->bindParam(1,$oid);
    return $query->execute();
  }

  public function claim_order_status($oid){
    $query = $this->db->prepare("UPDATE orders SET order_status = 3 WHERE order_status = 2 AND order_id = ?");
    $query->bindParam(1,$oid);
    return $query->execute();
  }

  public function decline_order_status($oid){
    $query = $this->db->prepare("UPDATE orders SET order_status = 5 WHERE order_id = ?");
    $query->bindParam(1,$oid);
    return $query->execute();
  }

  public function approval_status($oid,$bid){
    $query = $this->db->prepare("SELECT COUNT(oi_id) AS total_need FROM oitem,items WHERE items.item_id = oitem.item_id AND items.brand_id = ? AND order_id = ?");
    $query->bindParam(1,$bid);
    $query->bindParam(2,$oid);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    $total_need = $row['total_need'];

    // CHECK IF ALL PROVIDE IS APPROVED
    $query2 = $this->db->prepare("SELECT COUNT(oi_id) AS total_need FROM oitem,items WHERE items.item_id = oitem.item_id AND items.brand_id = ? AND order_id = ? AND oi_status = 1");
    $query2->bindParam(1,$bid);
    $query2->bindParam(2,$oid);
    $query2->execute();
    $row2 = $query2->fetch(PDO::FETCH_ASSOC);
    $total_approved = $row2['total_need'];

    // CHECK IF ALL PROVIDE IS DECLINED
    $query3 = $this->db->prepare("SELECT COUNT(oi_id) AS total_declined FROM oitem,items WHERE items.item_id = oitem.item_id AND items.brand_id = ? AND order_id = ? AND oi_status = 2");
    $query3->bindParam(1,$bid);
    $query3->bindParam(2,$oid);
    $query3->execute();
    $row3 = $query3->fetch(PDO::FETCH_ASSOC);
    $total_declined = $row3['total_declined'];

    $chk_total = $total_need - $total_declined;
    if($total_need == $total_approved){
      return "Approved";
    }else if($chk_total != 0 && $total_approved != 0 && $chk_total == $total_approved){
      return "Approved";
    }else if($chk_total == 0 && $total_approved == 0){
      return "Declined";
    }else if($total_need == $total_declined){
      return "Declined";
    }else{
      return "Pending";
    }

    $chk_total = $total_need - $total_declined;

  }

  public function order_status($oid,$bid){

    // Count total order item of order ID
    $query1 = $this->db->prepare("SELECT COUNT(oi_status) AS total_orders FROM oitem,items WHERE order_id = ? AND items.item_id = oitem.item_id AND brand_id = ?");
    $query1->bindParam(1,$oid);
    $query1->bindParam(2,$bid);
    $query1->execute();

    $row1 = $query1->fetch(PDO::FETCH_ASSOC);
    $value1 = $row1['total_orders'];  
    
    
    // Count items that have been approved of order ID
    $query2 = $this->db->prepare("SELECT COUNT(oi_status) AS total_approved FROM oitem,items WHERE order_id = ? AND items.item_id = oitem.item_id AND brand_id = ? AND oi_status = 1");
    $query2->bindParam(1,$oid);
    $query2->bindParam(2,$bid);
    $query2->execute();

    $row2 = $query2->fetch(PDO::FETCH_ASSOC);
    $value2 = $row2['total_approved'];
    if($value1 == $value2){
      return "Complete";
    }else{
      return "Pending";
    } 
  }

  public function check_order_votes($oid,$bid){
    $query = $this->db->prepare("SELECT COUNT(oi_status) AS votes FROM oitem,items WHERE oitem.item_id = items.item_id AND order_id = ? AND oi_status = 0");
    $query->bindParam(1,$oid);
    $query->execute();

    $row = $query->fetch(PDO::FETCH_ASSOC);
    return $row['votes'];
  }

  public function check_ready_votes($oid,$bid){
    $query = $this->db->prepare("SELECT COUNT(oi_status) AS votes FROM oitem,items WHERE oitem.item_id = items.item_id AND order_id = ? AND oi_status = 1 AND oi_delivery = 0");
    $query->bindParam(1,$oid);
    $query->execute();

    $row = $query->fetch(PDO::FETCH_ASSOC);
    return $row['votes'];
  }

  public function check_claim_votes($oid,$bid){
    $query = $this->db->prepare("SELECT COUNT(oi_status) AS votes FROM oitem,items WHERE oitem.item_id = items.item_id AND order_id = ? AND oi_delivery = 1 AND oi_status = 1");
    $query->bindParam(1,$oid);
    $query->execute();

    $row = $query->fetch(PDO::FETCH_ASSOC);
    return $row['votes'];
  }

  public function get_order_customer_info($oid,$bid){
    $query = $this->db->prepare("SELECT * FROM items,oitem,orders,users WHERE items.item_id = oitem.item_id AND orders.order_id = oitem.order_id AND orders.order_id = ? AND orders.usr_id = users.usr_id AND items.brand_id = ?");
    $query->bindParam(1,$oid);
    $query->bindParam(2,$bid);
    $query->execute();

    while($row = $query->fetch(PDO::FETCH_ASSOC)){
      $list[] = $row;
    }
    if(!empty($list)){
      return $list;
    }
    $db = null;
  }

  public function user_order_status($oid,$uid){
    $query = $this->db->prepare("SELECT order_status FROM orders WHERE order_id = ? AND usr_id = ?");
    $query->bindParam(1,$oid);
    $query->bindParam(2,$uid);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    return $status = $row['order_status'];
  }

  public function user_order_info($oid,$uid){
    $query = $this->db->prepare("SELECT * FROM orders,users WHERE order_id = ? AND users.usr_id = orders.usr_id AND users.usr_id = ?");
    $query->bindParam(1,$oid);
    $query->bindParam(2,$uid);
    $query->execute();

    while($row = $query->fetch(PDO::FETCH_ASSOC)){
      $list[] = $row;
    }
    if(!empty($list)){
      return $list;
    }
    $db = null;
  }

  public function get_delivery_status($oid,$bid){

    // CHECK ALL ITEMS BRAND NEEDS TO PROVIDE
    $query = $this->db->prepare("SELECT COUNT(oi_id) AS total_items FROM oitem,items WHERE items.item_id = oitem.item_id AND items.brand_id = ? AND order_id = ?");
    $query->bindParam(1,$bid);
    $query->bindParam(2,$oid);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    $total_items = $row['total_items'];

    // CHECK IF ITEMS ARE READY TO BE CLAIMED
    $query2 = $this->db->prepare("SELECT COUNT(oi_id) AS total_for_claim FROM oitem,items WHERE items.item_id = oitem.item_id AND items.brand_id = ? AND order_id = ? AND oi_delivery = 1");
    $query2->bindParam(1,$bid);
    $query2->bindParam(2,$oid);
    $query2->execute();
    $row2 = $query2->fetch(PDO::FETCH_ASSOC);
    $total_ready = $row2['total_for_claim'];

    

    // CHECK ITEMS IF CLAIMED
    $query3 = $this->db->prepare("SELECT COUNT(oi_id) AS total_claimed FROM oitem,items WHERE items.item_id = oitem.item_id AND items.brand_id = ? AND order_id = ? AND oi_delivery = 2");
    $query3->bindParam(1,$bid);
    $query3->bindParam(2,$oid);
    $query3->execute();
    $row3 = $query3->fetch(PDO::FETCH_ASSOC);
    $total_claimed = $row3['total_claimed'];

    if($total_items == $total_ready){
      return "Ready";
    }else if($total_items == $total_claimed){
      return "Complete";
    }else{
      return "Pending";
    }
    

    
  }
}