<?php
include '../../library/config.php';
include '../../classes/class.orders.php';
include '../../classes/class.items.php';

$order = new Orders();
$item = new Items();

$currency = "₱ ";

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if(isset($_POST['delete_order'])){
	if($order->delete_order($_POST['order_id'])){
		echo "delete_success";
	}else{
		echo "delete_failed";
	}
}

if(isset($_POST['close_order'])){
	if($order->close_order($_POST['order_id'])){
		echo "close_success";
	}
}

if(isset($_POST['create_order'])){
	$fullname = test_input($_POST['fullname']);
	$address = test_input($_POST['address']);
	$phone = test_input($_POST['phone']);

	$arr = array();

	if(!preg_match("/^[a-zA-Z '-.]*$/",$fullname) || $fullname == "" || $fullname == null) {
		$arr['name-input'] = 0;
	}else{
		$arr['name-input'] = 1;
	}

	if(!preg_match("/^[0-9]{11,11}$/", $phone) || $phone == "" || $phone == null){
		$arr['phone-input'] = 0;
	}else{
		$arr['phone-input'] = 1;
	}

	if(!preg_match("/^[a-zA-Z 0-9-._,()#]*$/",$address) || $address == "" || $address == null){
		$arr['address-input'] = 0;
	}else{
		$arr['address-input'] = 1;
	}
	$ctr = 0;
	foreach($arr as $a){
		if($a == 0){
			$ctr++;
		}
	}
	if($ctr != 0){
		$arr['code'] = "invalid";
		echo json_encode($arr);
	}else{
		$arr['code'] = "valid";

		// Create order & return ID
		if($order_id = $order->create_order($fullname,$address,$phone)){
			$items = $item->get_cart();
			/*foreach($items as $i){

			}*/
		}
		echo json_encode($arr);
	}
	

}
if(isset($_POST['order_view'])){
	$get = $order->order_details($_POST['order_id']);
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
	            	<div class="row">
	            		<div class="col-lg-1">
	            			<a class="btn btn-default" href="/admin/?p=orders"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
	            		</div>
	            		<div class="col-lg-10">
	            			<h4 style="font-size:18px;margin-top:5px;" class="card-title pull-left">Order #<?php echo $g['order_id'];?></h4>
	            		</div>
	            		<div class="col-lg-1">
	            			<div style="display:inline-block; width:100%;">
			                  <div class="pull-right">
			                    <div class="btn-group">
			                      <i class="fa fa-ellipsis-v button" style="font-size:20px;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			                      </i>
			                      <div class="dropdown-menu dropdown-menu-right">
			                        <button id="tmodal-order-del" value="<?php echo $_POST['order_id']?>" class="dropdown-item pointer" type="button">Delete Order</button>
			                      </div>
			                    </div>
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
	                        	<?php 
	                            $os = $g['order_status'];
	                            if($os != 5){
	                            ?>
	                            <div class="stepwizard-step">
	                              <button type="button" class="btn btn-circle step-circle <?php echo ($os >= 0)?'btn-success':'';?>"><?php if($os >= 0){?><span class=""><i class="fa fa-check" aria-hidden="true"></i></span><?php }?></button>
	                                <p>Processing</p>
	                            </div>
	                            <div class="stepwizard-step">
	                              <button type="button" class="btn btn-circle step-circle <?php echo ($os >= 1)?'btn-success':'';?>"><?php if($os >= 1){?><span class=""><i class="fa fa-check" aria-hidden="true"></i></span><?php }?></button>
	                                <p>Approved</p>
	                            </div>
	                            <div class="stepwizard-step">
	                              <button type="button" class="btn btn-circle step-circle <?php echo ($os >= 2)?'btn-success':'';?>"><?php if($os >= 2){?><span class=""><i class="fa fa-check" aria-hidden="true"></i></span><?php }?></button>
	                                <p>Collecting</p>
	                            </div>
	                            <div class="stepwizard-step">
	                              <button type="button" class="btn btn-circle step-circle <?php echo ($os >= 3)?'btn-success':'';?>"><?php if($os >= 3){?><span class=""><i class="fa fa-check" aria-hidden="true"></i></span><?php }?></button>
	                                <p>On Delivery</p>
	                            </div>
	                            <div class="stepwizard-step">
	                              <button type="button" class="btn btn-circle step-circle <?php echo ($os >= 4)?'btn-success':'';?>"><?php if($os >= 4){?><span class=""><i class="fa fa-check" aria-hidden="true"></i></span><?php }?></button>
	                                <p>Closed</p>
	                            </div>
	                            <?php
								}else{?>
								<div class="stepwizard-step">
	                              <button type="button" class="btn btn-circle step-circle btn-danger"><?php if($os >= 4){?><span class=""><i class="fa fa-times" aria-hidden="true"></i></span><?php }?></button>
	                                <p>Declined</p>
	                            </div>
								<?php
								}
	                            ?>
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
	                            <li class="list-group-item oi-status-<?php echo $oi['oi_status'];?>"><?php if($oi['oi_status'] == 0){?><span style="padding-left:2px;padding-right:1px;">&#9679;</span>&nbsp;&nbsp;<?php }else if($oi['oi_status'] == 1){?><span style="font-weight:bold;" class="text-success">&#10004;</span>&nbsp;&nbsp;<?php }else{?><span style="font-weight:bold;" class="text-danger">&#10006;</span>&nbsp;&nbsp;<?php }?><?php echo $oi['oi_qty']." x ".$oi['item_name'];?><span class="float-right"><?php echo $currency.$oi['item_price'];?></span></li>
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
	                      <li class="list-group-item">Number of Items<span id="od-noi" class="float-right"><?php echo $g['noi'];?></span></li>
	                      <li class="list-group-item list-borderless">Subtotal<span id="od-st" class="float-right"><?php echo $g['subtotal'];?></span></li>
	                      <li class="list-group-item list-borderless">Service Fee<span id="od-sf" class="float-right"><?php echo $g['service_fee'];?></span></li>
	                      <li class="list-group-item">Total<span id="od-tt" class="float-right"><?php echo $g['total'];?></span></li>
	                    </ul>
	                    <?php
	                    if($os == 3){
	                    ?>
	                    <button id="btn-close-order" style="margin-top:8px;width:100%;" class="btn btn-themecolor">Close Order</button>
	                    <?php
						}
	                    ?>
	                  </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	<?php
	}
}

