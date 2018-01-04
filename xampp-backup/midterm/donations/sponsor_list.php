<form id="formSearch" style="float: right;" method="POST" action="donations/process.php?action=searchdonor">
	<input type="search" class="search" name="searchvalue" placeholder="Search"/>
	<button><a class="remove-link" style="color: black;" href="index.php?mod=donations&sub=sponsors">Reset</a></button>
</form>
<h2>Donors List</h2>
<h5>Click the sponsor ID number to view their profile page</h5>
<div>
	<table class="sponsor-list">
		<tr class="table-title">
			<th class="padding-topbottom10 text-align-left">ID</th>
			<th class="padding-topbottom10 text-align-left">Last Name</th>
			<th class="padding-topbottom10 text-align-left">First Name</th>
			<th class="padding-topbottom10 text-align-right">Total Cash Donated</th>
		</tr>
		<?php
		if(isset($_GET['search'])&&$_GET['search']!=''){
			$list = $donations->search_donors($_GET['search']);
		}else{
			$list = $donations->get_sponsors();
		}
		if($list){
			foreach($list as $value){
		?>
		<tr class="table-content">
			<td class="padding-topbottom10"><a class="remove-link" href="index.php?mod=donations&sub=sponsors&pro=profile&sID=<?php echo $value['sponsor_userid'];?>"><?php echo $value['sponsor_userid'];?></a></td>
			<td class="padding-topbottom10"><?php echo $value['sponsor_lastname'];?></td>
			<td class="padding-topbottom10"><?php echo $value['sponsor_firstname'];?></td>
			<td class="text-align-right"><?php echo number_format ((float)$value['sponsor_balance'], 2, '.', ',');?></td>
		</tr>
		<?php
			}
		}else{
			?>
			</table>
			<div class="warning-msg">
			<?php
			echo "No Sponsors Yet";
		}
		?>
		</div>
</div>
