<?php
$q = $item->get_itemview($_GET['q'],$_SESSION['brand_id']);
if($q){
  foreach($q as $_q);
?>
<div class="container-fluid no-gap">
  <a href="/?mod=cpanel&t=items" class="btn btn-action" style="margin-bottom:0px;"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;&nbsp;Back</a>
<h4 style="padding-left:20px;margin-bottom: 30px;font-weight: 500;color: #444;" class="roboto">Item Details</h4>
  <div class="row">
    <div class="col-md-12">
      <form id="edit-item-form" name="edit-item-form" class="form-horizontal" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="edit-item-id" value="<?php echo $_q['item_id'];?>">
        <div id="item-name-group" class="form-group">
          <label for="itemname" class="col-md-3 control-label">Item Name</label>
            <div class="col-md-6">
              <input id="" type="text" class="form-control" name="edit-item-name" autocomplete="off" value="<?php echo $_q['item_name'];?>" required>
              
            </div>
        </div>
        <div id="item-desc-group" class="form-group">
          <label for="itemdesc" class="col-md-3 control-label">Description</label>
            <div class="col-md-6">
              <textarea rows="6" id="edit-item-desc" type="text" class="form-control" name="edit-item-desc" autocomplete="off" required><?php echo $_q['item_description'];?></textarea>
            </div>
        </div>
        
        <div id="item-img-group" class="form-group">
          <label for="itemimg" class="col-md-3 control-label">Item Picture</label>
            <div class="col-md-6">
              <?php
              if($_q['item_img'] != null){
              ?>
              <div class="edit-item-img-preview bordered" style="background-image: url('<?php echo "img/upload/".$_q['item_img'];?>');">
              </div>
              <?php
              }else{?>
              <div class="edit-item-img-preview bordered" style="background-image: url('img/no-image.png');">
              </div>
              <?php
              }
              ?>
              <div class="" style="margin-top: 24px;">
                <h5 class="roboto" style="font-size: 13px; font-weight: 500;">Change Picture</h5>
                <input id="edit-item-file" type="file" class="" name="edit-item-file"/>
              </div>
              <span class="help-block">
                <i>*For better results please choose an image that is square*</i>
              </span>
            </div>
        </div>
        <div id="item-price-group" class="form-group">
          <label for="itemprice" class="col-md-3 control-label">Price (P)</label>
            <div class="col-md-6">
              <input id="edit-item-price" type="number" class="form-control" name="edit-item-price" autocomplete="off" value="<?php echo $_q['item_price'];?>" required>
              
            </div>
        </div>
        <div id="item-price-group" class="form-group">
          <label for="itemprice" class="col-md-3 control-label">Item Status</label>
            <div class="col-md-3">
              <select id="edit-item-status" name="edit-item-status" class="form-control">
              <?php
              if($_q['item_status'] == 0){?>
                <option value="0" selected>Unavailable</option>
                <option value="1">Available</option>
              <?php
              }else{?>
                <option value="1" selected>Available</option>
                <option value="0">Unavailable</option>
              <?php
              }
              ?>
                
              </select>
            </div>
        </div>
        <div class="form-group" style="margin-top: 50px;">
          <div class="col-md-12">
            <button type="button" id="btn-delete-item" class="pull-left btn btn-action" value="<?php echo $_q['item_id'];?>"><span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Delete Item</button>
            <button type="submit" id="btn-save-edit-item" class="pull-right btn btn-action"><span class="	glyphicon glyphicon-check"></span>&nbsp;&nbsp;Save Details</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php
}else{
  echo "No item found";
}
?>