<h2>Food Listings</h2>
<table width="700px">
<tr style="text-align: center; background: #575757; color: white; font-size: 14px;">
	<th style="text-align: left; padding: 10px;">Product Name</th>
	<th style="text-align: center; padding: 10px;">Product Type</th>
	<th style="text-align: right; padding: 10px;">Price</th>
</tr>
<?php
$list = $food->food_listings();
if($list){
	foreach($list as $values){?>
				<tr>
					<td><a style="color: blue; text-decoration: none;" href="index.php?mod=food&sub=dishmanagement&pro=profile&id=<?php echo $values['pro_id'];?>"><?php echo $values['pro_name'];?></a></td>
					<td style="text-align: center;"><?php echo $values['pty_name'];?></td>
					<td style="text-align: right;"><?php echo number_format ((float)$values['pro_price'], 2, '.', ',');?></td>
				</tr>
	<?php
	}
}
?>
</table>
