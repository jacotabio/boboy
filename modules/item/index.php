<?php
if(isset($_GET['brand'])&&isset($_GET['item'])){
  $item_data = $item->get_item_and_brand($_GET['item'],$_GET['brand']);
}else{
  $item_data = $item->get_item($_GET['item']);
}
?>
<div class="container">
<div class="content-wrapper">	
<div class="item-container">	
  <?php
  if($item_data){
    foreach($item_data as $data);
  ?>
  <div class="container-fluid">	
    <div class="" style="margin-top: 24px;">
      <div class="col-md-5">
        <div class="itemview-img" style="background-image: url('<?php echo "img/upload/".$data['item_img'];?>');">
        </div>
      </div>
        
      <div class="col-md-7">
        <form id="atc-form" method="POST">
          <div class="product-brand" style="margin-top: 16px;">
            <?php echo $item->get_item_brand($data['brand_id']);?>
          </div>
          <div class="product-title uppercase" style="font-size: 24px;"><?php echo $data['item_name'];?></div>
          <div class="product-desc"><?php echo $data['item_description'];?></div>
          <hr>
          
          <div class="product-price uppercase" style="color: #333;">PHP <?php echo $data['item_price'];?></div>
          <div class="product-stock">In Stock</div>
          <input type="hidden" name="item_id" value="<?php echo $data['item_id'];?>">
          <input type="hidden" name="item_price" value="<?php echo $data['item_price'];?>">
          <?php
          if(isset($_SESSION['usr_login'])){
            if($_SESSION['usr_auth'] == 1){
          ?>
            <div class="btn-group">
            <select class="form-control" name="order_qty">
              <?php
              $x = 1;
              while($x <= 10){
              ?>
                <option value="<?php echo $x;?>"><?php echo $x;?></option>
              <?php
                $x++;
              }
              ?>
              </select>
            </div>
            <div class="btn-group cart">
              <button type="submit" name="submit" id="btn-atc" class="btn btn-primary uppercase">
                Add to cart 
              </button>            
            </div>
          <?php
            }else{
              echo "YOU ARE IN PREVIEW MODE";
            }
          }else{?>
            <div class="btn-group">
            <select class="form-control" name="order_qty">
              <?php
              $x = 1;
              while($x <= 10){
              ?>
                <option value="<?php echo $x;?>"><?php echo $x;?></option>
              <?php
                $x++;
              }
              ?>
              </select>
            </div>
            <div class="btn-group cart">
              <button type="submit" name="submit" id="btn-atc" class="btn btn-primary uppercase">
                Add to cart 
              </button>            
            </div>
          <?php
          }
          ?>
        </form>
      </div>
    </div>
  </div> 
</div>
<?php
}else{?>
  <div class="page-unavailable">
      <h2>Oops, it seems that the page you are trying to reach is unavailable<h2>
  </div>
<?php
}
?>
</div>
</div>
</div>
