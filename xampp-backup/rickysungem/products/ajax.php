<?php
include '../library/config.php';
include '../classes/class.users.php';
include '../classes/class.products.php';

$product = new Products();
$user = new Users();

if(isset($_POST['add_cart'])){
$result = $product->insert_to_cart($_POST['id'],$_POST['atc_qty'], $_SESSION['c_userid'],$_POST['subtotal'], $_SESSION['clientid']);
echo $result;
}

if(isset($_POST['modal_info'])){
  $mid = $_POST['modal_id'];
  $result = $product->get_product_details($mid);
  echo json_encode($result);
}
if(isset($_POST['display_products'])){
  if($_POST['cat_id'] == "all"){
?>

  <h3>Product List</h3>
  <?php
  }else{
    if($user->get_session()){
  ?>
  <h3>Product List</h3>
  <h5 class="product-filter-label">
          Filter by <?php echo $product->get_category_name($_POST['cat_id']);?>
  </h5>
  <?php
    }
  }
  ?>
	<table class="table table-striped table-hover font-roboto" id="mydata">
      <thead>

      <tr>
 		    <th>Product</th>
        <th class="formulations-title">Formulations</th>
        <th class="package-title">Packaging</th>
        <?php if($user->get_session()){?><th class="stocks_quan-title">Stocks</th><?php }?>
        <?php if($user->get_session()){?><th style="width: 10%;" class="ta-right price_unit-title">Unit Price</th><?php }?>
      </tr>
      </thead>
      <tbody>
      <?php
      	if($_POST['cat_id']!="all"){
      	$list = $product->get_products_category($_POST['cat_id']);

      	if($list){
      	foreach($list as $values){
        ?>
        <tr id="<?php echo $values['pro_id'];?>" class="product-link select-product" onclick="div_show()">
        <!--href="process.php?action=add&pro=<?php echo $values['pro_id'];?>"-->
        	<?php 
        	if($user->get_session()){
        	?>
        	<td><a class="product-link"><?php echo $values['pro_brand'];?></br><?php echo $values['pro_generic']?></a></td>
        	<?php
        	}else{
        	?>
        	<td><a class="product-link" id="popup" onclick="login_alert()"><?php echo $values['pro_brand'];?></br><?php echo $values['pro_generic']?></a></td>
        	<?php
        	}
        	?>
        	<td class="formulations"><?php echo $values['pro_formulation'];?></td>
        	<td class="package"><?php echo $values['pro_packaging'];?></td>
        	<?php if($user->get_session()){?><td class="stocks_quan" style="text-align: right;"><?php echo $values['pro_total_qty']?></td><?php }?>
        	<?php if($user->get_session()){?><td class="bold price_unit" style="text-align: right;"><?php echo number_format ((float)$values['pro_unit_price'], 2, '.', ',');?></td><?php }?>
        </tr>
        <?php
          }
      	}
      }else{
      $list = $product->get_all_products();

      if($list){
      foreach($list as $values){
        ?>
        <tr id="<?php echo $values['pro_id'];?>" class="product-link select-product" onclick="div_show()">
        	<?php 
        	if($user->get_session()){
        	?>
        	<td><a class="product-link"><?php echo $values['pro_brand'];?></br><?php echo $values['pro_generic']?></a></td>
        	<?php
        	}else{
        	?>
        	<td><a class="product-link" id="popup" onclick="login_alert()"><?php echo $values['pro_brand'];?></br><?php echo $values['pro_generic']?></a></td>
        	<?php
        	}
        	?>
        	<td class="formulations"><?php echo $values['pro_formulation'];?></td>
        	<td class="package"><?php echo $values['pro_packaging'];?></td>
        	<?php if($user->get_session()){?><td class="stocks_quan" style="text-align: right;"><?php echo $values['pro_total_qty']?></td><?php }?>
        	<?php if($user->get_session()){?><td class="bold price_unit" style="text-align: right;"><?php echo number_format ((float)$values['pro_unit_price'], 2, '.', ',');?></td><?php }?>
        </tr>
        <?php
          }
      	}
      }
        ?>
      </tbody>
    </table>
    <script>
    	$('#mydata').dataTable();
    </script>
<?php
}