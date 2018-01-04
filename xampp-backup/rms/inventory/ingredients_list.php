<h2>Listings</h2>
<table width="60%">
<tr style="background-color: #575757; color: white;">
	<th style="padding: 10px; text-align: left;">Ingredient Name</th>
	<th style="padding: 10px; text-align: center;">Qty</th>
	<th style="padding: 10px; text-align: center;">Unit</th>
</tr>

	<?php
	$list = $inventory->get_ingredients();

	foreach($list as $value){
	?>
	<tr>
		<td ><?php echo $value['ing_name'];?></td>
		<td style="text-align: center;"><?php echo $value['ing_qty'];?></td>
		<td style="text-align: center;"><?php echo $inventory->get_per_unit($value['unt_id']);?></td>
	</tr>
	<?php
	}
	?>

</table>