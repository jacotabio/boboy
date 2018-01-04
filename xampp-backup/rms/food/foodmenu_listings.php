<h2>Food Type Listings</h2>
<?php
$list = $food->get_all_foodtype();
if($list){
	?>
	
	<?php
	foreach($list as $values){?>
		<table width=100%>
		<tr>
			<td>
			<?php echo $values['pty_name'];?>
			</td>
		</tr>
		</table>
<?php
	}
}else{
	echo "No Data Found";
}
?>