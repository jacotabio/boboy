<?php
include '../../library/config.php';
include '../../classes/class.items.php';
include '../../classes/class.brands.php';

$item = new Items();
$brand = new Brands();
function substrwords($text, $maxchar, $end='...') {
  if (strlen($text) > $maxchar || $text == '') {
      $words = preg_split('/\s/', $text);      
      $output = '';
      $i      = 0;
      while (1) {
          $length = strlen($output)+strlen($words[$i]);
          if ($length > $maxchar) {
              break;
          } 
          else {
              $output .= " " . $words[$i];
              ++$i;
          }
      }
      $output .= $end;
  } 
  else {
      $output = $text;
  }
  return $output;
}


if(isset($_POST['realtime_shop_popup'])){
  echo "2";
}

if(isset($_POST['display_active_shops'])){?>
  <div class="hidden-xs hidden-sm roboto">
  <span style="font-weight: 500;font-size:13px;color:rgba(0,0,0,0.65);">Active Shops</span>
    <ul class="list-group"> 
  <?php
  $b = $brand->get_all_brand_status();
  foreach($b as $_b){?>
      <li class="list-group-item borderless" style="font-size:13px;font-weight:500;"><span class="indicator<?php echo $_b['brand_status'];?>">&#9679;</span>&nbsp;&nbsp;<?php echo $_b['brand_name'];?></li>
  <?php  
  }
  ?>
    </ul>
  </div>
  <?php
}

if(isset($_POST['display_shop'])){?>
  <div class="col-lg-12 col-xs-12">
    <div class="container-fluid">
      <?php 
      // CHECK DISPLAY CONDITION
      if(isset($_POST['search_val']) && $_POST['search_val'] != ""){
        if(isset($_POST['brand_id']) && $_POST['brand_id'] != ""){
          $items = $item->get_shop_items_search_and_brand($_POST['search_val'],$_POST['brand_id']);
        }else{
          $items = $item->get_shop_items_search($_POST['search_val']);
        }
        ?>
        <h5 class="light-text">Showing results for '<?php echo $_POST['search_val']?>'</h5>
      <?php
      }else if(isset($_POST['brand_id']) && $_POST['brand_id'] != ""){
        $items = $item->get_shop_items_by_brand($_POST['brand_id']);
      }else{
        $items = $item->get_shop_items();
      }

        // CHECK RETRIEVE BEFORE DISPLAY
        if($items){
        ?>
        <div class="row panel aligned-row" style="border:1px solid #ddd;padding:4px;">
          <?php
          foreach($items as $i) {
            $img = $i['item_img'];
          ?>
          <div class="col-xs-6 col-sm-4 col-md-3 col-lg-3 shop-margin">
            <div class="item-holder">
              <?php
              if(isset($_POST['brand_id']) && $_POST['brand_id'] != ""){?>
                <a href="/?mod=shop&brand=<?php echo $_POST['brand_id'];?>&item=<?php echo $i['item_id'];?>">
                <?php
                }else{?>
                <a href="/?mod=shop&item=<?php echo $i['item_id'];?>">
                <?php
                }
                ?>
                  <div class="item-image img-responsive" style="max-height:200px;background-image: url('<?php echo "img/upload/".$img;?>');">
                  </div>
                  <div class="item-brand">
                    <?php echo $item->get_item_brand($i['brand_id']);?>
                  </div>
                  <div class="item-name">
                    <?php echo $i['item_name'];?>
                  </div>
                  <div class="item-description">
                    <?php echo substrwords($i['item_description'],90);?>
                  </div>
                  <div class="item-price">
                    PHP <?php echo $i['item_price'];?>
                  </div>
                </a>
            </div>
          </div>
          <?php
          }
          ?>
        </div>
        <?php
        }else{?>
          <div class="row panel" style="padding-top: 200px; padding-bottom: 200px;border:1px solid #ddd;">
              <h4 class="small text-center">No items found<h4>
          </div>
        <?php
        }
        ?>
    </div>
    <div class="">
      <?php
      $notav = $item->get_unavailable_items();
      if($notav){
      ?>
      <span style="font-weight: 500;font-size:13px;color:rgba(0,0,0,0.65);">Unavailable Items</span>
      <div class="container-fluid" style="margin-top:8px;">
        <div class="row panel aligned-row" style="border:1px solid #ddd;padding:4px;">
          <?php
          foreach($notav as $unavail) {
            $img = $unavail['item_img'];
          ?>
          <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 shop-margin">
              <div class="item-holder">
                <div class="item-image img-responsive" style="filter: grayscale(100%);background-image: url('<?php echo "img/upload/".$img;?>');">
                </div>
                <div class="item-brand">
                  <?php echo $item->get_item_brand($unavail['brand_id']);?>
                </div>
                <div class="item-name" style="color: rgba(0,0,0,0.7);">
                  <?php echo $unavail['item_name'];?>
                </div>
                <div class="item-description">
                  <?php echo substrwords($unavail['item_description'],1);?>
                </div>
                <div class="item-price">
                  PHP <?php echo $unavail['item_price'];?>
                </div>
                
              </div>
          </div>
          <?php
          }
          ?>
        </div>
      </div>
      <?php
      }
      ?>
    </div>
  </div>
      <?php
      }
      ?>
