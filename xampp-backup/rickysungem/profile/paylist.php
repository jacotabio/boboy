<h3>Payment List</h3>
<h5 style="margin-bottom: 25px;">Records as of <?php echo date("F d, Y");?></h5>
<table class="table table-striped table-bordered table-hover font-roboto" id="table-sli">
	<thead>
		<tr>
 			    <th>Order #</th>
        	<th>Due Date</th>
        	<th>Total Amount</th>
        	<th>Amount Paid</th>
        	<th>Remaining Balance</th>
      	</tr>
	</thead>
	<tbody>
	<?php
	$list = $user->get_paylist($_SESSION['clientid']);
	if($list){
		foreach($list as $pay){?>
    	<tr>
       		<td><?php echo $pay['invoice_id'];?></td>
       		<td><?php $date = new DateTime($pay['date_due']); echo $date->format('F j, Y');?></td>
       		<td><?php echo number_format ((float)$pay['total_amount'], 2, '.', ',');?></td>
       		<td><?php echo number_format ((float)$pay['amount_paid'], 2, '.', ',');?></td>
       		<td><?php echo number_format ((float)$pay['amount_remaining'], 2, '.', ',');?></td>
        </tr>
    <?php
    	}
	}
    ?>
	</tbody>
</table>
<script>
  $('#table-sli').dataTable();
</script>