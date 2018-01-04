<div class="container-fluid" style="margin-top: 70px;">
</div>
<div style="margin-top: 50px;">
<?php
if(isset($_GET['item'])){?>
  <div class="">
    <?php
    require_once 'modules/item/index.php';
    ?>
  </div>
<?php
}else{
?>
<div class="container">
  <div class="">
    <div class="">
      <div class="row">
        <div class="col-lg-2 no-gap">
          <div id="active-shops-container" class="container-fluid">
          </div>
        </div>
        <div class="col-lg-10 no-gap">
          <div class="col-xs-12 col-lg-12 no-gap">
            <div class="col-xs-3" style="margin-right:0;padding-right:0;">
              <span style="font-weight: 500;font-size:13px;color:rgba(0,0,0,0.65);">Filter By</span>
              <?php
                $brands = $brand->get_brands();
                if($brands){
                ?>
                <select id="shop-filter-by" class="form-control">
                  <option value="0" <?php echo isset($_GET['brand']) && $_GET['brand'] == null ? 'selected' : ''?>>All</option>
                  <?php
                  foreach($brands as $b){?>
                    <option style="padding: 25px !important;margin:24px !important;" value="<?php echo $b['brand_id'];?>" <?php echo isset($_GET['brand']) && $_GET['brand'] == $b['brand_id'] ? 'selected' : ''?>><?php echo $b['brand_name'];?></option>
                  <?php
                  }
                  ?>
                </select>
              <?php
              }
              ?>
            </div>
            <div class="col-xs-9">
              <span style="font-weight: 500;font-size:13px;color:rgba(0,0,0,0.65);">Search</span>
              <div class="">
                <form id="shop-search-item" class="form-horizontal">
                  <div class="form-group">
                    <div class="col-md-12">
                      <input id="shop-search-value" name="shop-search-value" type="text" class="form-control" autocomplete="off" placeholder="Search" value="<?php if(isset($_GET['search'])){echo $_GET['search'];}?>">
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          
          <!-- START ajax call -->
          <div id="shop-ajax-content">
            <div class="col-lg-12 col-xs-12">
              <div class="container-fluid">
                <div class="row panel align-row" style="border:1px solid #ddd;text-align:center;padding-top:100px;padding-bottom:100px;">
                  <svg class="spinner" stroke="#5677fc" width="50px" height="50px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg"><circle class="circle" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle></svg>
                </div>
              </div>
            </div>
          </div>
          <!-- END ajax call-->
        </div>
      </div>
    </div>
  </div>
</div>
<?php
}
?>
</div>