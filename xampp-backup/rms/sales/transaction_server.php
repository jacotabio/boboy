<h2>Server</h2>
<h3>Date: <?php echo date('Y-m-d');?></h3>
<?php
$list = $sales->get_server_total();
?>
<table border="1" style="border-collapse: collapse;" width="500px">
<tr style="text-align: center;">
	<th>Server ID</th>
	<th>Server Name</th>
	<th>Total Sales</th>
</tr>
<?php
foreach($list as $value){
$totalsales = $sales->get_server_sales($value['usr_id']);
?>
<tr>
	<td><?php echo $value['usr_id'];?></td>
	<td><?php echo $value['usr_firstname'];?> <?php echo $value['usr_lastname'];?></td>
	<td style="text-align: right;"><?php if($totalsales){echo $totalsales;}else{echo "0.00";}?></td>
</tr>
<?php
}
?>
</table>