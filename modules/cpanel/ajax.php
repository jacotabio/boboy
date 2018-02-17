<?php
include '../../library/config.php';
include '../../classes/class.items.php';
include '../../classes/class.users.php';
include '../../classes/class.auth.php';
include '../../classes/class.brands.php';
include '../../classes/class.orders.php';

$item = new Items();
$brand = new Brands();
$user = new Users();
$order = new Orders();

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
      'i' => 'min',
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
$currency = "₱";
$sesh = true;
if(isset($_SESSION['brand_id'])){
  $sesh = true;
}

if(isset($_POST['get_chat_name'])){
  echo $user->get_name($_POST['id']);
}
if(isset($_POST['show_status'])){
  echo $brand->get_brand_status($_SESSION['brand_id']);
}

if(isset($_POST['change_status'])){
  $brand->change_brand_status($_POST['brand_id'],$_POST['checked'],1);
  if($_POST['checked']==0){
    $user->remove_cart_unavailable($_POST['brand_id']);
  }
}

if(isset($_POST['oi_remove'])){
  if($sesh == true){
    echo $order->remove_oi($_POST['oi_id'],$_POST['order_id'],$_SESSION['brand_id']);

    $total_items = $order->count_total_items($_POST['order_id']);
    $total_declined = $order->count_total_declined($_POST['order_id']);
    $total_pending = $order->count_pending_items($_POST['order_id']);
    $foo = $total_items - $total_declined;

    if($total_pending == 0 && $foo > 0){
      $order->order_pending_complete($_POST['order_id']);
    }
  }
}

if(isset($_POST['order_dash'])){
  //echo $_SESSION['brand_id'];
  $arr = $order->order_dashboard($_SESSION['brand_id']);
  foreach($arr as $a);
  $array = array();
  $array['pending'] = $a['t_pending'];
  $array['ongoing'] = $a['t_ongoing'];
  $array['total'] = $a['t_total'];
  $array['msgs'] = $a['admin_msg'];
  echo json_encode($array);
}

if(isset($_POST['cpanel_status'])){
?>
<input type="checkbox" id="id-name--1" name="set-name" class="switch-input" checked>
            <label for="id-name--1" class="switch-label roboto"><span id="show-shop-status"></span>
            </label>
<?php
}

if(isset($_POST['display_orders'])){?>
  <table id="orders-table" style="margin-left:0;padding-left:0;" class="table mdl-data-table roboto table-responsive" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th style="text-align:left;">Date Ordered</th>
                <th style="text-align:left;">Customer Name</th>
                <th style="text-align:left;">Contact #</th>
                <th>Total Price</th>
                <th style="text-align:center;">Approval</th>
                <th style="text-align:center;">Delivery Status</th>
            </tr>
        </thead>
        <tbody>
        <?php
          if($sesh == true){
            $orders = $order->pending_brand_orders($_SESSION['brand_id']);
            if($orders){
              foreach($orders as $o){
                $check_status = $order->approval_status($o['order_id'],$_SESSION['brand_id']);
                $delivery_status = $order->get_delivery_status($o['order_id'],$_SESSION['brand_id']);
                $subtotal = $order->get_order_subtotal($o['order_id'],$_SESSION['brand_id']);
                if(empty($subtotal)){
                  $subtotal = "0.00";
                }
                  //if($check_status != "Declined"){?>
                <tr id="<?php echo $o['order_id'];?>" class="select-order row-hover">
                  <td style="text-align:left;"><?php echo time_elapsed_string($o['date_ordered']);?></td>
                  <td style="text-align:left;"><?php echo $o['usr_name'];?></td>
                  <td style="text-align:left;"><?php echo $o['usr_contact']?></td>
                  <td><?php echo $currency;?><?php echo $subtotal;?></td>
                  <td style="text-align:center;"><span class="label label-approval-<?php echo $check_status;?>"><?php echo $check_status?></span></td>
                  <td style="text-align:center;">
                  <?php
                  if($check_status != "Declined"){
                  ?>
                  <span class="label label-delivery-<?php echo $delivery_status;?>"><?php echo $delivery_status;?></span>
                  <?php
                  }else{?>
                    <span class="label label-delivery-Declined">Declined</span>
                  <?php
                  }
                  ?>
                  </td>
                </tr>
                <?php
                  //}
                
              }
            }
          }
        ?>
        </tbody>
      </table>
      <script>
      $("#orders-table").dataTable({
        "bSort": false
      });
      </script>
<?php
}

