<?php
if (isset($_GET['message'])) {
    print '<script type="text/javascript">alert("' . $_GET['message'] . '");</script>';
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>OCTAVE - Register</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<div id="container-register">
    <h2>Sign Up</h2>
    <form name="form1" method="post" action="dashboard/process.php?action=newuser">
        <h4>Personal Details</h4>
        <div class="col30">
            <input type="text" class="input-text" name="register_firstname" required placeholder="First Name" autocomplete="off" />
        </div>
        <div class="col30">
            <input type="text" class="input-text" name="register_lastname" required placeholder="Last Name" autocomplete="off" />
        </div>
        <div class="col30">
            <input type="number" class="input-text" name="register_userid" required placeholder="User ID" autocomplete="off" />
        </div>
        <div class="col30">
            <input type="password" class="input-text" name="register_password" required placeholder="Password" autocomplete="off" />
        </div>
        <div class="col30">
    		<input type="password" class="input-text" name="register_copassword" required placeholder="Confirm Password" autocomplete="off" />
        </div>
        <div class="col30">
            <input type="submit" class="input-button" name="submit" value="Submit"/><br/>
            <a href="login.php"><input type="button" class="input-button" name="submit" value="Back"/></a>
        </div>
    </form>
</div>
</html> 