if(isset($_POST['order_atc'])){
	$qty = test_input($_POST['qty']);

	if(!preg_match("/^[0-9]*$/",$qty) || $qty == "" || $qty == null || $qty == 0 || $qty == "0"){
		echo "invalid";
	}else{
		echo $atc = $order->add_cart($_POST['id'],$qty);
	}
}

if(isset($_POST['load_cart'])){?>
    <ul class="list-group" style="overflow-y: scroll;min-height:262px;height:262px;max-height:262px;border:1px solid #ddd;">
                                                <?php
                                                $cart = $item->get_cart();
                                                if($cart){
                                                    foreach($cart as $c){?>
                                                <li class="list-group-item cart-item">
                                                    <div class="row">
                                                        <div class="col-lg-1">
                                                            <i style="color:red;" class="fa fa-minus-circle btn-remove-cart" id="<?php echo $c['cart_id'];?>"></i>
                                                        </div>
                                                        <div class="col-lg-7">
                                                            <?php echo $c['item_name'];?>
                                                        </div>
                                                        <div class="col-lg-1">
                                                            <?php echo $c['item_qty'];?>
                                                        </div>
                                                        <div class="col-lg-3">X
                                                            <span class="float-right"><?php echo $currency.$c['subtotal'];?></span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <?php 
                                                    }?>

                                                <?php
                                                }else{?>
                                                    <p style="width:100%;text-align:center;margin-top:30%;">No items added</p>
                                                <?php
                                                }
                                                ?>

                                            </ul>
                                            <li class="list-group-item" style="border-radius: 0;border-top:none;">
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                        <span style="font-weight:600;">Total Amount</span>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                        <span class="float-right"><?php echo $currency.$item->cart_total();?></span>
                                                    </div>
                                                </div>
                                            </li>
                                            <?php
}

if(isset($_POST['remove_cart'])){
	if($item->remove_cart($_POST['cart_id'])){
		echo "remove_success";
	}
}