if(isset($_POST['order_claimed'])){
  if($sesh == true){
    $list = $order->shop_oitems_id($_POST['order_id'],$_SESSION['brand_id']);
    if($list){
      foreach($list as $arr){
        $order->claim_cpanel_order($arr['oi_id']);   
      }
      if($order->check_claim_votes($_POST['order_id'],$_SESSION['brand_id']) == 0){
        $order->claim_order_status($_POST['order_id']);
      }
    }
  }
}

if(isset($_POST['order_ready'])){
  if($sesh == true){
    $list = $order->shop_oitems_id($_POST['order_id'],$_SESSION['brand_id']);
    if($list){
      foreach($list as $arr){
        $order->ready_cpanel_order($arr['oi_id']);   
      }
      if($order->check_ready_votes($_POST['order_id'],$_SESSION['brand_id']) == 0 && $order->count_pending_items($_POST['order_id']) == 0){
        $order->ready_order_status($_POST['order_id']);
      }
    }
  }
}

if(isset($_POST['accept_order'])){
  if($sesh == true){
    $list = $order->shop_oitems_id($_POST['order_id'],$_SESSION['brand_id']);
    if($list){
      foreach($list as $arr){
        $order->accept_cpanel_order($arr['oi_id']);   
      }
      if($order->check_order_votes($_POST['order_id'],$_SESSION['brand_id']) == 0){
        $order->approve_order_status($_POST['order_id']);
      }
    }
  }
}

if(isset($_POST['decline_order'])){
  if($sesh == true){
    $list = $order->shop_oitems_id($_POST['order_id'],$_SESSION['brand_id']);
    if($list){
      foreach($list as $arr){
        $order->decline_cpanel_order($arr['oi_id'],$_POST['order_id']);   
      }

      $total_items = $order->count_total_items($_POST['order_id']);
      $total_declined = $order->count_total_declined($_POST['order_id']);
      $total_pending = $order->count_pending_items($_POST['order_id']);
      $foo = $total_items - $total_declined;

      if($total_pending == 0 && $foo > 0){
        $order->order_pending_complete($_POST['order_id']);
      }else if($total_items == $total_declined){
        $order->decline_order_status($_POST['order_id']);
      }
    }
  }
}

