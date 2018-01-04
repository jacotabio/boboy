<h2>Table</h2>
<h3>Date: <?php echo date('Y-m-d');?></h3>
<?php
$list = $sales->get_table_total();
?>
<table border="1" style="border-collapse: collapse;" width="500px">
<tr style="text-align: center;">
	<th>Table ID</th>
	<th>Table Code</th>
	<th>Total Sales</th>
</tr>
<?php
foreach($list as $value){
$totalsales = $sales->get_table_sales($value['tab_id']);
?>
<tr>
	<td><?php echo $value['tab_id'];?></td>
	<td><?php echo $value['tab_code'];?></td>
	<td style="text-align: right;"><?php if($totalsales){echo $totalsales;}else{echo "0.00";}?></td>
</tr>
<?php
}
?>
</table>