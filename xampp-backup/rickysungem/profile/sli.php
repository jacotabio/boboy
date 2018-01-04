<h3>Stock Level Inventory</h3>
<h5 style="margin-bottom: 25px;">Records as of 10/13/17</h5>
<table class="table table-striped table-bordered table-hover font-roboto" id="table-sli">
	<thead>
		<tr>
 			    <th>Product Name</th>
        	<th>Formulation</th>
        	<th>Packaging</th>
        	<th>Lot #</th>
        	<th>Last Inventory</th>
      	</tr>
	</thead>
	<tbody>
	<?php
	$list = $user->get_sli($_SESSION['clientid']);
	if($list){
		foreach($list as $sli){?>
    	<tr>
       		<td><?php echo $sli['brand'];?></br><?php echo $sli['generic'];?></td>
       		<td><?php echo $sli['formu']?></td>
       		<td><?php echo $sli['pack'];?></td>
       		<td><?php echo $sli['lotno'];?></td>
       		<td><?php $date = new DateTime($sli['expiry']); echo $date->format('F j, Y');?></td>
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