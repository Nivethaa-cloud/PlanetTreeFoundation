<?php error_reporting(E_ALL ^ E_NOTICE) ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Login Page </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<style type="text/css">

	p {
		color: red;
	}
	</style>
</head>
<body style="background-color: #e6e6e6;">
	<?php include 'master.php';?>
		<form action="" method="post">
			<div class="container text-center">
				<h2>Login Page</h2>
				<?php
					if(isset($_POST['btnLogLogin']))
					{
					session_start();
					$role = $_POST['selRegUsrType'];
					//print_r($role);
					$inputUserName = $_POST['txtLogUsername'];
					$inputPassword = $_POST['txtLogPassword'];
					$authSuccess = validateCredentials($inputUserName,$inputPassword,$role);
					if($authSuccess == true){
						//Storing the name of user in SESSION variable.
						$_SESSION['user']=$_POST['txtLogUsername'];
						$_SESSION['selRegUsrType']=$_POST['selRegUsrType'];
						if(isset($_SESSION['user'])){
							header("location: index.php");
							}
						}
					}
				?>
				<div class="container">
					<div id="loginbox" style="margin-top:10px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
						<div class="panel panel-info" >
							<div class="panel-heading">
								<div class="panel-title">Sign In</div>
								<div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="resetPassword.php">Forgot password?</a></div>
							</div>
						<div style="padding-top:30px" class="panel-body" >
							<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
							<form id="loginform" class="form-horizontal" role="form">
								<div style="margin-bottom: 25px" class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
									<input id="login-username" type="text" class="form-control" name="txtLogUsername" value="" placeholder="username">
								</div>		
								<div style="margin-bottom: 25px" class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
									<input id="login-password" type="password" class="form-control" name="txtLogPassword" placeholder="password">
								</div>		
								<label for="selRegUsrType">Login Type: </label>
								<select name="selRegUsrType" required="true" style="margin-bottom: 10px;">
									<option value="3">volunteer</option>
									<option value="1">requester</option>
									<option value="2">contributor</option>
									<option value="0">admin</option>
								</select>
								<div class="input-group">
									<div class="checkbox">
										<label>
											<input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
										</label>
									</div>
								</div>
								<div  class="form-group">
								<!-- Button -->
									<div class="col-sm-12 controls">
										<input type="submit" class="btn btn-primary" name="btnLogLogin" value="Login" />
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div> <!-- /container -->
		</form>
	<?php include 'footer.php';?>	
</body>
</html>