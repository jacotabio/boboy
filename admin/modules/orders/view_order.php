<?php
include 'classes/class.orders.php';
$currency = "₱ ";
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
                <div class="row" style="margin-top:30px;">
                  <div class="col-lg-2 offset-lg-1">
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
                  <div class="col-lg-8 offset-lg-1">
                    <span class="label-title">Delivery Address</span>
                    <p class="label-text"><?php echo $g['delivery_address'];?></p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-10 offset-lg-1">
                    <div class="container-fluid" style="margin-top:30px;margin-bottom:30px;">
                      <div class="stepwizard">
                        <div class="stepwizard-row">
                            <div class="stepwizard-step">
                              <button type="button" class="btn btn-circle"><i class="fa fa-check" aria-hidden="true"></i></button>
                                <p>Processing</p>
                            </div>
                            <div class="stepwizard-step">
                              <button type="button" class="btn btn-circle"><span class="glyphicon glyphicon-ok"></span></button>
                                <p>Approved</p>
                            </div>
                            <div class="stepwizard-step">
                              <button type="button" class="btn btn-circle"><span class="glyphicon glyphicon-ok"></span></button>
                                <p>Collecting</p>
                            </div>
                            <div class="stepwizard-step">
                              <button type="button" class="btn btn-circle"><span class="glyphicon glyphicon-ok"></span></button>
                                <p>On Delivery</p>
                            </div>
                            <div class="stepwizard-step">
                              <button type="button" class="btn btn-circle"><span class="glyphicon glyphicon-ok"></span></button>
                                <p>Closed</p>
                            </div>
                        </div>
                      </div>
                    </div><!-- End status map -->
                  </div>
                </div>
                <div class="row" style="margin-top:16px;">
                  <div class="col-sm-5 offset-lg-1">
                    <?php
                    $oitem = $order->get_oitems($g['order_id']);
                    if($oitem){
                      $oitemb = $order->get_oitems_brands($g['order_id']);
                      foreach($oitemb as $oib){?>
                        <div class="list-group-wrapper">
                          <div style="width:100%;">
                            <button class="btn btn-chat float-right" value="<?php echo $oib['brand_id']?>" style="color:#317ecc;padding:0;background:none;"><span class="fa fa-comment"></span>&nbsp;Message</button>
                            <label class="label-title"><?php echo $oib['brand_name']?>
                            </label>
                          </div>
                          <ul class="list-group">
                      <?php
                        foreach($oitem as $oi){
                          if($oib['brand_id'] == $oi['brand_id']){?>
                            <li class="list-group-item oi-status-<?php echo $oi['oi_status'];?>"><span class="circle">&nbsp;&nbsp;&nbsp;</span><?php echo $oi['oi_qty']." x ".$oi['item_name'];?><span class="float-right"><?php echo $currency.$oi['item_price'];?></span></li>
                          <?php
                          }
                        }?>
                          </ul>
                        </div>
                        <?php
                      }
                    }
                    ?>
                  </div>
                  <!-- ORDER SUMMARY COLUMN -->
                  <div class="col-lg-5">
                    <label class="label-title">Order Summary</label>
                    <ul class="list-group" style="display:inline-block;width:100%;">
                      <li class="list-group-item">Number of Items<span id="od-noi" class="float-right">Loading..</span></li>
                      <li class="list-group-item list-borderless">Subtotal<span id="od-st" class="float-right">Loading..</span></li>
                      <li class="list-group-item list-borderless">Service Fee<span id="od-sf" class="float-right">Loading..</span></li>
                      <li class="list-group-item">Total<span id="od-tt" class="float-right">Loading..</span></li>
                    </ul>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}
?>