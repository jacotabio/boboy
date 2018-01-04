<h2>Item Donations</h2>
<h4 style="float: right;">ROWS(<?php echo $donations->count_donations_item();?>)</h4>
<h5>Click the title to view more details</h5>
<div>
	<table class="sponsor-list">
		<tr class="table-title">
			<th class="padding-topbottom10 text-align-left">Date</th>
			<th class="padding-topbottom10 text-align-left">Event</th>
			<th class="padding-topbottom10 text-align-left">Sponsor</th>
			
			<th class="padding-topbottom10 text-align-left">Donations</th>
			<th class="padding-topbottom10 text-align-right">Quantity</th>
		</tr>
		<?php
		$list = $donations->get_donations_item();

		if($list){
			foreach($list as $value){
		?>
		<tr class="table-content">
			<td class="padding-topbottom10"><?php echo $value['don_date_added'];?></td>
			<td class="padding-topbottom10"><a class="remove-link" href="index.php?mod=donations&sub=overview&pro=view&dID=<?php echo $value['don_id'];?>"><?php echo $value['don_title'];?></a></td>
			<td class="padding-topbottom10"><?php $sponsor_userid = $value['sponsor_userid']; $userid = $donations->select_sponsor_name($sponsor_userid);foreach($userid as $userid1); echo $userid1['sponsor_firstname'];?> <?php echo $userid1['sponsor_lastname'];?></td>
			
			<td class="padding-topbottom10"><?php if($value['don_item']){echo $value['don_item'];}else{echo "-";}?></td>
			<td class="padding-topbottom10 text-align-right"><?php if($value['don_item_qty'] == 0){echo "-";}else{echo $value['don_item_qty'];}?></td>
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