if(isset($_POST['order_info'])){
  if(isset($_POST['order_id'])){
    if($sesh == true){
      $order_info = $order->get_order_customer_info($_POST['order_id'],$_SESSION['brand_id']);
      if($order_info){
        $check_status = $order->approval_status($_POST['order_id'],$_SESSION['brand_id']);
        $delivery_status = $order->get_delivery_status($_POST['order_id'],$_SESSION['brand_id']);
        foreach($order_info as $oci);
        
        // DON'T SHOW COMPLETED ORDERS HERE
        ?>
          <div class="container-fluid">
          <div class="row">
            <section class="content roboto">
              <div class="container-fluid" style="padding: 0px 0px 8px 0px;">
                <div class="row">
                  <div class="col-md-12 col-xs-12" style=" ">
                  <a href="/?mod=cpanel&t=orders" class="btn btn-action"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;&nbsp;Back</a>
                  <span class="pull-right">
                  <?php
                  if($check_status != "Declined"){
                    if($check_status == "Approved" && $delivery_status == "Complete"){?>
                      <span class="label label-success"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Approved</span>
                      <span style="font-size:10px;color:rgba(0,0,0,0.4);" class="glyphicon glyphicon-arrow-right"></span>
                      <span class='label label-success'><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Ready</span>
                      <span style="font-size:10px;color:rgba(0,0,0,0.4);" class="glyphicon glyphicon-arrow-right"></span>
                      <span class="label label-success"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Complete</span>
                    <?php
                    }else if($check_status == "Pending"){?>
                      <span class="label label-info">Pending</span>
                      <span style="font-size:10px;color:rgba(0,0,0,0.4);" class="glyphicon glyphicon-arrow-right"></span>
                      <span class="label label-muted">Approved</span>
                      <span style="font-size:10px;color:rgba(0,0,0,0.4);" class="glyphicon glyphicon-arrow-right"></span>
                      <span class='label <?php echo $delivery_status == "Ready" ? 'label-status-2' : 'label-muted'?>'><?php if($delivery_status == "Ready"){?><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;<?php }?>Ready</span>
                      <span style="font-size:10px;color:rgba(0,0,0,0.4);" class="glyphicon glyphicon-arrow-right"></span>
                      <span class="label label-muted">Complete</span>
                    <?php
                    }else{?>
                      <span class="label label-success"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Approved</span>
                      <span style="font-size:10px;color:rgba(0,0,0,0.4);" class="glyphicon glyphicon-arrow-right"></span>
                      <span class='label <?php echo $delivery_status == "Ready" ? 'label-delivery-Ready' : 'label-muted'?>'><?php if($delivery_status == "Ready"){?><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;<?php }?>Ready</span>
                      <span style="font-size:10px;color:rgba(0,0,0,0.4);" class="glyphicon glyphicon-arrow-right"></span>
                      <span class="label label-muted">Complete</span>
                    <?php
                    }
                  }else{?>
                    <span class="label label-failed"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Order Declined</span>
                  <?php
                  }
                  ?>
                  </span>
                    
                  </div>
                </div>
              </div>
              <div class="col-md-12 no-gap">
                <div class="">
                  
                  <div class="panel-body no-gap">
                    <div class="container-fluid">
                      
                      <!-- ----------------------------------------------------------- -->
                      <div class="row">
                        <div class="col-xs-12 col-sm-2 col-lg-2" style="margin-top:16px;">
                          <label class="no-gap" style="color:rgba(0,0,0,0.8);font-size:12px;font-weight:500;">Order #</label>
                          <p class="no-gap" style="font-size: 13px;"><?php echo $oci['order_id'];?></p>
                        </div>
                        <div class="col-xs-12 col-sm-3 col-lg-3" style="margin-top:16px;">
                          <label class="no-gap" style="color:rgba(0,0,0,0.8);font-size:12px;font-weight:500;">Date / Time Ordered</label>
                          <p class="no-gap" style="font-size: 13px;"><?php $date = new DateTime($oci['created_at']);echo $date->format('M j, Y g:i A');?></p>
                        </div>
                        <div class="col-xs-12 col-sm-7 col-lg-2" style="margin-top:16px;">
                          <label class="no-gap" style="color:rgba(0,0,0,0.8);font-size:12px;font-weight:500;">Contact #</label>
                          <p class="no-gap" style="font-size: 13px;"><?php echo $oci['usr_contact'];?></p>
                        </div>
                        <div class="col-xs-12 col-sm-7 col-lg-5" style="margin-top:16px;">
                          <label class="no-gap" style="color:rgba(0,0,0,0.8);font-size:12px;font-weight:500;">Customer Name</label>
                          <p class="no-gap" style="font-size: 13px;"><?php echo $oci['usr_name'];?></p>
                        </div>
                      </div>
                      <!-- ----------------------------------------------------------- -->
                    </div>
                    <div class="table-container" style="margin-top: 16px;">
                      <table class="table table-filter" style="margin-bottom:0px;">
                        <tbody>
                        <tr class="order-details">
                            <div class="container-fluid">
                              <div class="row" style="margin-bottom:8px;margin-right:0;">
                                <div class="col-xs-10 col-lg-10">
                                  <label class="no-gap" style="color:rgba(0,0,0,0.8);font-size:13px;font-weight:500;">Item</label>
                                </div>
                                <div class="col-xs-1 col-lg-1">
                                  <label class="no-gap pull-right" style="color:rgba(0,0,0,0.8);font-size:13px;font-weight:500;">Qty</label>
                                </div>
                                <div class="col-xs-1 col-lg-1">
                                  <label class="pull-right" style="t:0;color:rgba(0,0,0,0.8);font-size:13px;font-weight:500;">Price</label>
                                </div>
                              </div>
                            </div>
                        </tr>
                        <?php
                        $item_details = $order->get_order_details($_POST['order_id'],$_SESSION['brand_id']);
                        if($item_details){
                          foreach($item_details as $_i){
                            if($_i['oi_status'] == 2){?>
                              <tr class="order-details" style="background-color:rgba(0,0,0,0.04);">
                                <td>
                                  <div class="container-fluid">
                                    <div class="row">
                                      <div class="col-xs-10 col-lg-10">
                                        <div class="media">
                                          <?php
                                          if($_i['item_img'] != null){
                                          ?>
                                          <div class="media-photo pull-left" style="filter: grayscale(100%); background-image: url('<?php echo "img/upload/".$_i['item_img'];?>');">
                                          </div>	
                                          <?php 
                                          }else{?>
                                          <div class="media-photo pull-left" style="background-image: url('img/no-image.png');">
                                          </div>
                                          <?php
                                          }
                                          ?>
                                          <div class="media-body">
                                            <h4 class="title" style="color:rgba(0,0,0,0.5);">
                                              <?php echo $_i['item_name'];?>
                                            </h4>
                                            <p class="summary" style="color:rgba(0,0,0,0.5);max-width:350px;"><?php echo $_i['item_description'];?></p>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-xs-1 col-lg-1" style="margin-top:4px;">
                                        <span class="media-meta pull-right" style="padding-right:8px;color:rgba(0,0,0,0.5);font-weight:400;font-size:13px;"><?php echo $_i['oi_qty'];?></span>
                                      </div>
                                      <div class="col-xs-1 col-lg-1" style="margin-top:4px;">
                                        <span class="media-meta pull-right" style="padding-right:8px;color:rgba(0,0,0,0.5);font-weight:400;font-size:13px;"><?php echo $currency.$_i['item_price'];?></span>
                                      </div>
                                      <?php
                                      if($check_status == "Pending"){
                                      ?>
                                      <div class="pull-right" style="margin-top:8px;">
                                          <label type="button" id="" class="oi-removed" style="margin-right:16px;" value="<?php echo $_i['oi_id'];?>">
                                            Removed
                                          </label>
                                      </div>
                                      <?php
                                      }
                                      ?>
                                    </div>
                                  </div>
                                  
                                </td>
                              </tr>
                            <?php
                            }else{?>
                            <tr class="order-details">
                              <td>
                              <div class="container-fluid">
                                <div class="row">
                                  <div class="col-xs-10 col-lg-10">
                                    <div class="media">
                                      <?php
                                      if($_i['item_img'] != null){
                                      ?>
                                      <div class="media-photo pull-left" style="background-image: url('<?php echo "img/upload/".$_i['item_img'];?>');">
                                      </div>	
                                      <?php 
                                      }else{?>
                                      <div class="media-photo pull-left" style="background-image: url('img/no-image.png');">
                                      </div>
                                      <?php
                                      }
                                      ?>
                                      <div class="media-body">
                                        <h4 class="title">
                                          <?php echo $_i['item_name'];?>
                                        </h4>
                                        <p class="summary hidden-xs" style="max-width:350px;"><?php echo $_i['item_description'];?></p>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-xs-1 col-lg-1" style="margin-top:4px;">
                                    <span class="media-meta pull-right" style="padding-right:8px;color:rgba(0,0,0,0.8);font-weight:400;font-size:13px;"><?php echo $_i['oi_qty'];?></span>
                                  </div>
                                  <div class="col-xs-1 col-lg-1" style="margin-top:4px;">
                                    <span class="media-meta pull-right" style="padding-right:8px;color:rgba(0,0,0,0.8);font-weight:400;font-size:13px;"><?php echo $currency.$_i['item_price'];?></span>
                                  </div>
                                  <?php
                                  if($check_status == "Pending"){?>
                                    <div class="pull-right" style="margin-top:8px;">
                                      <button type="button" id="" class="oi-remove btn btn-action" style="margin-right:16px;" value="<?php echo $_i['oi_id'];?>">
                                        <span class="glyphicon glyphicon-trash"></span>
                                      </button>
                                    </div>
                                    <?php
                                  }
                                  ?>
                                </div>
                              </div>
                              
                            </td>
                          </tr>
                            <?php
                            }
                            }
                          }
                          ?>
                        </tbody>
                      </table>
                      <?php 
                      $subtotal = $order->get_order_subtotal($_POST['order_id'],$_SESSION['brand_id']);
                      if(empty($subtotal)){
                        $subtotal = "0.00";
                      }
                      ?>
                      <div class="container-fluid pull-right" style="">
                          <div class="" style="display:inline-block;padding:16px 10px 16px 10px;">
                            <label style="t:0;color:rgba(0,0,0,0.8);font-size:13px;font-weight:500;">Subtotal</label></br>
                            <span class=""><?php echo $currency.$subtotal;?></span>
                          </div>  
                      </div>
                    </div>
                  </div>
                </div>
                <div class="content-footer">
                  <div class="pull-left">
                    <button type="button" id="open-chat" class="btn btn-action" value="<?php echo $oci['usr_id']?>"><span class="glyphicon glyphicon-comment"></span>&nbsp;&nbsp;Message</button>
                  </div>
                  <div class="pull-right">
                    <?php
                    if($check_status == "Approved" && $delivery_status == "Complete"){?>
                      <span class="label label-clean"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Order Completed</span>
                    <?php
                    }else if($check_status == "Approved" && $delivery_status == "Ready"){?>
                      <small style="margin-right:5px;"></small>
                      <button type="button" id="order-claimed" style="font-size:12px;font-weight:500;" class="btn btn-action-primary" value="<?php echo $oci['usr_id']?>"><i class="fa fa-truck"></i>&nbsp;&nbsp;Mark as Claimed</button>
                    <?php
                    }else if($check_status == "Approved"){?>
                      <small class="text-muted" style="margin-right:8px;">Click the button if the order is now ready</small>
                      <button type="button" id="order-ready" class="btn btn-action" value="<?php echo $oci['usr_id']?>"><span class="glyphicon glyphicon-ok-sign"></span>&nbsp;&nbsp;Ready For Pick Up</button>
                    <?php
                    }else if($check_status == "Pending"){
                    ?>
                    <button type="button" id="accept-order" class="btn btn-action"><span class="glyphicon glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Approve</button>
                    <button type="button" id="decline-order" class="btn btn-action"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Decline</button>
                    <?php
                    }else{?>
                      <span style="margin-right:16px;color:red;" class="label label-clean"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Declined</span>
                    <?php
                    }
                    ?>
                    <div id="order-loading" style="display:inline-block;margin-right:30px;">
                    <svg class="spinner" stroke="#5677fc" width="30px" height="30px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg"><circle class="circle" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r=30></circle></svg>
                    </div>
                  </div>
                </div>
              </div>
            </section>
            
          </div>
        </div>
        <?php
        //}
      }else{
        echo "order_unavailable";
      }
    }
  }
}
?>
