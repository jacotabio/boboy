<h2>All Products</h2>
<table>
<tr id="table-title">
	<td>Product Name</td>
	<td>Product Description</td>
	<td>Qty</td>
	<td>Price</td>
	<th colspan="2">Actions</th>
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
	<td><?php echo $value['p_name'];?></td>
	<td><?php echo $value['p_description'];?></td>
	<td><?php echo $value['p_quantity'];?></td>
	<td><?php echo number_format ((float)$value['p_price'], 2, '.', ',');?></td>
	<td class="center-align"><a class="control-buttons" href="index.php?mod=dashboard&sub=products&prodID=<?php echo $value['p_id'];?>&action=edit">Edit</a></td>
	<td class="center-align"><a class="control-buttons" href="index.php?mod=dashboard&sub=products&prodID=<?php echo $value['p_id'];?>&action=delete">Delete</a></td>

<?php
}
?>

<?php
}
else{
	?> <th colspan="5"><?php echo '<div style="font-weight: bold;"><h4>0 results found</h4></div>';?></th>
	<?php
}
?>
</tr>
</table>
<!-- Para sa Edit kag Delete -->
<?php
if(isset($_GET['prodID'])){
	$prodID = $_GET['prodID'];
	$selectedProduct = $product -> select_product($prodID);
	
	switch($_GET['action']){
		case 'edit':
			foreach($selectedProduct as $selectedValue)?>
		<br/>
		<div class="background_overlay" style="display:block"></div>
		<form id="overlay_form" method="POST" action="dashboard/process.php?prodID=<?php echo $prodID;?>&action=updateproduct">
			<h2>Edit</h2>
			<label>Product Name</label>
				<input type="text" id="textField" class="input-text" name="prodName" value="<?php echo $selectedValue['p_name'];?>"/><br/><br/>
			<label>Product Description</label>
				<input type="text" id="textField" class="input-text" name="prodDesc" value="<?php echo $selectedValue['p_description'];?>"/><br/><br/>
			<label>Qty</label><br/>
				<input type="number" name="prodQty"  id="textField" class="input-text" value="<?php echo $selectedValue['p_quantity'];?>"/><br/><br/>
			<label>Price</label> <br/>
				<input type="number"  step="0.01" min="1" id="textField" class="input-text" name="prodPrice"value="<?php echo $selectedValue['p_price'];?>" /><br/><br/>
				<input type="Submit" class="input-button" value="Save" />
				<input type="button" id="close" class="input-button" style="margin-top: 10px;" value="Close" />
				
		</form>
		<?php 
		
		break;
		
		case 'delete':
			?>
			<br/>
			<div class="background_overlay" style="display:block"></div>
			<form id="overlay_form" method="POST" action="dashboard/process.php?prodID=<?php echo $prodID;?>&action=deleteproduct">
				<h2>Delete</h2>
				<label>Are you sure you want to delete this?</label>
					<input type="Submit" class="input-button" value="Yes" />
					<input type="button" id="close" class="input-button" style="margin-top: 10px;" value="No" />
					
			</form>
			<?php
			break;
	}	
}
