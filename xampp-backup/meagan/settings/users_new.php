<h2>New User</h2>
<form name="form1" method="post" action="settings/process.php?action=usernew">
    <h4>Personal Details</h4>
    <div class="col30">
        <input type="text" class="input-text" name="lastname" required placeholder="Last Name"/>
    </div>
    <div class="col30">
        <input type="text" class="input-text" name="firstname" required placeholder="First Name"/>
    </div>
    <h4>Log In Credentials</h4>
	  <div class="col30">
		<select name="access" class="input-text" required>
			<?php
			$list = $settings->get_access();

			foreach($list as $value){
			?>
				<option value="<?php echo $value['acc_id'];?>">
				<?php echo $value['acc_name'];?>
				</option>
			<?php
			}
			?>
		</select>
	 </div>
    <div class="col30">
        <input type="text" class="input-text" name="userid" required placeholder="User Id"/>
    </div>
    <div class="col30">
        <input type="password" class="input-text" name="password" required placeholder="Password"/>
    </div>
    <div class="col30">
		<input type="password" class="input-text" name="copassword" required placeholder="Confirm Password"/>
    </div>
    <div class="col30">
        <input type="submit" class="input-button" name="submit" value="Save New User"/>
    </div>
</form>
