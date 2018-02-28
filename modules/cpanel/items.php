<?php
if(isset($_GET['action']) && $_GET['action'] == "new"){?>
	<div class="container-fluid">
  <h4 style="margin-bottom: 30px;font-weight: 500;color: #444;" class="roboto">Create New Item</h4>
  <div class="row">
    <div class="col-md-12">
      <form id="add-item-form" name="add-item-form" class="form-horizontal" method="POST" enctype="multipart/form-data">
        <div id="add-name-group" class="form-group">
          <label for="itemname" class="col-md-3 control-label">Item Name</label>
            <div class="col-md-6">
              <input id="add-item-name" type="text" class="form-control" name="add-item-name" autocomplete="off" value="" autofocus required>
            </div>
        </div>
        <div id="item-desc-group" class="form-group">
          <label for="itemdesc" class="col-md-3 control-label">Description</label>
            <div class="col-md-6">
              <textarea rows="6" id="add-item-desc" type="text" class="form-control" name="add-item-desc" autocomplete="off" required></textarea>
            </div>
        </div>
        
        <div id="item-img-group" class="form-group">
          <label for="itemimg" class="col-md-3 control-label">Item Picture</label>
            <div class="col-md-6">
              <div class="" style="margin-top: 8px;">
                <input id="add-item-file" type="file" class="" name="add-item-file"/>
              </div>
              <span class="help-block">
                <i>*For better results please choose an image that is square*</i>
              </span>
            </div>
        </div>
        <div id="item-price-group" class="form-group">
          <label for="itemprice" class="col-md-3 control-label">Price (P)</label>
            <div class="col-md-6">
              <input id="add-item-price" type="text" class="form-control" name="add-item-price" autocomplete="off" value="" required>
              
            </div>
        </div>
        <div id="item-price-group" class="form-group">
          <label for="itemprice" class="col-md-3 control-label">Item Status</label>
            <div class="col-md-3">
              <select id="add-item-status" name="add-item-status" class="form-control">
								<option value="1" selected>Available</option>
                <option value="0">Unavailable</option>
              </select>
            </div>
        </div>
        <div class="form-group" style="margin-top: 50px;">
          <div class="col-md-12">
						<a href="index.php?mod=cpanel&t=items" class="btn btn-action">Cancel</a>
            <button type="submit" id="btn-add-item" class="pull-right btn btn-action"><span class="glyphicon glyphicon-check"></span>&nbsp;&nbsp;Create</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php
}else{
?>
<div class="container-fluid">
	<div class="row">
		<section class="content roboto">
      <div class="container-fluid" style="padding: 0px 0px 8px 0px;">
        <div class="row">
          <div class="col-md-4 col-xs-12" style="padding-top: 8px;">
            <h4 class="no-gap">My Items</h4>
          </div>
          <div class="col-md-8 col-xs-12 no-gap">
            <div class="col-md-8 col-xs-9" style="padding-top: 8px;">
              <form id="search-form">
                <div class="form-group no-gap">
                  <input type="text" id="cpanel-search-item" class="form-control" placeholder="Search" autocomplete="off" value="<?php if(isset($_GET['search'])){echo $_GET['search'];}?>">
                </div>
              </form>
            </div>
            <div class="col-md-4 col-xs-3" style="padding-top: 8px;">
              <div class="pull-right">
                <a href="index.php?mod=cpanel&t=items&action=new" type="button" id="btn-new-item" class="btn btn-green" style="font-size: 12px;">Create a new item</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <?php
      if(isset($_GET['search']) && $_GET['search'] != ""){
        echo "Results for '".$_GET['search']."'";
      }
      ?>
      <div class="pull-right">
        
			</div>
			<div class="col-md-12 no-gap">
				<div class="">
					<div class="panel-body no-gap">
						<div class="table-container" style="margin-top: 8px;">
							<table class="table table-filter">
								<tbody>
                <?php
                if(isset($_GET['search']) && $_GET['search'] != ""){
                  $_search = $item->search_items($_GET['search']);
                  if($_search){
                    foreach($_search as $search){?>
                    <tr id="<?php echo $search['item_id'];?>" class="item-select">
                      <td>
                        <div class="media">
                          <?php
                          if($search['item_img'] != null){
                          ?>
                          <div class="media-photo pull-left" style="background-image: url('<?php echo "img/upload/".$search['item_img'];?>');">
                          </div>	
                          <?php 
                          }else{?>
                          <div class="media-photo pull-left" style="background-image: url('img/no-image.png');">
                          </div>
                          <?php
                          }
                          ?>
                          <div class="media-body">
                            <span class="media-meta pull-right"><?php $date = new DateTime($search['created_at']); echo $date->format('F j, Y'); ?></span>
                            <h4 class="title">
                              <?php echo $search['item_name'];
                              if($search['item_status']==0){
                                $stat = "negative";
                              }else{
                                $stat = "positive";
                              }
                              ?>
                              <span class="pull-right <?php echo $stat;?>">(<?php if($search['item_status']==0){ echo "Unavailable";}else{ echo "Available";}?>)</span>
                            </h4>
                            <p class="summary"><?php echo $search['item_description'];?></p>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <?php
                    }
                  }else{?>
                    <div class="no-item" style="padding-top: 100px; padding-bottom: 100px;border-top:1px solid #DEDEDE;">
                    <h4 class="small text-center">No results found<h4>
                    </div>
                  <?php
                  }
                }else{
                  $mi = $item->my_items($_SESSION['brand_id']);
                  if($mi){
                    foreach($mi as $mia){?>
                    <tr id="<?php echo $mia['item_id'];?>" class="item-select">
                      <td>
                        <div class="media">
                          <?php
                          if($mia['item_img'] != null){
                          ?>
                          <div class="media-photo pull-left" style="background-image: url('<?php echo "img/upload/".$mia['item_img'];?>');">
                          </div>	
                          <?php 
                          }else{?>
                          <div class="media-photo pull-left" style="background-image: url('img/no-image.png');">

                          </div>
                          <?php
                          }
                          ?>
                          <div class="media-body">
                            <span class="media-meta pull-right"><?php $date = new DateTime($mia['created_at']); echo $date->format('F j, Y'); ?></span>
                            <h4 class="title">
                              <?php echo $mia['item_name'];
                              if($mia['item_status']==0){
                                $stat = "negative";
                              }else{
                                $stat = "positive";
                              }
                              ?>
                              <span class="pull-right <?php echo $stat;?>">(<?php if($mia['item_status']==0){ echo "Unavailable";}else{ echo "Available";}?>)</span>
                            </h4>
                            <p class="summary"><?php echo $mia['item_description'];?></p>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <?php
                      }
                    }else{?>
                      <div class="no-item" style="padding-top: 100px; padding-bottom: 100px;border-top:1px solid #DEDEDE;">
                      <h4 class="small text-center">No item to show<h4>
                      </div>
                    <?php
                    }
                  }
                  ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="content-footer">
				</div>
			</div>
		</section>
		
	</div>
</div>
<?php
}
?>