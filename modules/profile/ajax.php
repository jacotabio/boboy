<?php
include '../../library/config.php';
include '../../classes/class.items.php';
include '../../classes/class.fees.php';
include '../../classes/class.users.php';
include '../../classes/class.auth.php';
include '../../classes/class.brands.php';
include '../../classes/class.orders.php';
include '../../classes/class.chats.php';

$item = new Items();
$brand = new Brands();
$user = new Users();
$order = new Orders();
$fee = new Fees();
$chat = new Chats();

$currency = "&#x20B1 ";
$servicefee = $fee->get_service_fee();
function time_elapsed_string($datetime, $full = false) {
  $now = new DateTime;
  $ago = new DateTime($datetime);
  $diff = $now->diff($ago);

  $diff->w = floor($diff->d / 7);
  $diff->d -= $diff->w * 7;

  $string = array(
      'y' => 'year',
      'm' => 'month',
      'w' => 'week',
      'd' => 'day',
      'h' => 'hour',
      'i' => 'minute',
      's' => 'second',
  );
  foreach ($string as $k => &$v) {
      if ($diff->$k) {
          $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
      } else {
          unset($string[$k]);
      }
  }

  if (!$full) $string = array_slice($string, 0, 1);
  return $string ? implode(', ', $string) . ' ago' : 'Just now';
}


if(isset($_POST['display_orders'])){?>
  <div class="container-fluid">
	<div class="row">
		<div class="table-responsive roboto">
    <h4 class="" style="margin:0;padding-left:12px;padding-top:16px;">Orders</h4>
      <table id="orders-table" style="margin-left:0;padding-left:0;" class="table mdl-data-table roboto table-responsive" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th style="text-align:left;">Date Ordered</th>
                <th style="text-align:left;">Order #</th>
                <th>Total Price</th>
                <th style="text-align:center;">Status</th>
            </tr>
        </thead>
        <tbody>
        <?php
          $orders = $order->pending_user_orders($_SESSION['usr_id']);
          if($orders){
            foreach($orders as $o){?>
            <tr id="<?php echo $o['order_id'];?>" class="user-select-order row-hover">
              <td style="text-align:left;"><?php echo time_elapsed_string($o['created_at']);?></td>
              <td style="text-align:left;"><?php echo $o['order_id'];?></td>
              <td><?php echo $currency;?><?php echo $o['order_total'];?></td>
              <td style="text-align:center;"><span class="label label-user-status-<?php echo $o['order_status'];?>">
                <?php
                switch($o['order_status']){
                  case 0:
                    echo "Pending";
                    break;
                  case 1:
                    echo "Processing";
                    break;
                  case 2:
                    echo "Collecting Items";
                    break;
                  case 3:
                    echo "On Delivery";
                    break;
                  case 4:
                    echo "Complete";
                    break;
                  case 5:
                    echo "Declined";
                    break;
                };
                ?></span></td>
            </tr>
            <?php
            }
          }
        ?>
        </tbody>
      </table>
    </div>
	</div>
</div>
<script>
  $("#orders-table").dataTable({
    "bSort": false
  });
</script>
<?php
}

if(isset($_POST['cancel_order'])){
  $total_items = $order->count_total_items($_POST['order_id']);
  echo $order->cancel_order($_POST['order_id'],$total_items);
}

