<a class="remove-link" href="index.php?mod=donations&sub=overview&pro=all">< Return to Donations</a>
<div class="profile-buttons">
<?php
if(isset($_GET['dID'])){
		$dID = $_GET['dID'];
		$dd = $donations->select_donation($dID);
		foreach($dd as $don_details);
?>
<h2><?php echo $don_details['don_title'];?></h2>
	<ul>
		<li><a href="index.php?mod=donations&sub=overview&pro=view&dID=<?php echo $_GET['dID'];?>&action=editdonation">Edit Details</a></li>
		<li><a href="index.php?mod=donations&sub=overview&pro=view&dID=<?php echo $_GET['dID'];?>&action=deletedonation">Delete</a></li>
	</ul>
</div>
<?php

		
?>
<h4>Description</h4><?php if($don_details['don_description']){echo $don_details['don_description'];}else{echo "-";}?>
<h4>Sponsor Name</h4><?php $sponsor_userid = $don_details['sponsor_userid']; $userid = $donations->select_sponsor_name($sponsor_userid);foreach($userid as $userid1); echo $userid1['sponsor_firstname'];?> <?php echo $userid1['sponsor_lastname'];?>
<h4>Donation Type</h4><?php $dtype_id = $don_details['dtype_id']; $donations->select_dtype_name($dtype_id);
if($dtype_id == 301){
?>
<table style="width: 30%; margin-top: 20px;">
	<tr>
		<th class="text-align-left">Donation</th>
		<th class="text-align-left">Qty</th>
	</tr>
	<tr>
		<td style="padding-top: 15px;"><?php echo $don_details['don_item'];?></td>
		<td><?php echo $don_details['don_item_qty'];?></td>
	</tr>
</table>
<?php
}else{?>
<table style="margin-top: 20px;">
	<tr>
		<th class="text-align-left">Amount (Cash)</th>
	</tr>
	<tr>
		<td style="padding-top: 15px;"><?php echo number_format ((float)$don_details['don_amount'], 2, '.', ',');?></td>
	</tr>
</table>
<?php
}
?>
<h4>Date Donated</h4><?php echo $don_details['don_date_added'];?>

<h4>Time Donated</h4><?php echo $time_in_12_hour_format = date("g:i a", strtotime($don_details['don_time_added']));?>
<?php

		/******EDIT DETAILS AND DELETE*******/
		if(isset($_GET['action'])){

				switch($_GET['action']){
						case 'editdonation':?>
						<div class="background_overlay" style="display:block"></div>
						<form id="overlay_form" method="POST" action="donations/process.php?dID=<?php echo $dID;?>&action=editdonation">
							<h2>Edit</h2>
							<h4>Donation Details</h4>
							<label>Title</label></br>
								<input type="text" class="input-text" name="edit_title" autocomplete="off" value="<?php echo $don_details['don_title'];?>"/><br/><br/>
							<label>Description</label></br>
								<input type="text" class="input-text" name="edit_description" autocomplete="off" value="<?php echo $don_details['don_description'];?>"/><br/><br/>
								<input type="button" id="close" class="input-button popup" value="Close" />
								<input type="Submit" class="input-button popup" value="Save" />
								
						</form><?php
							break;
						case 'deletedonation':?>
						<br/>
						<div class="background_overlay" style="display:block"></div>
						<form id="overlay_form" method="POST" action="donations/process.php?dID=<?php echo $dID;?>&action=deletedonation">
							<h2>Delete</h2>
							<label style="display: block;">Are you sure you want to delete this record?</label>
								<input type="button" id="close" class="input-button popup"  value="No" />
								<input type="Submit" class="input-button popup" value="Yes" />
						</form>
						<?php
							break;
				}
		}


	}
?>
<script>
$("#close, .background_overlay").click(function(){
	$("#overlay_form").fadeOut(1000);
	$(".background_overlay").fadeOut(500);
	window.location.assign("index.php?mod=donations&sub=overview&pro=view&dID=<?php echo $dID; ?>");
});
</script>


