<?php
include '../../library/config.php';
include '../../classes/class.items.php';
include '../../classes/class.users.php';

$item = new Items();
$user = new Users();

if(isset($_POST['remove_cart'])){
  if($item->check_before_remove($_POST['remove_id'])){
    if($item->remove_from_cart($_POST['remove_id'])){
      echo "remove_success";
    }else{
      echo "remove_failed";
    }
  }else{
    echo "check_error";
  }
}

if(isset($_POST['show_address'])){
  $cinfo = $user->user_contact_info($_SESSION['usr_id']);
?>
<div class="container-fluid">
    <div id="default-add" class="radio" style="margin-bottom:8px;">
      <label class="no-gap" style="color:rgba(0,0,0,0.8);font-size:12px;font-weight:500;"><input type="radio" id="chkbox-default" name="radio-address" value="1" checked>Default Address<div class="container-fluid">
        <p class="text-address" style="margin-top:2px;"><?php echo $cinfo['usr_address'];?></p>
      </div></label>
    </div>
    <div id="custom-add" class="radio no-gap" style="width:100%;">
      <label class="no-gap" style="width:100%;color:rgba(0,0,0,0.8);font-size:12px;font-weight:500;"><input type="radio" id="chkbox-custom" value="2" name="radio-address">Custom Address</br>
        <div class="container-fluid">
          <div id="custom-address-holder" class="form-group">
          <textarea type="text" id="textarea-custom-address" rows="5" name="textarea-custom" style="resize: none;" class="form-control text-address has-error" autocomplete="off"></textarea>
          <label id="address-label" class="control-label no-gap">This is a required field</label>
          <label id="address-label-error" style="display:none;" class="control-label no-gap">Invalid Address</label>
          </div>
        </div>
      </label>
    </div>
    
</div>
<p class="lead" style="margin-top:16px;margin-bottom:0;">Select contact number:</p>
<div class="container-fluid">
    <div id="default-contact" class="radio" style="margin-bottom:8px;">
      <label class="no-gap" style="color:rgba(0,0,0,0.8);font-size:12px;font-weight:500;"><input type="radio" id="chkbox-contact-default" name="radio-contact" value="1" checked>Default Contact #<div class="container-fluid">
        <p class="text-address" style="margin-top:2px;"><?php echo $cinfo['usr_contact'];?></p>
      </div></label>
    </div>
    <div id="custom-contact" class="radio no-gap" style="width:100%;">
      <label class="no-gap" style="width:100%;color:rgba(0,0,0,0.8);font-size:12px;font-weight:500;"><input type="radio" id="chkbox-contact-custom" value="2" name="radio-contact">Custom Contact # (Make sure your number is valid)</br>
        <div class="container-fluid">
          <div id="custom-number-holder" class="form-group">
            <input type="number" id="text-custom-number" pattern="[0-9]{9}" maxlength="11" name="custom-number" autocomplete="off" class="form-control text-address"/>
            <label id="contact-label" class="control-label no-gap">This is a required field</label>
            <label id="contact-label-error" style="display:none;" class="control-label no-gap">Please enter 11-digit mobile phone number</label>
          </div>
        </div>
      </label>
    </div>
</div>
<?php
}