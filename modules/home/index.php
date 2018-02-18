<?php
if(isset($_SESSION['usr_auth']) && $_SESSION['usr_auth'] == 2){
  header("location: /?mod=cpanel");
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="container-fluid">
                  <div class="panel panel-default" style="border:1px solid #ddd;">
                      <div class="panel-heading">
                          <span class="uppercase">Trending Sellers</span>
                      </div>
                      <div class="panel-body no-gap">
                          <div class="container-fluid" style="">
                              <div class="row aligned-row">
                                  <?php
                                  $home = $item->get_home_items();
                                  if($home){
                                    foreach($home as $i){
                                  ?>
                                  <div class="col-xs-6 col-sm-4 col-md-3 col-lg-3 shop-margin">
                                    <div class="item-holder">
                                      <a href="<?php echo $url_str;?>?mod=shop&item=<?php echo $i['item_id'];?>">
                                        <div class="item-image img-responsive" style="max-height:200px;background-image: url('<?php echo "img/upload/".$i['item_img'];?>');">
                                        </div>
                                        <div class="item-brand">
                                          <?php echo $item->get_item_brand($i['brand_id']);?>
                                        </div>
                                        <div class="item-name">
                                          <?php echo $i['item_name'];?>
                                        </div>
                                        <div class="item-description">
                                          <?php echo $i['item_description'];?>
                                        </div>
                                        <div class="item-price">
                                          PHP <?php echo $i['item_price'];?>
                                        </div>
                                      </a>
                                    </div>
                                  </div>
                                  <?php
                                    }
                                  }else{?>
                                   <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 shop-margin">
                                    <div class="item-holder" style="text-align:center;padding:150px;">
                                        No Items Available
                                    </div>
                                  </div>
                                  <?php
                                  }
                                  ?>
                              </div>
                          </div>
                      </div>
                  </div>   
            </div>
        </div>
    </div>
</div>