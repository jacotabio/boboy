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

  public function create_order(){
    $sth = $this->db->prepare("INSERT INTO orders(created_at,usr_id,delivery_address,contact_number,custom_name) VALUES(NOW(),'1',?,?,?)");
  }

  public function delete_order($id){
    $sth = $this->db->prepare("DELETE FROM orders WHERE order_id = ?");
    $sth->bindParam(1,$id);
    return $sth->execute();
  }

  public function close_order($id){
    $sth = $this->db->prepare("UPDATE orders SET order_status = 4 WHERE order_id = ? AND order_status = 3");
    $sth->bindParam(1,$id);
    return $sth->execute();
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
  }
  
  public function pending_orders(){
    $query = $this->db->prepare("SELECT order_id,orders.created_at,usr_name,order_total,
                                  CASE
                                    WHEN order_status = 0 THEN 'Processing'
                                    WHEN order_status = 1 THEN 'Approved'
                                    WHEN order_status = 2 THEN 'Collecting'
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
  }

  public function order_details($id){
    $query = $this->db->prepare("SELECT SUM(oi_qty) AS noi,order_total+custom_fee AS total,orders.order_id,order_total AS subtotal,created_at,order_status,usr_name,delivery_address,contact_number,custom_fee AS service_fee FROM orders,users,oitem WHERE oitem.order_id = orders.order_id AND orders.order_id = ? AND orders.usr_id = users.usr_id");
    $query->bindParam(1,$id);
    $query->execute();

    while($row = $query->fetch(PDO::FETCH_ASSOC)){
      $list[] = $row;
    }
    if(!empty($list)){
      return $list;
    }
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
  }

  public function get_oitems_brands($id){
    $query = $this->db->prepare("SELECT DISTINCT(items.brand_id),brand_name FROM oitem,items,brands WHERE order_id = ? AND items.item_id = oitem.item_id AND items.brand_id = brands.brand_id");
    $query->bindParam(1,$id);
    $query->execute();

    while($row = $query->fetch(PDO::FETCH_ASSOC)){
      $list[] = $row;
    }
    if(!empty($list)){
      return $list;
    }
  }
}