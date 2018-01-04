<script type="text/javascript" src="js/popup.js"></script> 
<?php
if(isset($_POST['Submit'])){
	$product->update_product($prodID, $prodName, $prodDesc, $prodQty, $prodPrice);
}
?>
<h2>Restock</h2>

<table>
<tr id="table-title">
	<td>Product Name</td>
	<td>Product Description</td>
	<td>Qty</td>
	<td>Price</td>
	<th colspan="2">Action</th>
</tr>
<?php
if(isset($_GET['search'])&&$_GET['search']!=''){
	$list = $product->search_product($_GET['search']);
}
else
{
	$list = $product->get_products();
}
if($list){
foreach($list as $value){
?>
<tr id="table-content">
	<form method="POST" action="index.php?mod=dashboard&sub=receive&prodID=<?php echo $value['p_id'];?>&action=receiveItems">
	<td><?php echo $value['p_name'];?></td>
	<td><?php echo $value['p_description'];?></td>
	<td><?php echo $value['p_quantity'];?></td>
	<td><?php echo number_format ((float)$value['p_price'], 2, '.', ',');?></td>
	<td class="center-align">Qty: <input type="number" class="align-center input-quantity" name="quantity" value="1" min="1"/>
	<input type="Submit" class="control-buttons" value="Restock"/></td>
	<input type="hidden" name="pName" value="<?php echo $value['p_name'];?>"> 
	<input type="hidden" name="pDesc" value="<?php echo $value['p_description'];?>">
	<input type="hidden" name="pPrice" value="<?php echo number_format ((float)$value['p_price'], 2, '.', ',');?>">
	</form>
</tr>
<?php
}
}
else{
	echo '<div style="font-weight: bold; color: red;"><h4>0 results found</h4></div>';
}
?>
</table>

<!--------- Para sa Edit kag Delete ---->
<?php
if(isset($_GET['prodID'])){
	$prodID = $_GET['prodID'];
	$selectedProduct = $product -> select_product($prodID);
	$quantity = $_POST['quantity'];
	foreach($selectedProduct as $selectedValue);
	switch($_GET['action']){
		case 'receiveItems':
		?>
		<br/>
			<div class="background_overlay" style="display:block"></div>
			<form id="overlay_form" method="POST" action="dashboard/process.php?prodID=<?php echo $prodID;?>&action=receiveItems&quantity=<?php echo $quantity;?>">
				<h2><?php echo $selectedValue['p_name'];?></h2>
				<label>Quantity to be added: <?php echo $quantity.' '?></label>
					<input type="Submit" class="input-button" value="Continue" />
					<input type="button" id="closeReceive" class="input-button" style="margin-top: 10px;" value="Cancel" />	
					<input type="hidden" name="pName" value="<?php echo $_POST['pName'];?>"> 
					<input type="hidden" name="pDesc" value="<?php echo $_POST['pDesc'];?>">
					<input type="hidden" name="pPrice" value="<?php echo $_POST['pPrice'];?>">
			</form>
		<?php 
		
		break;
		
	}		
		?>
		
	

	
<?php
}
?>