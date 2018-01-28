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

  public function delete_order($id){
    $sth = $this->db->prepare("DELETE FROM orders WHERE order_id = ?");
    $sth->bindParam(1,$id);
    return $sth->execute();
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