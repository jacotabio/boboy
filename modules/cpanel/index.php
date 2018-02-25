
<div class="container" style="margin-top: 94px;">
<div class="">
  <div class="">
    <div class="row" style="margin-top: 24px; margin-bottom: 24px;">
      <div class="col-lg-3 col-md-3">
        <div class="" style="display:inline-block;width:100%;background:#fff;border:1px solid rgba(0,0,0,0.1);">
          <div class="" style="display:inline-block;">
            <label id="shop-cpanel-id" class="roboto" style="padding: 16px 16px 16px 16px;margin:0;" value="<?php echo $_SESSION['brand_id'];?>"><?php echo $_SESSION['usr_name'];?><label>
          </div>
          <div id="shop-status-container" style="display:none;float:right;margin-right:0;padding-right:0;">
            <?php 
            if($brand->get_brand_status($_SESSION['brand_id']) == 1){
            ?>
            <input type="checkbox" id="id-name--1" name="set-name" class="switch-input" checked>
            <?php 
            }else{
            ?>
            <input type="checkbox" id="id-name--1" name="set-name" class="switch-input">
            <?php
            }
            ?>
            <label for="id-name--1" class="switch-label roboto"><span id="show-shop-status">&nbsp;</span>
            </label>
          </div>
        </div>
        <!-- Sidenav Filter Left -->
          <div class="sidebar" style="margin-bottom: 16px;">
            <span style="padding-top:14px;padding-bottom:4px;display:block;" class="thick">Control Panel</span>
            <ul class="nav nav-stacked" style="background-color:#ffffff; ">
              <li class="bordered-s no-gap"><a href='/?mod=cpanel'>Dashboard</a></li>
              <li class="bordered-s no-gap"><a href='/?mod=cpanel&t=orders'>Orders<span id="order-badge-counter" class="badge pull-right"></span></a></li>
              <li class="bordered-s no-gap"><a href='/?mod=cpanel&t=items'>My Items</a></li>
              <li class="bordered-s no-gap"><a href='/?mod=cpanel&t=account'>Account</a></li>
            </ul>
            <span style="padding-top:14px;padding-bottom:4px;display:block;" class="thick">Boboy Support</span>
            <ul class="nav nav-stacked" style="background-color:#ffffff;">
              <li class="bordered-s no-gap"><a href='/?mod=cpanel&t=messages'>Admin<span id="admin-counter" class="pull-right badge" style="margin-top:2px;background-color: #ff1740;"></span></a></li>
            </ul>
          </div>
          <!-- End of Sidenav -->
      </div>
      <!-- Shop Content/Item list -->
      <div class="container-fluid">
        <div class="col-lg-9 col-md-9" style="margin:0;padding:0;">
          <div class="main-wrapper bordered">
          <?php
            switch($t){
              case 'items':
                if(isset($_GET['q'])){
                  require_once 'modules/cpanel/itemview.php';
                }else{
                  require_once 'modules/cpanel/items.php';
                }
                break;
              case 'account':
                require_once 'modules/cpanel/account.php';
                break;
              case 'orders':
                if(isset($_GET['o_id'])){
                  require_once 'modules/cpanel/order_details.php';
                }else{
                  require_once 'modules/cpanel/orders.php';
                }
                break;
              case 'messages':
                require_once 'modules/cpanel/messages.php';
                break;
              default:
                require_once 'modules/cpanel/dashboard.php';
                break;
            }
          ?>
          </div>
        </div>
      </div>
      <!-- End of Shop/Item list -->
    </div>
  </div>
</div>
</div>