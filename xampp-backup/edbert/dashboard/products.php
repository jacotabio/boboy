<?php
if(isset($_POST['Submit'])){
	$product->update_product($prodID, $prodName, $prodDesc, $prodQty, $prodPrice);
}
?>

<h2>All Products</h2>
<table id="tblProduct">
<tr id="table-title">
	<td>Product Name</td>
	<td>Product Description</td>
	<td>Qty</td>
	<td>Price</td>
	<th colspan="2">Options</th>
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
	<td class="pop"><a class="control-buttons" href="index.php?mod=dashboard&sub=products&prodID=<?php echo $value['p_id'];?>&action=edit">Edit</a></td>
	<td class="center-align"><a class="control-buttons" href="index.php?mod=dashboard&sub=products&prodID=<?php echo $value['p_id'];?>&action=delete">Delete</a></td>
</tr>
<?php
}
?>
</table>
<?php
}
else{
	echo "NO RECORD FOUND";
}
?>
<!--------- Para sa Edit kag Delete ---->
<?php
if(isset($_GET['prodID'])){
	$prodID = $_GET['prodID'];
	$selectedProduct = $product -> select_product($prodID);
	
	switch($_GET['action']){
		case 'edit':
		?>
		<br/>
		<div class="background_overlay" style="display:block"></div>
		<form id="overlay_form" method="POST" action="dashboard/process.php?prodID=<?php echo $prodID;?>&action=updateproduct">
			<h2><?php foreach($selectedProduct as $selectedValue){ echo "EDIT FORM";}?></h2>
			<label class="">Product Name: </label>
				<input type="text" id="textField" class="input-text" name="prodName" value="<?php echo $selectedValue['p_name'];?>"/><br/><br/>
			<label>Product Description: </label>
				<input type="text" id="textField" class="input-text" name="prodDesc" value="<?php echo $selectedValue['p_description'];?>"/><br/><br/>
			<label>Qty: </label><br/>
				<input type="text" name="prodQty"  id="textField" class="input-text" value="<?php echo $selectedValue['p_quantity'];?>"/><br/><br/>
			<label>Price: </label> <br/>
				<input type="text"  id="textField" class="input-text" name="prodPrice"value="<?php echo $selectedValue['p_price'];?>" /><br/><br/>
				<input type="Submit" class="input-button" value="Save" />
				<input type="button" id="close" class="input-button" value="Close" />
				
		</form>
		<?php 
		
		break;
		
		case 'delete':
			$res = $product -> delete_product($prodID);
			if($res)
			 {
			  ?>
			  <script>
			  alert('Record Deleted ...')
					window.location='index.php?mod=dashboard&sub=products'
					</script>
			  <?php
			 }
			 else
			 {
			  ?>
			  <script>
			  alert('Record cant Deleted !!!')
					window.location='index.php?mod=dashboard&sub=products'
					</script>
			  <?php
			 }
			 break;
	}		
		?>
	

	
<?php
}
?>