<h2>Add User</h2>
<form name="form1" method="post" action="settings/process.php?action=usernew">
    <div class="col30">
        <label>First Name</label></br>
        <input type="text" class="input-text" name="firstname" autocomplete="off" required placeholder="First Name"/>
    </div>
    <div class="col30">
        <label>Last Name</label></br>
        <input type="text" class="input-text" name="lastname" autocomplete="off" required placeholder="Last Name"/>
    </div>
    <h4>Log In Credentials</h4>
	  <div class="col30">
      <label>Access Level</label></br>
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
   <label>User ID</label></br>
        <input type="text" class="input-text" name="userid" autocomplete="off" required placeholder="User ID"/>
    </div>
    <div class="col30">
    <label>Password</label></br>
        <input type="password" class="input-text" name="password" required placeholder="Password"/>
    </div>
    <div class="col30">
    <label>Confirm Password</label></br>
		<input type="password" class="input-text" name="copassword" required placeholder="Confirm Password"/>
    </div>
    <div class="col30">
        <input type="submit" class="input-button" name="submit" value="Submit"/>
    </div>
</form>