if(isset($_POST['order_info'])){
  $order_info = $order->user_order_info($_POST['order_id'],$_SESSION['usr_id']);
  if($order_info){
    foreach($order_info as $oinfo);
    $st = $order->user_order_status($_POST['order_id'],$_SESSION['usr_id']);
  ?>
  <div class="container-fluid no-gap">
    <div class="row">
      <div class="col-xs-8 col-lg-8">
        <a href="/?mod=profile&t=orders" class="btn btn-action"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;&nbsp;Back</a>
      </div>
      <?php 
      if($st == 0){
      ?>
      <div class="col-xs-4 col-lg-4">
        <div class="pull-right">
          <div class="dropdown">
            <button class="btn btn-action dropdown-toggle" type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-option-vertical" style="font-size:18px;"></span></button>
            <ul class="dropdown-menu pull-right">
              <li><a href="" id="btn-cancel-order" style="color:rgba(0,0,0,0.75);font-weight:500;" value="<?php echo $_POST['order_id'];?>"><span class="glyphicon glyphicon-remove-sign"></span>&nbsp;&nbsp;Cancel Order</a></li>
            </ul>
          </div>
        </div>
      </div>
      <?php 
      }
      ?>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-3 col-sm-2 col-lg-2" style="margin-top:16px;">
          <label class="no-gap" style="color:rgba(0,0,0,0.8);font-size:12px;font-weight:500;">Order #</label>
          <p class="no-gap" style="font-size: 13px;"><?php echo $oinfo['order_id'];?></p>
        </div>
        <div class="col-xs-9 col-sm-3 col-lg-3" style="margin-top:16px;">
          <label class="no-gap" style="color:rgba(0,0,0,0.8);font-size:12px;font-weight:500;">Date / Time Ordered</label>
          <p class="no-gap" style="font-size: 13px;"><?php $date = new DateTime($oinfo['created_at']); echo $date->format("M j, Y g:mA");?></p>
        </div>
        <div class="col-xs-12 col-sm-7 col-lg-7" style="margin-top:16px;">
          <label class="no-gap" style="color:rgba(0,0,0,0.8);font-size:12px;font-weight:500;">Contact #</label>
          <p class="no-gap" style="font-size: 13px;"><?php echo $oinfo['contact_number'];?></p>
        </div>
        <div class="col-xs-12 col-sm-7 col-lg-7" style="margin-top:16px;">
          <label class="no-gap" style="color:rgba(0,0,0,0.8);font-size:12px;font-weight:500;">Delivery Address</label>
          <p class="no-gap" style="font-size: 13px;"><?php echo $oinfo['delivery_address'];?></p>
        </div>
      </div>
    </div>
    <div class="container-fluid" style="margin-top:30px;margin-bottom:30px;">
      <div class="stepwizard">
        <div class="stepwizard-row">
          <?php
          if($st != 5){
          ?>
            <div class="stepwizard-step">
              <button type="button" class="btn btn-circle <?php if($st >= 0){ echo "success";}?>" disabled><?php if($st == 0){?><span class="glyphicon glyphicon-ok"></span><?php }?></button>
                <p>Processing</p>
            </div>
            <div class="stepwizard-step">
              <button type="button" class="btn btn-circle <?php if($st >= 1){ echo "success";}?>" disabled><?php if($st == 1){?><span class="glyphicon glyphicon-ok"></span><?php }?></button>
                <p>Approved</p>
            </div>
            <div class="stepwizard-step">
              <button type="button" class="btn btn-circle <?php if($st >= 2){ echo "success";}?>" disabled><?php if($st == 2){?><span class="glyphicon glyphicon-ok"></span><?php }?></button>
                <p>Collecting</p>
            </div>
            <div class="stepwizard-step">
              <button type="button" class="btn btn-circle <?php if($st >= 3){ echo "success";}?>" disabled><?php if($st == 3){?><span class="glyphicon glyphicon-ok"></span><?php }?></button>
                <p>On Delivery</p>
            </div>
            <div class="stepwizard-step">
              <button type="button" class="btn btn-circle <?php if($st >= 4){ echo "success";}?>" disabled><?php if($st == 4){?><span class="glyphicon glyphicon-ok"></span><?php }?></button>
                <p>Closed</p>
            </div>
          <?php
          }else{?>
            <div class="stepwizard-step">
              <button type="button" class="btn btn-circle <?php if($st >= 0){ echo "failed";}?>" disabled><span class="glyphicon glyphicon-remove"></span></button>
                <p style="color:#f72e2e;">Order Declined</p>
            </div>
          <?php  
          }
          ?>
        </div>
      </div>
    </div><!-- End status map -->
    
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6">
          <label style="color:rgba(0,0,0,0.8);font-size:12px;font-weight:500;">Ordered Items</label>
          <div class="pending-list">
            <ul class="list-group">
              <?php
              $pitems = $order->get_order_items($_POST['order_id'],$_SESSION['usr_id']);
              if($pitems){
                foreach($pitems as $pi){
                  if($pi['oi_status'] == 0){
                  ?>
                  <li style="color:rgba(0,0,0,0.4);" class="list-group-item order-item-list"><span class="pull-left"><span style="margin-right:1px;" class="circle"></span>&nbsp;&nbsp;&nbsp;<?php echo $pi['oi_qty']." x ".$pi['item_name'];?></span><span class="pull-right"><?php echo $currency.$pi['oi_subtotal'];?></span></li>
                  <?php
                  }else if($pi['oi_status'] == 1){?>
                    <li style="font-weight:500;" class="list-group-item order-item-list"><span class="pull-left"><span class="text-success glyphicon glyphicon-ok"></span>&nbsp;&nbsp;<?php echo $pi['oi_qty']." x ".$pi['item_name'];?></span><span class="pull-right"><?php echo $currency.$pi['oi_subtotal'];?></span></li>
                  <?php
                  }else if($pi['oi_status'] == 2){?>
                    <li style="color:rgba(0,0,0,0.4);" class="list-group-item order-item-list"><span class="pull-left"><span class="text-failed glyphicon glyphicon-remove"></span>&nbsp;&nbsp;<?php echo $pi['oi_qty']." x ".$pi['item_name'];?></span><span class="pull-right"><?php echo $currency.$pi['oi_subtotal'];?></span></li>
                  <?php
                  }
                }
              }else{?>
                <li class="list-group-item order-item-list">No Pending Items</li>
              <?php
              }
              ?>
            </ul>
          </div>
          <div style="margin-bottom:24px;">
          <?php
          if($st == 0){
          ?>
            <small class="text-muted no-gap">Your order is being processed and reviewed, please wait until all your items have been approved by their respective shops.</small>
          <?php
          }
          if($st == 3){?>
            <small class="text-muted no-gap">Your order is now in transit, please be patient as the estimated time of arrival may vary depending on the traffic and weather</small>
          <?php
          }
          if($st == 5){?>
            <small class="text-muted no-gap">Your order was cancelled, for more info please contact the shop by clicking the shop icons below.</small>
          <?php
          }
          ?>
          </div>
        </div>   
        <div class="col-lg-6">
          <label style="color:rgba(0,0,0,0.8);font-size:12px;font-weight:500;">Order Summary</label>
          <div class="approved-list">
            <ul class="list-group">
              <li class="list-group-item order-item-list">Number of Items<span class="pull-right"><?php echo $order->count_total_items($_POST['order_id']);?></span></li>
              <li class="list-group-item order-item-list borderless">Subtotal<span class="pull-right"><?php echo $currency.$oinfo['order_total'];?></span></li>
              <li class="list-group-item order-item-list borderless">Service Fee<span class="pull-right"><?php echo $currency.$servicefee;?></span></li>
              <li class="list-group-item order-item-list" style="font-weight:600;">Total<span class="pull-right"><?php $total = $oinfo['order_total']+$servicefee; echo $currency.number_format((float)$total, 2, '.', '');?></span></li>
            </ul>
          </div>
        </div>      
      </div><!-- End of order items list -->
      
      <div class="row">
        
        <div class="col-lg-2">
        
        </div>
      </div>
    </div>
    <div class="content-footer">
      <div class="container-fluid">
        <label style="width:100%;color:rgba(0,0,0,0.8);font-size:12px;font-weight:500;">Quick Chat</label>
        <div class="row no-gap">
          <table>
          <?php
          $sfc = $chat->shops_for_chat($_POST['order_id']);
          if($sfc){?>
            
            <tr>
            <?php
            foreach($sfc as $ch){
              ?>
              <td class="qc-button" value="<?php echo $ch['brand_id'];?>" style="padding:8px 16px 4px 16px;text-align:center;"><button type="button" class="btn btn-circle btn-default btn-lg"><img src="<?php echo $ch['usr_img'];?>" class="img-responsive"/></button></td>
              <?php
              }
              ?>
            </tr>
            <tr>
            <?php
            foreach($sfc as $ch){
            ?>
              <td style="text-align:center;"><small style="color:rgba(0,0,0,0.7);font-weight:500;font-size:13px;"><?php echo $ch['usr_name'];?></small></td>
            <?php
            }
            ?>
            </tr>
          <?php
          }
          ?>
          </table>
        </div>
      </div>
    </div>
  </div><!-- end of order info container -->
<?php
  }else{
    echo "unknown_order";
  }
}