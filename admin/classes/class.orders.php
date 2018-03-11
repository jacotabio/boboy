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

  public function dashboard_data(){
    $sth = $this->db->prepare("SELECT (SELECT COUNT(order_id) FROM orders WHERE order_status = 3) AS on_delivery, (SELECT COUNT(brands.brand_id) FROM brands,users WHERE brand_status = 1 AND brands.brand_id = users.brand_id AND usr_status = 1 AND is_hidden = 0) AS active_brands,(SELECT COUNT(order_id) FROM orders WHERE order_status = 0) AS pending_orders, (SELECT COUNT(order_id) FROM orders WHERE order_status = 1) AS ongoing_orders, (SELECT COUNT(order_id) FROM orders WHERE order_status = 2) AS pickup_orders,(SELECT SUM(order_total+custom_fee) FROM orders WHERE DATE(`created_at`) = CURDATE() AND order_status = 4) AS sales_today, (SELECT SUM(order_total+custom_fee) FROM orders WHERE order_status = 4) AS total_sales, (SELECT COUNT(order_id) FROM orders WHERE DATE(`created_at`) = CURDATE()) AS orders_today, (SELECT COUNT(order_id) FROM orders) AS total_orders");
    $sth->execute();

    while($row = $sth->fetch(PDO::FETCH_ASSOC)){
      $list[] = $row;
    }
    if(!empty($list)){
      return $list;
    }
    $this->db = null;
  }
  public function create_order($name,$address,$phone,$fee){
    $sth = $this->db->prepare("INSERT INTO orders(created_at,usr_id,delivery_address,contact_number,custom_name,custom_fee) VALUES(NOW(),'1',?,?,?,?)");
    $uid = 1;
    $sth->bindParam(1,$address);
    $sth->bindParam(2,$phone);
    $sth->bindParam(3,$name);
    $sth->bindParam(4,$fee);
    $sth->execute();
    return $this->db->lastInsertId();
    $this->db = null;

  }

  public function set_order_total($oid,$total){
    $sth = $this->db->prepare("UPDATE orders SET order_total = ? WHERE order_id = ?");
    $sth->bindParam(1,$total);
    $sth->bindParam(2,$oid);
    return $sth->execute();
    $this->db = null;

  }

  public function delete_order($id){
    $sth = $this->db->prepare("DELETE FROM orders WHERE order_id = ?");
    $sth->bindParam(1,$id);
    $sth->execute();

    $sth2 = $this->db->prepare("DELETE FROM oitem WHERE order_id = ?");
    $sth2->bindParam(1,$id);
    return $sth2->execute();
    $this->db = null;

  }

  public function close_order($id){
    $sth = $this->db->prepare("UPDATE orders SET order_status = 4 WHERE order_id = ? AND order_status = 3");
    $sth->bindParam(1,$id);
    return $sth->execute();
    $this->db = null;

  }

  public function add_cart($id,$qty){
    // Query item availability
    $sth1 = $this->db->prepare("SELECT item_price, CASE WHEN COUNT(item_id) = 1 THEN 'available' ELSE 'unavailable' END AS check_item FROM items,brands,users WHERE item_id = ? AND item_status = 1 AND brands.brand_id = items.brand_id AND brand_status = 1 AND users.brand_id = brands.brand_id AND usr_status = 1");
    $sth1->bindParam(1,$id);
    $sth1->execute();
    $row1 = $sth1->fetch(PDO::FETCH_ASSOC);

    // If item is available
    if($row1['check_item'] == "available"){
      $sth2 = $this->db->prepare("SELECT COUNT(cart_id) AS total FROM cart WHERE item_id = ? AND usr_id = 1");
      $sth2->bindParam(1,$id);
      $sth2->execute();
      $row2 = $sth2->fetch(PDO::FETCH_ASSOC);

      if($row2['total'] == 1){
        // Update record
        $upd = $this->db->prepare("UPDATE cart SET item_qty = ? WHERE usr_id = 1 AND item_id = ?");
        $upd->bindParam(1,$qty);
        $upd->bindParam(2,$id);
        $upd->execute();

        return "record_exists";

      }else if($row2['total'] == 0){
        // Insert record
        $ins = $this->db->prepare("INSERT INTO cart(item_id,item_qty,usr_id) VALUES(?,?,'1')");
        $ins->bindParam(1,$id);
        $ins->bindParam(2,$qty);
        $ins->execute();
        return "insert_success";
      }
    }
    // If item is unavailable
    if($row1['check_item'] == "unavailable"){
      return $row1['check_item'];
    }
    $this->db = null;

  }
  
  public function pending_orders(){
    $query = $this->db->prepare("SELECT order_id,orders.created_at,CASE WHEN orders.usr_id = 1 THEN custom_name ELSE usr_name END AS usr_name,order_total,
                                  CASE
                                    WHEN order_status = 0 THEN 'Processing'
                                    WHEN order_status = 1 THEN 'Approved'
                                    WHEN order_status = 2 THEN 'Collect Now'
                                    WHEN order_status = 3 THEN 'On Delivery'
                                    WHEN order_status = 4 THEN 'Closed'
                                    WHEN order_status = 5 THEN 'Declined'
                                  END AS order_status
                                FROM orders,users 
                                WHERE orders.usr_id = users.usr_id ORDER BY orders.created_at DESC");
    $query->execute();

    while($row = $query->fetch(PDO::FETCH_ASSOC)){
      $list[] = $row;
    }
    if(!empty($list)){
      return $list;
    }
    $this->db = null;

  }

  public function order_details($id){
    $query = $this->db->prepare("SELECT SUM(oi_qty) AS noi,SUM(oi_subtotal)+custom_fee AS total,orders.order_id,SUM(oi_subtotal) AS subtotal,created_at,order_status,CASE WHEN orders.usr_id = 1 THEN custom_name ELSE usr_name END AS usr_name,delivery_address,contact_number,custom_fee AS service_fee FROM orders,users,oitem WHERE oitem.order_id = orders.order_id AND orders.order_id = ? AND orders.usr_id = users.usr_id AND oi_status != 2");
    $query->bindParam(1,$id);
    $query->execute();

    while($row = $query->fetch(PDO::FETCH_ASSOC)){
      $list[] = $row;
    }
    if(!empty($list)){
      return $list;
    }
    $this->db = null;

  }

  public function get_oitems($id){
    $query = $this->db->prepare("SELECT *,items.item_price FROM oitem,items WHERE order_id = ? AND items.item_id = oitem.item_id ORDER BY brand_id");
    $query->bindParam(1,$id);
    $query->execute();

    while($row = $query->fetch(PDO::FETCH_ASSOC)){
      $list[] = $row;
    }
    if(!empty($list)){
      return $list;
    }
    $this->db = null;

  }

  public function get_oitems_brands($id){
    $query = $this->db->prepare("SELECT DISTINCT(items.brand_id),brand_name,(SELECT SUM(oi_subtotal) FROM oitem WHERE order_id = ? AND oi_status != 2) AS per_total,brand_status FROM oitem,items,brands WHERE order_id = ? AND items.item_id = oitem.item_id AND items.brand_id = brands.brand_id GROUP BY brand_id");
    $query->bindParam(1,$id);
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
}