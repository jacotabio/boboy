<?php
$acc = $user->account_details($_SESSION['usr_id']);
if($acc){
    foreach($acc as $_a);
?>
<div class="container-fluid no-gap">
	<div class="col-md-12 profile-dashboard">
        <div class="row">
            <h4 class="" style="margin:0;padding-left:16px;padding-top:16px;padding-bottom:16px;">Account Settings</h4>
            <div id="account-update-success" style="display:none;" class="alert notify-success">
                <strong>Success!</strong> This page will reload after 5 seconds to complete the process.
            </div>
            <div id="password-update-success" style="display:none;" class="alert notify-success">
                <strong>Success!</strong> Your password has been updated
            </div>
            <div class="col-md-6 dashboard-form">
                <form id="form-account-details" method="POST" class="form-horizontal">
                    <div class="bg-white">
                        <!-- Form Name -->
                        <!-- Text input-->
                        <span class="profile-title">Personal Information</span>		
                        <div id="name-input" class="form-group">
                            <label class="col-md-4 control-label">Brand Name</label>
                            <div class="col-md-8">
                                <input name="fullname" type="text" value="<?php echo $_a['usr_name'];?>" placeholder="Full Name" class="form-control input-md" required autocomplete="off">
                                <label id="name-input-error" style="display:none;" class="control-label">No special characters allowed</label>
                            </div>
                        </div>
                        <span class="profile-title">Account Information</span> 
                        <div id="email-input" class="form-group">
                            <label class="col-md-4 control-label">Email</label>
                            <div class="col-md-8">
                                <input name="email" type="email" value="<?php echo $_a['usr_email'];?>" placeholder="example@email.com" class="form-control input-md" required autocomplete="off">
                                <label id="email-input-error" style="display:none;" class="control-label">Email invalid</label>
                                <label id="email-input-exists" style="display:none;" class="control-label">Email already exists</label>
                            </div>
                        </div>
                        <div id="phone-input" class="form-group">
                            <label class="col-md-4 control-label">Phone #</label>
                            <div class="col-md-8">
                                <input name="phone" type="number" value="<?php echo $_a['usr_contact'];?>" placeholder="e.g (0915-XXX-XXXX)" class="form-control input-md" required autocomplete="off">
                                <label id="phone-input-error" style="display:none;" class="control-label">Enter 11-digit phone number only</label>
                            </div>
                        </div>
                        <div id="address-input" class="form-group">
                            <label class="col-md-4 control-label">Address</label>
                            <div class="col-md-8">
                                <textarea style="resize:none;" rows="5" name="address" type="text" placeholder="Default Address" class="form-control input-md" required autocomplete="off"><?php echo $_a['usr_address'];?></textarea>
                                <label id="address-input-error" style="display:none;" class="control-label">Address consists of invalid characters</label>
                            </div>
                        </div>
                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label"></label>
                            <div class="col-md-4">
                                <button id="btn-update-account" type="submit" name="submit" class="btn btn-primary btn-sm">Update Profile</button>
                            </div>
                            <div class="material-load-details" class="" style="display:none;margin-right:30px;">
                                <svg class="spinner" stroke="#5677fc" width="30px" height="30px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                                    <circle class="circle" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r=30>
                                    </circle>
                                </svg>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6 dashboard-form">
                <form id="form-account-password" method="POST" class="form-horizontal">
                    <div class="bg-white">
                        <!-- Form Name -->
                        <!-- Text input-->
                        <div class="add_listing_info">
                <span class="profile-title">Change Password</span>     
                        <div id="old-password-input" class="form-group">
                            <label class="col-md-4 control-label">Old</label>
                            <div class="col-md-8">
                                <input name="old-password" type="password" value="" placeholder="Old Password" class="form-control input-md" required="">
                                <label id="old-password-incorrect" style="display:none;" class="control-label">Password is incorrect</label>
                            </div>
                        </div>
                        </div>
                        <div id="new-password-input" class="form-group">
                            <label class="col-md-4 control-label">New</label>
                            <div class="col-md-8">
                                <input name="new-password" type="password" placeholder="New password" class="form-control input-md" required="">
                            </div>
                        </div>
                        <div id="co-password-input" class="form-group">
                            <label class="col-md-4 control-label">Confirm</label>
                            <div class="col-md-8">
                                <input name="co-password" type="password" placeholder="Confirm Password" class="form-control input-md" required="">
                                <span class="help-block">
                                    <label id="password-not-match" style="display:none;" class="control-label">Passwords do not match</label>
                                    <label id="new-password-invalid" style="display:none;" class="control-label">Atleast 6 characters and letters only</label>
                                </span>
                            </div>
                            
                        </div>
                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="submit"></label>
                            <div class="col-md-4">
                                <button id="btn-update-password" type="submit" name="submit" class="btn btn-primary btn-sm">Change Password</button>
                            </div>
                            <div class="material-load-password" class="" style="display:none;margin-left:16px;margin-right:30px;">
                                <svg class="spinner" stroke="#5677fc" width="30px" height="30px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                                    <circle class="circle" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r=30>
                                    </circle>
                                </svg>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
}
?>