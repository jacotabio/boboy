<?php
	$REORDER = 5;
	$subsub = (isset($_GET['subsub']) && $_GET['subsub'] != '') ? $_GET['subsub'] : '';	
	if(isset($_GET['submitReport'])){
		if($_POST['dateFrom']!="" && $_POST['dateTo']!="" ){
			$dateFrom = $_POST['dateFrom'];
			$dateTo = $_POST['dateTo'];
		}
		else{
			$dateFrom = '';
			$dateTo = '';
		}
	}
	$dateTo = isset($_POST['dateTo']) ? $_POST['dateTo'] : '';
	$dateFrom = isset($_POST['dateFrom']) ? $_POST['dateFrom'] : '';
?>

<div id="subsub-navigation1">
	    		<ul>
				<form id="formProduct" method="POST" action="index.php?mod=dashboard&sub=reports&subsub=products">
	    			<li onclick="formProduct.submit();"><a href="#">Products</a></li>
				</form>
				<form id="formPurchase" method="POST" action="index.php?mod=dashboard&sub=reports&subsub=purchase">
	    			<li onclick="formPurchase.submit();"><a href="#">Purchase Orders</a></li>
				</form>
				<form id="formReceive" method="POST" action="index.php?mod=dashboard&sub=reports&subsub=receive">
	    			<li onclick="formReceive.submit();"><a href="#">Received Items</a></li>
				</form>	    		</ul>
			</div>
			<div id="gapper">
			</div>
<h2 id="reportTitle">Reports</h2>
<?php
switch($subsub){
	case 'products':
		?>
		<h4>Products Report</h4>
		<div id="report-navigation">
		</script>
		<form id="searchDateProduct" method="POST" action="index.php?mod=dashboard&sub=reports&subsub=products&date=specific">
				<h5>From:</h5> <input type="date" class="dateInfo" name="dateFrom" value="" required/>
				<h5>To</h5><input type="date" class="dateInfo" name="dateTo" value="" required/>
				<input class="form-btn" type="submit" name="submitReport" value="Generate"/>
		</form>
		<form id="formProduct" method="POST" action="index.php?mod=dashboard&sub=reports&subsub=products&date=begin">
			<input type="submit"  class="form-btn" name="submitReport" onclick="hideDateProduct()" value="Full Report"/>
		</form>
		</div>
		<?php
		break;
	case 'purchase':
		?>
		<h4>Purchase Orders Report</h4>
		<div id="report-navigation">
		<form id="searchDatePurchase" method="POST" action="index.php?mod=dashboard&sub=reports&subsub=purchase&date=specific">
				<h5>From:</h5> <input type="date" class="dateInfo" name="dateFrom" value="" required/>
				<h5>To</h5><input type="date" class="dateInfo" name="dateTo" value="" required/>
				<input class="form-btn" type="submit" name="submitReport" value="Generate"/>
		</form>
		<form id="formPurchase" method="POST" action="index.php?mod=dashboard&sub=reports&subsub=purchase&date=begin">
			<input class="form-btn" type="submit" name="submitReport" value="Full Report"/>
		</form>
		</div>
		<?php
		break;
	case 'receive':
		?>
		<h4>Received Items Report</h4>
		<div id="report-navigation">
		
		<form id="searchDateReceive" method="POST" action="index.php?mod=dashboard&sub=reports&subsub=receive&date=specific">
				<h5>From:</h5> <input type="date" class="dateInfo" name="dateFrom" value="" required/>
				<h5>To</h5><input type="date" class="dateInfo" name="dateTo" value="" required/>
				<input class="form-btn" type="submit" name="submitReport" value="Generate"/>
		</form>
		<form id="formReceive" method="POST" action="index.php?mod=dashboard&sub=reports&subsub=receive&date=begin">
			<input class="form-btn" type="submit" name="submitReport" value="Full Report"/>
		</form>
		</div>
		<?php
		break;
}


