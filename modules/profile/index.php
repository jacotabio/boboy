<?php
if(!$user->get_session()){
  header('location: index.php');
  exit;
}else{?>
  
<div class="container" style="margin-top: 94px;">
<div class="">
  <div class="">
    <div class="row" style="margin-top: 24px; margin-bottom: 24px;">
      <div class="col-lg-3 col-md-3">
        <div class="" style="display:inline-block;width:100%;">
          <div class="" style="display:inline-block;">
            <label class="roboto" style="padding: 16px 16px 16px 16px;margin:0;" value=""><?php echo $_SESSION['usr_name'];?><label>
          </div>
        </div>
        <!-- Sidenav Filter Left -->
          <div class="sidebar hidden-xs" style="margin-bottom: 16px;">
            
            <ul class="nav nav-stacked" style="background-color:#f9f9f9; ">
              <li class="bordered-s no-gap"><a class="thick washed roboto" href='/?mod=profile&t=orders'>Orders<span class="badge pull-right"></span></a></li>
              <li class="bordered-s no-gap"><a class="thick washed roboto" href='/?mod=profile&t=account'>Account</a></li>
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
              case 'account':
                require_once 'modules/profile/account.php';
                break;
              case 'orders':
                if(isset($_GET['o_id'])){
                  require_once 'modules/profile/order_details.php';
                }else{
                  require_once 'modules/profile/orders.php';
                }
                break;
              default:
                require_once 'modules/profile/orders.php';
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
<?php
}
?>