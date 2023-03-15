<?php error_reporting(E_ALL ^ E_NOTICE) ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Update Your Password </title>
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
				<h2>Update Your Password</h2>
				<?php
					if(isset($_POST['btnUpdatePassword']))
					{
						session_start();
						$inputUserName = $_SESSION['usertemp'];
						$email = $_SESSION['emailtemp'];
						$password = $_POST['ftxtRegPassword'];
						$cnfrmPassword = $_POST['frtxtRegPassword'];
						$role = $_SESSION['roletemp'];
						$passWordCheck = validatePassword($password,$cnfrmPassword);
						//print_r($passWordCheck);
						if($passWordCheck == true){
							$passwordUpdated = updatePassword($inputUserName,$password, $email, $role);
							if($passwordUpdated == true){
								//header("location: Login.php");
							}
						}
					}
				?>				
				<div class="container">
					<div id="loginbox" style="margin-top:10px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
						<div class="panel panel-info" >
							<div class="panel-heading">
								<div class="panel-title">Update Password</div>
							</div>
							<div style="padding-top:30px" class="panel-body" >
								<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
								<form id="resetform" class="form-horizontal" role="form">
									<div style="margin-bottom: 25px" class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
										<input type="password" name="ftxtRegPassword" class="form-control" placeholder="Type New Password"  required="true"/>
									</div>
									<div style="margin-bottom: 25px" class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
										<input type="password" name="frtxtRegPassword" class="form-control" placeholder="Retype Password"  required="true"/>
									</div>
									<div  class="form-group">
										<!-- Button -->
										<div class="col-sm-12 controls">
											<input type="submit" class="btn btn-primary" name="btnUpdatePassword" value="Update" />
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