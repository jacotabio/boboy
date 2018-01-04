<?php 

if($user->get_session()){
?>
<div class="container" style="background-color: none;">
<div class="content-wrapper" style="background: none; border: none;">
  <div class="row">
    <div class="col-md-6">
      <div class="cart-left-content">
        <h3>Your shopping cart</h3>
      </div>
    </div>
    <div class="col-md-6">
      <div class="cart-right-content">
        <div class="container-fluid border-radius" style="background-color: #fff; padding-bottom: 24px;">
          <div id="cart-content">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<?php
}else{
    header('location: /');
}
?>