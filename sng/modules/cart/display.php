<?php
include '../../library/config.php';
include '../../classes/class.items.php';

$item = new Items();

if(isset($_POST['display_cart'])){
  $cart = $item->get_cart($_SESSION['usr_id']);
  if($cart){
?>
<table class="table table-borderless" style="margin-top: 24px;">
  
  <tr class="text-light">
    <th class="text-center">QTY</th>
    <th>ITEM</th>
    <th class="text-right">PRICE</th>
    <th></th>
  </tr>
  <?php 
    foreach($cart as $c){
  ?>
  <tr>
    <td class="text-center"><?php echo $c['item_qty'];?></td>
    <td><?php echo $item->get_item_name($c['item_id']);?></td>
    <td class="text-right cart-price">&#8369;<?php echo $c['subtotal'];?></td>
    <td class="text-right"><a class="btn glyphicon glyphicon-remove" onclick="remove_cart_show(<?php echo $c['cart_id'];?>)"></button></td>
  </tr>
  <?php
    }
  ?>
</table>
<div class="row">
  <div class="col-md-8">
    <div class="container-fluid">
      <span class="cart-total-label">Total:</span><span class="cart-total">&#8369;<?php echo $item->cart_sum_total($_SESSION['usr_id']);?></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="container-fluid">
      <button id="btn-order" class="btn btn-primary">ORDER</button>
    </div>
  </div>
</div>
<?php
  }else{?>
    <div class="container-fluid">
      <h5 class="cart-empty-label">Your cart is empty<h5>
      <a style="width:100%;text-align:center;display: block; margin-top: 16px;margin-bottom: 200px;" href="index.php?mod=shop">Click here to continue shopping</a>
    </div>
  <?php
  }
}
?>
<script>

</script>