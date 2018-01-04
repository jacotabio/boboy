<?php
if(isset($_GET['msg'])){
	echo '<script>alert("'.$_GET['msg'].'");</script>';
}
?>
<form method="POST" action="process.php?action=register">
<div class="group-login">
<input type="text" name="firstname" placeholder="Firstname" required/>
</div>
<div class="group-login">
<input type="text" name="lastname" placeholder="Lastname" required/>
</div>
<div class="group-login">
<input type="text" name="email" placeholder="Email" required/>
</div>
<div class="group-login">
<input type="text" name="contact" placeholder="Contact #" required/>
</div>
<div class="group-login">
<input type="text" name="username" placeholder="Username" required/>
</div>
<div class="group-login">
<input type="password" name="password" placeholder="Password" required/>
</div>
<div class="group-login">
<input type="password" name="copassword" placeholder="Confirm Password" required/>
</div>
<input type="submit" value="Register"/>
</form>