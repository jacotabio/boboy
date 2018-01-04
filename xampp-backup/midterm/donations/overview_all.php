<form id="formSearch" style="float: right;" method="POST" action="donations/process.php?action=searchproduct&mode=all">
	<input type="search" class="search" name="searchvalue" placeholder="Search"/>
	<button><a class="remove-link" style="color: black;" href="index.php?mod=donations&sub=overview&pro=all">Reset</a></button>
</form>
<h2>All Donations</h2>
<h4 style="float: right;">ROWS(<?php echo $donations->count_donations();?>)</h4>
<h5>Click the title to view more details</h5>
<div>
	<table class="sponsor-list">
		<tr class="table-title">
			<th class="padding-topbottom10 text-align-left">Date</th>
			<th class="padding-topbottom10 text-align-left">Event</th>
			<th style="padding-right: 15px;" class="padding-topbottom10 text-align-left">Type</th>
			<th class="padding-topbottom10 text-align-left">Sponsor</th>
			
			<th class="padding-topbottom10 text-align-left">Donations</th>
			<th class="padding-topbottom10 text-align-right">Quantity</th>
			<th class="padding-topbottom10 text-align-right">Amount (Cash)</th>
		</tr>
		<?php
		if(isset($_GET['search'])&&$_GET['search']!=''){
			$list = $donations->search_donations($_GET['search']);
		}else{
			$list = $donations->get_donations();
		}
		if($list){
			foreach($list as $value){
		?>
		<tr class="table-content">
			<td class="padding-topbottom10"><?php echo $value['don_date_added'];?></td>
			<td class="padding-topbottom10"><a class="remove-link" href="index.php?mod=donations&sub=overview&pro=view&dID=<?php echo $value['don_id'];?>"><?php echo $value['don_title'];?></a></td>
			<td class="padding-topbottom10 text-align-left"><?php $dtype_id = $value['dtype_id']; $donations->select_dtype_name($dtype_id);?></td>
			<td class="padding-topbottom10"><a class="remove-link" href="index.php?mod=donations&sub=sponsors&pro=profile&sID=<?php echo $value['sponsor_userid'];?>"><?php $sponsor_userid = $value['sponsor_userid']; $userid = $donations->select_sponsor_name($sponsor_userid);foreach($userid as $userid1); echo $userid1['sponsor_firstname'];?> <?php echo $userid1['sponsor_lastname'];?></a></td>
			
			<td class="padding-topbottom10"><?php if($value['don_item']){echo $value['don_item'];}else{echo "-";}?></td>
			<td class="padding-topbottom10 text-align-right"><?php if($value['don_item_qty'] == 0){echo "-";}else{echo $value['don_item_qty'];}?></td>
			<td class="text-align-right"><?php if($value['dtype_id'] == 302){echo number_format ((float)$value['don_amount'], 2, '.', ',');}else{echo "-";}?></td>
		</tr>
		<?php
			}
		}else{
			?>
			</table>
			<div class="warning-msg">
			<?php
			echo "No Donations";
		}
		?>
		</div>
</div>