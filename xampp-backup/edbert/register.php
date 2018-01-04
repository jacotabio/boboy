<?php

?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<div id="container-register">
    <h2>New User</h2>
    <form name="form1" method="post" action="settings/process.php?action=usernew">
        <h4>Personal Details</h4>
        <div class="col30">
            <input type="text" class="input-text" name="lastname" required placeholder="Last Name"/>
        </div>
        <div class="col30">
            <input type="text" class="input-text" name="firstname" required placeholder="First Name"/>
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
</div>
</html>