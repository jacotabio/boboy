<?php
include '../library/config.php';
include '../classes/class.users.php';
if(isset($_SESSION['admin_login']) && $_SESSION['admin_login']==true){
 header("location: /admin/");
}else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Boboy | Admin - Login</title>
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="../js/custom.js"></script>
  <style type="text/css">
    body{
      background-color: rgba(0,0,0,0.05);
    }
    .login-logo{
      background-image: url('../img/logo - icon.png');
      background-size: 8%;
      background-repeat: no-repeat;
      background-position: center center;
      height:100px;
      margin-top:60px;
      margin-bottom:0px;
      padding:0;
    }
  </style>
</head>
<body>
<div class="container">    
  <div class="login-logo">
  
  </div>
  <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2">                    
    <div class="panel panel-info" >
      <div class="panel-heading">
        <div class="panel-title">Boboy</div>
      </div>     
      <div style="padding-top:30px" class="panel-body" >
        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>            
        <form id="loginform" method="POST" class="form-horizontal" role="form">
          <div style="margin-bottom: 25px" class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
              <input id="login-username" type="text" class="form-control" name="username" value="" autofocus="on" placeholder="Username" autocomplete="off" required>                                        
          </div>         
          <div style="margin-bottom: 25px" class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <input id="login-password" type="password" class="form-control" name="password" placeholder="Password" autocomplete="off" required>
          </div>
          <div style="margin-top:10px" class="form-group">
              <div class="col-sm-12">
                <button type="submit" id="btn-login" style="width:100%;" class="btn btn-success">Login</button>
              </div>
          </div> 
        </form>     
      </div>                     
    </div>  
  </div>
</div>
  
</body>
</html>
<?php
}