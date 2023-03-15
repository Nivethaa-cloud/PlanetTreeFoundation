<?php error_reporting(E_ALL ^ E_NOTICE) ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Reset Your Password </title>
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
				<h2>Reset Your Password</h2>
				<?php
					if(isset($_POST['btnRequesttoChange']))
					{
					$inputUserName = $_POST['ftxtLogUsername'];
					//print_r($inputUserName);
					$inputEmail = $_POST['ftxtLogEmail'];
					$role = $_POST['selRegUsrType'];
					//print_r($inputEmail);
					$userDetailsCheck = validateUserInfo($inputUserName,$inputEmail, $role);
					if($userDetailsCheck == true){
						//print_r("hi");
						session_start();
						//Storing the name of user in SESSION variable.
						$_SESSION['usertemp']=$inputUserName;
						$_SESSION['emailtemp']=$inputEmail;
						$_SESSION['roletemp']=$role;
						if(isset($_SESSION['usertemp'])){
							header("location: updatePassword.php");
							}
						}
					}
				?>
				<div class="container">
					<div id="loginbox" style="margin-top:10px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
						<div class="panel panel-info" >
							<div class="panel-heading">
								<div class="panel-title">Reset Your Password</div>
							</div>	
							<div style="padding-top:30px" class="panel-body" >
								<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
								<form id="resetform" class="form-horizontal" role="form">
									<div style="margin-bottom: 25px" class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
										<input id="f-username" type="text" class="form-control" name="ftxtLogUsername" value="" placeholder="Enter your username" required="true"/>
									</div>
									 <div style="margin-bottom: 25px" class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
										<input id="f-email" type="email" name="ftxtLogEmail" class="form-control" placeholder="Registered Email"  required="true"/>
									</div>				
									<label for="selRegUsrType">Login Type: </label>
									<select name="selRegUsrType" required="true" style="margin-bottom: 10px;">
										<option value="3">volunteer</option>
										<option value="1">requester</option>
										<option value="2">contributor</option>
										<option value="0">admin</option>
									</select>
									<div  class="form-group">
										<!-- Button -->
										<div class="col-sm-12 controls">
											<input type="submit" class="btn btn-primary" name="btnRequesttoChange" value="Request" />
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