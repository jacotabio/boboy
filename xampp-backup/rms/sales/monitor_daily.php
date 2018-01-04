<h2>Daily Sales</h2>
<h3>Date: <?php echo date('Y-m-d');?></h3>
<?php
$current_date = date('Y-m-d');

$list = $sales->get_daily($current_date);
if($list){
?>
<table border="1" style="border-collapse: collapse;" width="1000px">
<tr>
	<th>ID</th>
	<th>AMOUNT</th>
	<th>NBR ITEMS</th>
	<th>DATE/TIME</th>
	<th>TABLE/SERVER</th>
</tr>
<?php 
	$tr = 0;
	foreach($list as $value){
?>
<tr style="text-align: right;">
	<td><?php echo $value['ord_id'];?></td>
	<td><?php echo $value['ord_amount'];?></td>
	<td><?php echo $value['ord_items'];?></td>
	<td><?php echo $value['ord_date_added'];?>/<?php echo $value['ord_time_added'];?></td>
	<td><?php echo $sales->get_table($value['tab_id']);?>/<?php echo $sales->get_name($value['usr_id']);?></td>
</tr>
<?php 
	$tr++;
	$amount = $amount + $value['ord_amount'];
	}
?>

<tr>
	<th>TR: <?php echo $tr;?></th>
	<th>TOTAL: <?php echo number_format((float)$amount, 2, '.', '');?></th>
	<th>NBR: <?php echo $sales->get_nbr_total();?></th>
</tr>
</table>
<?php
}else{
	echo "No Sales";
}