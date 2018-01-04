<h2>New Donor</h2>
<form name="form1" method="post" action="donations/process.php?action=newsponsor">
    <div class="col30">
        <label>User ID</label></br>
        <input type="number" autocomplete="off" class="input-text" name="s_userid" onkeypress="return isNumberKey(event)" required placeholder="User ID"/>
    </div>
    <div class="col30">
        <label>First Name</label></br>
        <input type="text" class="input-text" autocomplete="off" name="firstname" required placeholder="First Name"/>
    </div>
    <div class="col30">
    	<label>Last Name</label></br>
        <input type="text" class="input-text" autocomplete="off" name="lastname" required placeholder="Last Name"/>
    </div>
    <div class="col30">
        <input type="submit" class="input-button" name="submit" value="Submit"/>
    </div>
</form>