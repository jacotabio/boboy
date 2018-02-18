<?php
include '../../library/config.php';
include '../../classes/class.items.php';
include '../../classes/class.fees.php';

$item = new Items();
$fee = new Fees();

$currency = "₱ ";

if(isset($_POST['display_cart'])){
  $cart = $item->get_cart($_SESSION['usr_id']);
  if($cart){
?>
<table class="table" style="margin:0px;">
  <tr class="cart-header" style="">
    <th class="text-right"></th>
    <th class="text-left">Item Name</th>
    <th class="text-right">Quantity</th>
    <th class="text-right tbl-right">Price</th>
  </tr>
  <?php 
    foreach($cart as $c){
  ?>
  <tr class="cart-row" id="<?php echo $c['cart_id'];?>">
    <td class="text-right tbl-left" style="width:10%;"><span class="cart-remove-btn glyphicon glyphicon-remove"></span></td>
    <td class="cart-name text-left"><?php echo $item->get_item_name($c['item_id']);?></td>
    <td class="cart-qty text-right"><?php echo $c['item_qty'];?></td>
    <td class="text-right cart-price tbl-right"><?php echo $currency.$c['subtotal'];?></td>
  </tr>
  <?php
    }
  ?>
  <tr style="border-bottom:1px solid red;">
    <td class="cart-qty text-right"></td>
    <td style="padding-top:16px;padding-bottom:16px;" class="cart-subtotal text-left">Service Fee</td>
    <td class="text-right"></td>
    <td style="padding-top:16px;padding-bottom: 16px;" class="text-right cart-total tbl-right"><?php $sf = $fee->get_service_fee(); echo $currency.$sf?></td>
  </tr>
  <tr style="border-bottom:1px solid red;">
    <td class="cart-qty text-right"></td>
    <td style="padding-top:16px;padding-bottom:16px;" class="cart-subtotal text-left">Subtotal</td>
    <td class="text-right"></td>
    <td style="padding-top:16px;padding-bottom: 16px;" class="text-right cart-total tbl-right"><?php $st = $item->cart_sum_total($_SESSION['usr_id']); $total = $sf + $st; echo $currency.number_format($total,2);?></td>
  </tr>
  <tr>
    <td class="cart-qty text-right"></td>
    <td style="padding-top:16px;padding-bottom:16px;" class="cart-subtotal text-left"></td>
    <td class="text-right"></td>
    <td style="padding-top:16px;padding-bottom: 16px;" class="text-right cart-total tbl-right">
      <div class="modal-footer no-gap">
        <button type="button" class="btn btn-dialog no-gap" style="height:auto;font-size:14px;" id="btn-order" data-dismiss="modal">Continue&nbsp;<span class="glyphicon glyphicon-chevron-right"></span></button>
      </div>
    </td>
  </tr>
</table>
<?php
  }else{?>
    <div class="container-fluid">
      <h5 class="cart-empty-label">Your cart is empty<h5>
      <a style="width:100%;text-align:center;display: block; margin-top: 16px;margin-bottom: 200px;" href="/?mod=shop">Click here to continue shopping</a>
    </div>
  <?php
  }
}
?>
<script>

</script>