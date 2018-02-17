<?php
if(isset($_GET['action']) && $_GET['action'] == "new"){?>
<div class="row">
    <!-- column -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title">Create Order</h4>
                <h6 class="card-subtitle"></h6>
                <div class="">
                    <form id="form-create-order" method="POST">
                        <div style="margin-bottom:24px;margin-top:24px;">
                            <div id="name-input" class="form-group col-lg-4" style="display:inline-block;margin:0;padding:0;">
                                <label class="col-md-12 control-label">Customer Name</label>
                                <div class="col-lg-12 col-md-12">
                                    <input name="fullname" type="text" value="" placeholder="Customer Name" class="form-control input-sm" required>
                                    <label id="name-input-error" style="display:none;" class="control-label text-error">No special characters allowed</label>
                                </div>
                            </div>
                            <div id="address-input" class="form-group col-lg-4" style="display:inline-block;margin:0;padding:0;">
                                <label class="col-md-12 control-label">Delivery Address</label>
                                <div class="col-lg-12 col-md-12">
                                    <input name="address" type="text" value="" placeholder="Delivery Address" class="form-control input-sm" required>
                                    <label id="address-input-error" style="display:none;" class="control-label text-error">No special characters allowed</label>
                                </div>
                            </div>
                            <div id="phone-input" class="form-group" style="display:inline-block;margin:0;padding:0;width:32.7%;">
                                <label class="col-md-12 control-label">Phone #</label>
                                <div class="col-lg-12 col-md-12">
                                    <input name="phone" type="text" value="" placeholder="Phone #" class="form-control input-sm" required>
                                    <label id="phone-input-error" style="display:none;" class="control-label text-error">No special characters allowed</label>
                                </div>
                            </div>
                        </div>
                        <div class="container" style="background-color:;">
                            
                            <div class="row">
                                <div class="col-lg-6 col-md-6" style="">
                                    <label class="control-label">Available Items</label>
                                    <li class="list-group-item search-item" style="margin:0;padding:0;"><input id="item-search-input" type="text" class="form-control input-sm" placeholder="Search"></li>
                                    <ul id="ul-item-list" class="list-group" style="overflow-y: scroll;min-height:262px;height:262px;max-height:262px;border-right:1px solid #ddd;border-left:1px solid #ddd;border-bottom:1px solid #ddd;">

                                        <?php
                                        $list = $item->get_items();
                                        if($list){
                                            foreach($list as $i){?>
                                                <li class="list-group-item item" value="<?php echo $i['item_id'];?>"><span style="font-weight:600;color:rgba(0,0,0,0.65);"><?php echo $i['brand_name'];?></span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="name"><?php echo $i['item_name'];?></span><span class="float-right"><?php echo $currency.$i['item_price'];?></span></li>
                                            <?php
                                            }
                                        }else{
                                            echo "No Items";
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <div class="col-lg-6 col-md-6" style="">
                                    <label class="control-label">Items</label>
                                        <div id="cart-items">
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
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="container" style="margin-top:48px;">
                            <div class="form-group float-right">
                                <button type="submit" class="btn btn-themecolor">Submit Order</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}else{
?>
<div class="row">
    <!-- column -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title">Ongoing Orders</h4>
                <h6 class="card-subtitle">Display all pending orders of customers</h6>
                <div class="table-responsive">
                <table id="table-pending-orders" class="table table-hover pointer" cellspacing="0" width="100%" style="margin:0;padding:0;">
                    <thead>
                        <tr>
                            <th style="text-align:left;">Order #</th>
                            <th style="text-align:left;">Date/Time Ordered</th>
                            <th style="text-align:left;">Customer</th>
                            <th style="text-align:right;">Total Price</th>
                            <th style="text-align:right;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}
?>