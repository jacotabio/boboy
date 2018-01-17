<?php 

if($user->get_session()){
?>
<div class="container-fluid" style="background-color: none;">
<div class="content-wrapper" style="background: none; border: none;">
  <div class="row">
    <div class="col-md-6">
      <div class="cart-left-content">
        <h3>Your shopping cart</h3>
      </div>
    </div>
    <div class="col-md-6">
      <div class="cart-right-content" style="background:none;">
        <div class="" style="background-color: #fff; padding-bottom: 0px;border-radius:3px;border:1px solid #ddd;">
          <div id="cart-content" style="background:none;">
            <div id="loading-div" style="text-align:center;padding:150px;">
              <svg class="spinner" stroke="#5677fc" width="40px" height="40px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg"><circle class="circle" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r=30></circle></svg>
            </div>
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