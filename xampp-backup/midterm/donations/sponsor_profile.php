<a class="remove-link" href="index.php?mod=donations&sub=sponsors">< Return to Sponsor List</a>
<div class="profile-buttons">
<h2>Profile</h2>
	<ul>
		<li><a href="index.php?mod=donations&sub=sponsors&pro=profile&sID=<?php echo $_GET['sID'];?>&action=edit">Edit Profile</a></li>
		<li><a href="index.php?mod=donations&sub=sponsors&pro=profile&sID=<?php echo $_GET['sID'];?>&action=delete">Delete</a></li>
	</ul>
</div>
<?php
	if(isset($_GET['sID'])){
		$sID = $_GET['sID'];
		$sponsor_donation = $donations->select_sponsor_donation($sID);
		$profile = $donations->select_sponsor($sID);
		foreach($profile as $profiledata);
?>
<h4>Sponsor Name: </h4><?php echo $profiledata['sponsor_firstname'];?> <?php echo $profiledata['sponsor_lastname'];?>
<h4>Total Cash Donated: </h4><?php echo number_format ((float)$profiledata['sponsor_balance'], 2, '.', ',');?>
<h4>Recent Donations:</h4>
<?php
		if($sponsor_donation){
			?>
			<div class="">
				<table class="sponsor-list">
				<tr class="table-title">
					<th class="padding-topbottom10 text-align-left">Date</th>
					<th class="padding-topbottom10 text-align-left">Event</th>
					<th class="padding-topbottom10 text-align-left">Donation Type</th>
					<th class="padding-topbottom10 text-align-left">Donations</th>
					<th class="padding-topbottom10 text-align-left">Quantity</th>
					<th class="padding-topbottom10 text-align-left">Amount (Cash)</th>

				</tr>
			<?php

			foreach($sponsor_donation as $asd){
			?>
				<tr class="table-content">
					<td class="padding-topbottom10"><?php echo $asd['don_date_added'];?></td>
					<td class="padding-topbottom10"><a class="remove-link" href="index.php?mod=donations&sub=overview&pro=view&dID=<?php echo $asd['don_id'];?>"><?php echo $asd['don_title'];?></a></td>
					<td class="padding-topbottom10"><?php $dtype_id = $asd['dtype_id']; $donations->select_dtype_name($dtype_id);?></td>
					<td class="padding-topbottom10"><?php if($asd['don_item']){echo $asd['don_item'];}else{echo "-";}?></td>
					<td class="padding-topbottom10"><?php if($asd['don_item_qty']){echo $asd['don_item_qty'];}else{echo "-";}?></td>
					<td class="padding-topbottom10"><?php if($asd['don_amount'] != '0.00'){echo number_format ((float)$asd['don_amount'], 2, '.', ',');}else{echo "-";}?></td>
				</tr>
			<?php
			}
			?>
			</table>
		</div>
		<?php
			
		}else{
			?>
			<div class="warning-msg">
			<?php
			echo "No Donations";
			?>
			</div>
			<?php
		}

		/******EDIT PROFILE AND DELETE*******/
		if(isset($_GET['action'])){
			$select_profile = $donations->select_sponsor($sID);

			foreach($select_profile as $p);
				switch($_GET['action']){
						case 'edit':?>
						<div class="background_overlay" style="display:block"></div>
						<form id="overlay_form" method="POST" action="donations/process.php?sID=<?php echo $sID;?>&action=editprofile">
							<h2>Edit</h2>
							<h4>Personal Details</h4>
							<label>First Name</label></br>
								<input type="text" class="input-text" name="edit_fname" value="<?php echo $p['sponsor_firstname'];?>"/><br/><br/>
							<label>Last Name</label></br>
								<input type="text" class="input-text" name="edit_lname" value="<?php echo $p['sponsor_lastname'];?>"/><br/><br/></br>
								<input type="button" id="close" class="input-button popup" value="Close" />
								<input type="Submit" class="input-button popup" value="Save" />
								
						</form><?php
							break;
						case 'delete':?>
						<br/>
						<div class="background_overlay" style="display:block"></div>
						<form id="overlay_form" method="POST" action="donations/process.php?sID=<?php echo $sID;?>&action=deleteprofile">
							<h2>Delete</h2>
							<label style="display: block;">Are you sure you want to delete this person?</label>
							<h5 style="margin-top: 30px; color: red;">WARNING: Deleting this person will also delete all his/her donation records.</h5>
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
	window.location.assign("index.php?mod=donations&sub=sponsors&pro=profile&sID=<?php echo $sID;?>");
});
</script>