if(isset($_GET['date'])){
	switch($_GET['date']){
		case 'begin':
			$dateTo='';
			$dateFrom='';
			break;
	}
	switch($subsub){
		case 'products':
			$list = $report->generate_report($subsub, $dateTo, $dateFrom);
			if($list){
			?>
			
			<table>
			<tr>
			<th colspan="8">INVENTORY REPORT<br/>FROM (<?php echo $dateFrom?>) TO (<?php echo $dateTo?>)</th>
			</tr>
			<tr id="table-title">
			<td>Product ID</td>
			<td>Product Name</td>
			<td>Product Description</td>
			<td>Price</td>
			<td>Total IN</td>
			<td>Total OUT</td>
			<td>Remaining <br/>(Present)</td>
			<td>Status</td>	
			</tr>
			<?php
			
			foreach($list as $value){
			?>
			<tr id="table-content">
			<td><?php echo $value['p_id'];?></td>
			<td><?php echo $value['p_name'];?></td>
			<td><?php echo $value['p_description'];?></td>
			<td><?php echo $value['p_price'];?></td>
			<td>
			<?php 
			$listIN = $report->getTotalIn($value['p_id'], $dateTo, $dateFrom);
			foreach($listIN as $totalIN){
				if($totalIN['totalIN']==0){
					echo 0;
				}
				else{
					echo $totalIN['totalIN'];
				}
			}
			?>
			</td>
			<td>
			<?php 
			$listOut = $report->getTotalOut($value['p_id'], $dateTo, $dateFrom);
			foreach($listOut as $totalOut){
				if($totalOut['totalOut']==0){
					echo 0;
				}
				else{
				echo $totalOut['totalOut'];
			}
			}
			?>
			</td>
			<td><?php echo $value['p_quantity'];?></td>
			<td>
			<?php
				if($value['p_quantity']<$REORDER){
					echo '<h4 style="color: red;margin:0;">'."Needs Restock".'</h4>';
				}
				else{
					echo "OK";
				}
			?>
			</td>
			</tr>
			<?php
			}
			?>
		</table>
		<?php
			}
			else{
				echo '<div class="align-center" style="margin-top: 20%; font-weight: bold;"><h4>No reports yet</h4></div>';
			}
		break;
			
		case 'receive':
			$list = $report->generate_report($subsub, $dateTo, $dateFrom);
			if($list){
			?>
			<table>
			<tr>
			<th colspan="7">RECEIVED ITEMS REPORT<br/>FROM (<?php echo $dateFrom?>) TO (<?php echo $dateTo?>)</th>
			</tr>
			<tr id="table-title">
			<td>ID</td>
			<td>Product Name</td>
			<td>Description</td>
			<td>Quantity</td>
			<td>Price</td>
			<td>Date</td>
			<td>Time</td>			
			</tr>
			<?php
			foreach($list as $value){
			?>
			<tr id="table-content">
			<td><?php echo $value['r_id'];?></td>
			<td><?php echo $value['p_name'];?></td>
			<td><?php echo $value['p_description'];?></td>
			<td><?php echo $value['p_quantity'];?></td>
			<td><?php echo $value['p_price'];?></td>
			<td><?php echo $value['r_date_received'];?></td>
			<td><?php echo $value['r_time_received'];?></td>
			</tr>
			<?php
			}
			?>
		</table>
		<?php
			}
			else{
				echo '<div class="align-center" style="margin-top: 20%; font-weight: bold;"><h4>No reports yet</h4></div>';
			}
		break;
		
		case 'purchase':
			$list = $report->generate_report($subsub, $dateTo, $dateFrom);
			if($list){
			?>
			<table>
			<tr>
			<th colspan="7">PURCHASE ORDERS REPORT<br/>FROM (<?php echo $dateFrom?>) TO (<?php echo $dateTo?>)</th>
			</tr>
			<tr id="table-title">
			<td>Transaction #</td>
			<td>Product Name</td>
			<td>Quantity</td>
			<td>Price</td>
			<td>Sub Total</td>
			<td>Date</td>
			<td>Time</td>			
			</tr>
			<?php
			$previous = '';
			foreach($list as $value){
			$current = $value['po_id'];
			$currentDate = $value['po_date_purchased'];
			$currentTime = $value['p_time_purchased'];
			?>
			<tr id="table-content">
			<td>
			<?php 
				if($current!=$previous){
					echo $value['po_id'];	
				}
			?>
			</td>
			<td><?php echo $value['p_name'];?></td>
			<td><?php echo $value['p_quantity'];?></td>
			<td><?php echo $value['p_price'];?></td>
			<td><?php echo $value['p_subtotal'];?></td>
			<td>
			<?php 
				if($current!=$previous){
					echo $value['po_date_purchased'];	
				}
			?>			
			</td>
			
			<td>
			<?php 
				if($current!=$previous){
					echo $value['p_time_purchased'];	
				}
			?>
			</td>
			</tr>
			<?php
				$previous=$current;
			}
			?>
		</table>
		<?php
			}
			else{
				echo '<div class="align-center" style="margin-top: 20%; font-weight: bold;"><h4>No reports yet</h4></div>';
			}
		break;
	}
	
}
?>