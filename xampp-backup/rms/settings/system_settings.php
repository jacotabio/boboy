
<h2>System Details</h2>
<form name="form1" method="post" action="settings/process.php?action=changesettings">
  <h4>Owner Information</h4>
  <div class="col30">
    <input type="text" class="input-text" name="companyname" placeholder="Company Name" required/>
  </div>
  <div class="col30">
    <input type="text" class="input-text" name="address" placeholder="Address" required/>
  </div>
  <h4>System Information</h4>
  <div class="col30">
    <input type="number" class="input-text" name="version" placeholder="Version Number" value="<?php echo $list['set_version'];?>" required/>
  </div>
  <div class="col30">
    <input type="number" class="input-text" name="copyright" placeholder="Copyright" value="<?php echo $list['set_copyright'];?>" required/>
  </div>
  <div class="col30">
    <input type="submit" class="input-button" name="submit" value="Save Settings" />
  </div>
</form>
