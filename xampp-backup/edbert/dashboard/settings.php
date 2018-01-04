<?php
$fname = $_SESSION['userfname'];
$lname = $_SESSION['userlname'];
?>
<h2>Settings</h2>
<h4>Account Details</h4>
<form class="top3" name="form1" method="post" action="dashboard/process.php?action=edituser">
	
	<div class="col40">
        <input type="text" class="input-text" name="form_edit_fname" required placeholder="First Name" autocomplete="off" value="<?php echo $fname;?>"/>
    </div>
    <div class="col40">
        <input type="text" class="input-text" name="form_edit_lname" required placeholder="Last Name" autocomplete="off" value="<?php echo $lname;?>"/>
    </div>
    <h4>Change Password</h4>
    <div class="col40">
        <input type="password" class="input-text" name="form_edit_currentpassword" required placeholder="Current Password" autocomplete="off" />
    </div>
    <div class="col40">
        <input type="password" class="input-text" name="form_edit_newpassword" required placeholder="New Password" autocomplete="off" />
    </div>
    <div class="col40">
        <input type="password" class="input-text" name="form_edit_confirm" required placeholder="Confirm Password" autocomplete="off" />
    </div>
    <div class="col40">
    	<input type="submit" class="input-button" name="submit" value="Save">
        <h5 class="note">*You will be logged out of the system. Please re-login.</h5>
    </div>
</form>