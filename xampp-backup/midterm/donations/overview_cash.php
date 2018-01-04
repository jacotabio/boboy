<?php
?>
<h2 style="float: right;">Total: <?php echo number_format ((float)$donations->get_total_cash(), 2, '.', ',');?></h2><h2>Cash Donations</h2>
<h4 style="float: right;">ROWS(<?php echo $donations->count_donations_cash();?>)</h4>
<h5>Click the title to view more details</h5>
<div>
	<table class="sponsor-list">
		<tr class="table-title">
			<th class="padding-topbottom10 text-align-left">Date</th>
			<th class="padding-topbottom10 text-align-left">Event</th>
			<th class="padding-topbottom10 text-align-left">Sponsor</th>
			
			<th class="padding-topbottom10 text-align-right">Amount (Cash)</th>
		</tr>
		<?php
		$list = $donations->get_donations_cash();

		if($list){
			foreach($list as $value){
		?>
		<tr class="table-content">
			<td class="padding-topbottom10"><?php echo $value['don_date_added'];?></td>
			<td class="padding-topbottom10"><a class="remove-link" href="index.php?mod=donations&sub=overview&pro=view&dID=<?php echo $value['don_id'];?>"><?php echo $value['don_title'];?></a></td>
			<td class="padding-topbottom10"><?php $sponsor_userid = $value['sponsor_userid']; $userid = $donations->select_sponsor_name($sponsor_userid);foreach($userid as $userid1); echo $userid1['sponsor_firstname'];?> <?php echo $userid1['sponsor_lastname'];?></td>
			
			<td class="text-align-right"><?php echo number_format ((float)$value['don_amount'], 2, '.', ',');?></td>
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