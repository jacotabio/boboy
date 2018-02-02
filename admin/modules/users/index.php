<?php

if(!isset($_GET['id'])){
?>
<div class="row">
    <!-- column -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title">Customers</h4>
                <h6 class="card-subtitle">A list of all registered customers</h6>
                <div class="table-responsive">
                <table id="table-customers" class="table table-hover pointer" cellspacing="0" width="100%" style="margin:0;padding:0;">
                    <thead>
                        <tr>
                            <th style="text-align:left;">Full Name</th>
                            <th style="text-align:left;">Email</th>
                            <th style="text-align:left;">Address</th>
                            <th style="text-align:right;">Contact #</th>
                            <th style="text-align:right;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}else{
    $u = $user->get_user_details($_GET['id']);
    if($u){
?>
<div class="row">
    <!-- column -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title">Customer Details</h4>
                <h6 class="card-subtitle">Customer account details</h6>
                <div id="customer-update-success" style="display:none;" class="alert alert-success">
                    <strong>Success!</strong> Customer's details has been updated successfully
                </div>
                <div class="table-responsive">
                    <form id="form-cust-d" class="form-horizontal">
                        <div id="name-input" class="form-group">
                            <input type="hidden" value="<?php echo $u['usr_id'];?>">
                            <label class="col-md-4 control-label">Full Name</label>
                            <div class="col-lg-7 col-md-12">
                                <input name="fullname" type="text" value="<?php echo $u['usr_name'];?>" placeholder="Full Name" class="form-control input-sm" required>
                                <label id="name-input-error" style="display:none;" class="control-label text-error">No special characters allowed</label>
                            </div>
                        </div>
                        <div id="email-input" class="form-group">
                            <label class="col-md-4 control-label">Email</label>
                            <div class="col-lg-7 col-md-12">
                                <input name="email" type="email" value="<?php echo $u['usr_email'];?>" placeholder="example@email.com" class="form-control input-sm" required>
                                <label id="email-input-error" style="display:none;" class="control-label text-error">Email invalid</label>
                            </div>
                        </div>
                        <div id="phone-input" class="form-group">
                            <label class="col-md-4 control-label">Phone #</label>
                            <div class="col-lg-7 col-md-12">
                                <input name="phone" type="number" value="<?php echo $u['usr_contact'];?>" placeholder="e.g (0915-XXX-XXXX)" class="form-control input-sm" required>
                                <label id="phone-input-error" style="display:none;" class="control-label text-error">Enter 11-digit phone number only</label>
                            </div>
                        </div>
                        <div id="address-input" class="form-group">
                            <label class="col-md-4 control-label">Default Address</label>
                            <div class="col-lg-7 col-md-12">
                                <textarea style="resize:none;" rows="5" name="address" type="text" placeholder="Default Address" class="form-control input-sm" required=""><?php echo $u['usr_address'];?></textarea>
                                <label id="address-input-error" style="display:none;" class="control-label text-error">Address consists of invalid characters</label>
                            </div>
                        </div>
                        <div id="address-input" class="form-group">
                            <label class="col-md-4 control-label">Status</label>
                            <div class="col-lg-7 col-md-12">
                                <select type="text" name="status" class="form-control input-sm" required>
                                    <?php
                                    if($u['usr_status'] == 0){?>
                                        <option value="0" selected>Deactivated</option>
                                        <option value="1">Activated</option>
                                    <?php
                                    }else{?>
                                        <option value="1" selected>Activated</option>
                                        <option value="0">Deactivated</option>
                                    <?php
                                    }
                                    ?>
                                    
                                    
                                </select>
                                <label id="status-input-error" style="display:none;" class="control-label text-error">Status not allowed</label>
                            </div>
                        </div>
                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label"></label>
                            <div class="col-md-4">
                                <button type="submit" name="submit" class="btn btn-info btn-sm"><span class="fa fa-"></span>Save Changes</button>
                                <button type="button" id="del-customer" name="delete" class="btn btn-red btn-sm"><span class="fa fa-"></span>Delete Customer</button>
                            </div>
                        </div>
                    </form>
                    <form id="form-cust-password" class="form-horizontal">
                        <h4 class="card-title">Change Password</h4>
                        <div id="customer-password-success" style="display:none;" class="alert alert-success">
                            <strong>Success!</strong> Customer's password was changed successfully
                        </div>
                        <div id="" class="form-group">
                            <input type="hidden" value="<?php echo $u['usr_id'];?>">
                            <label class="col-md-4 control-label">New Password</label>
                            <div class="col-lg-7 col-md-12">
                                <input id="password-input" name="password" type="password" placeholder="New password" class="form-control input-sm" required>
                                <label id="password-input-error" style="display:none;" class="control-label text-error">Alphanumeric & minimum 6-character only</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label"></label>
                            <div class="col-md-4">
                                <button type="submit" name="submit" class="btn btn-info btn-sm"><span class="fa fa-"></span>Change Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    }else{
        echo "Error 404: Page Not Found";
    }
}