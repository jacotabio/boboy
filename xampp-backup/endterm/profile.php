<div class="content">
	<div class="header-profile">
		<h2>PROFILE</h2>
		<p>User profile page</p>
	</div>
	<div class="content-wrapper">
		<div class="view-col">
			<div class="content-title">
				<h2>User Information</h2>
				<hr style="margin-top: -10px;">
			</div>
			<?php
			if(isset($_GET['user'])){
				$list = $user->user_profile($_GET['user']);
			}else{
				$list = $user->user_profile($_SESSION['userid']);
			}

			foreach($list as $value);
			?>
			<div class="trend">
				<table>
					<tr>
						<td>Full Name: </td>
						<td><?php echo $value['usr_firstname'];?> <?php echo $value['usr_lastname'];?></td>
					</tr>
					<tr>
						<td>Username: </td>
						<td><?php echo $value['usr_username'];?></td>
					</tr>
					<tr>
						<td>Contact #: </td>
						<td><?php echo $value['usr_contact'];?></td>
					</tr>
					<tr>
						<td>Email Address: </td>
						<td><?php echo $value['usr_email'];?></td>
					</tr>
				</table>	
			</div>
			
		</div>
	</div>
</div>