<script type="text/javascript" src="js/popup.js"></script> 
<?php
if(isset($_POST['Submit'])){
	$product->update_product($prodID, $prodName, $prodDesc, $prodQty, $prodPrice);
}

$listPO = $transaction->po_number();
if(!empty($listPO)){foreach($listPO as $po_number);}else{$po_number['po_id']=1000;}

?>
<h2>Purchase</h2>
<?php
if(isset($_GET['search'])&&$_GET['search']!=''){
	$list = $product->search_product($_GET['search']);
}
else
{
	$list = $product->get_products();
}
if($list){?>

<div id="purchase-productlist">
<table>
<tr id="table-title">
	<td>Product Name</td>
	<td>Description</td>
	<td>Qty</td>
	<td>Price</td>
	<th colspan="2">Actions</th>
</tr>
<?php
foreach($list as $value){
?>
<!------------ADD ITEM SA CART--------->
<tr id="table-content">
	<form method="POST" action="dashboard/process.php?action=purchaseorder&subaction=addOrder&id=<?php echo $value['p_id'];?>">
	<td><?php echo $value['p_name'];?></td>
	<td><?php echo $value['p_description'];?></td>
	<td><?php echo $value['p_quantity'];?></td>
	<td><?php echo number_format ((float)$value['p_price'], 2, '.', ',');?></td>
	<td>Qty: <input class="align-center" type="number" name="quantity" value="1" min="1" max="<?php echo $value['p_quantity'];?>" required/>
	<input type="hidden" name="hidden_name" value="<?php echo $value['p_name'];?>"/>
	<input type="hidden" name="hidden_price" value="<?php echo $value['p_price'];?>"/>
	<input class="control-buttons" type="submit" name="add" value="Order"/></td>
	</form>
</tr>
<?php
}

?>
</table>
</div>
<br/><br/>
<table>
<!------------GIN PANG ORDER PERO WALA PA NA PURCHASE----------->
<h3 style="float:left;">ORDER LIST</h3> 
<h4><a href="dashboard/process.php?action=purchaseorder&subaction=clear" style="float:left; margin-left: 15px;color:red;text-decoration: none;">(Clear)</a></h4>
<h4 style="text-align: right;">Transaction No. <?php echo $po_number['po_id']+1;?> </h4>
<table style="text-align:center">
<tr id="table-title">
	<td>Product ID</td>
	<td>Product Name</td>
	<td>Qty</td>
	<td>Price Details</td>
	<td>Order Total</td>
	<td>Actions</td>
</tr>
<?php
if(!empty($_SESSION["cart"])){
	$total = 0;
	foreach($_SESSION["cart"] as $keys => $values){
?>
	<tr id="table-content">
		<td><?php echo $values["product_id"];?></td>
		<td><?php echo $values["item_name"];?></td>
		<td><?php echo $values["item_quantity"];?></td>
		<td><?php echo number_format ((float)$values['product_price'], 2, '.', ',');?></td>
		<td><?php echo number_format($values["product_price"]*$values["item_quantity"],2);?></td>
		<td><a class="control-buttons" href="dashboard/process.php?action=purchaseorder&subaction=delete&id=<?php echo $values["product_id"];?>">Remove</a>
	</tr>
	<?php
	$total = $total + ($values["product_price"]*$values["item_quantity"]);
	}
	?>
	<tr id="table-content">
	<td colspan="5" align="right">Total</td>
	<td colspan="1" align="center"><?php echo number_format($total,2);?></td>
	</tr>
<?php	
}
?>
	<td colspan="6"><h4 class="pop"><a style="color: #00897B; text-decoration: none;" href="index.php?mod=dashboard&sub=purchase&action=purchase">Proceed Purchase</a></h4></td>
</table>
<?php	

if(isset($_GET['action'])){
	switch($_GET['action']){
		case 'purchase':
		if(!empty($_SESSION["cart"])){
		?>
		<div class="background_overlay" style="display:block"></div>
			<form id="overlay_form" method="POST" action="dashboard/process.php?action=purchaseorder&subaction=purchase&po_id=<?php echo $po_number['po_id']+1;?>">
				<h2>Purchase</h2>
				<?php
					foreach($_SESSION['cart'] as $keys => $values){
				?>	<label>*<?php echo $values['item_name'].'('.$values['item_quantity'].')';?></label><br/>
				<?php
				}?>
				<br/>
				<label>Total Payment: <?php echo number_format($total,2);?></label>
					<input type="Submit" class="input-button" value="Yes" />
					<input type="button" id="closePurchase" class="input-button" style="margin-top: 10px;" value="No" />
			</form>
		<?php
		}
		else{
		?><script>alert("Cannot proceed. List is empty.");</script>
		<script>window.location="index.php?mod=dashboard&sub=purchase";</script>
		<?php 
		}
		break;	
	}
}
}
else{
	echo '<div style="font-weight: bold; color: red;"><h4>No Products Available</h4></div>';
}
?>