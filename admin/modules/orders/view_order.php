<?php
include 'classes/class.orders.php';
$order = new Orders();
$get = $order->order_details($_GET['o']);
if(!$get){
  echo "invalid_order";
}else{
  foreach($get as $g);
?>
<div class="row">
    <!-- column -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-block">
                <div style="display:inline-block; width:100%;">
                  <h4 class="card-title pull-left">Order #<?php echo $g['order_id'];?></h4>
                  <div class="pull-right">
                    <div class="btn-group">
                      <i class="fa fa-ellipsis-v button" style="font-size:20px;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      </i>
                      <div class="dropdown-menu dropdown-menu-right">
                        <button class="dropdown-item pointer" type="button">Add Item</button>
                        <button class="dropdown-item pointer" type="button">Edit Details</button>
                        <button class="dropdown-item pointer" type="button">Delete Order</button>
                      </div>
                    </div>
                  </div>
                </div>
                <h6 class="card-subtitle">View customer's ordered items and status</h6>
                <div class="row">
                  <div class="col-sm-2">
                    <span class="label-title">Placed order on</span>
                    <p class="label-text"><?php 
                      $date = new DateTime($g['created_at']);
                      echo $date->format("M j, Y g:iA");
                    ?></p>
                  </div>
                  <div class="col-sm-2">
                    <span class="label-title">Customer Name</span>
                    <p class="label-text"><?php echo $g['usr_name'];?></p>
                  </div>
                  <div class="col-sm-2">
                    <span class="label-title">Contact Number</span>
                    <p class="label-text"><?php echo $g['contact_number'];?></p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <span class="label-title">Delivery Address</span>
                    <p class="label-text"><?php echo $g['delivery_address'];?></p>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}
?>