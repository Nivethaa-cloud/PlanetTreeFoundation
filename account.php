<?php error_reporting(E_ALL ^ E_NOTICE) ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Update My Details </title>
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
	<?php
		session_start();
		if(!isset($_SESSION['user']))
		{
			//When user is not logged in, redirect to login page
			header("location: login.php");
		}
	?>

	<?php echo $_GET['st'] ?> 
		<div class="container text-center">
			<h1>My Account Details</h1>
			<?php	  
				//Set UserDetails to fields 
				
				$userName = $_SESSION['user'];
				$role = $_SESSION['selRegUsrType'];
				$userDtls = fetchUser($userName, $role);	
				$txtAdminUpdUsername = $userDtls['strUsername'];
				$txtAdminUpdPwd = $userDtls["strPassword"];	
				$txtAdminUpdMobile = $userDtls["strMobileNum"];
				$txtAdminUpdAddress = $userDtls["strAddress"];
				$txtAdminUpdZIP = $userDtls["intZipCode"];
			?>	
			<div class="panel-body">
				<form class="form-horizontal" role="form" enctype="multipart/form-data" method="post" action="updateAccount.php">
					<div class="form-group">
						<label for="txtAdminUpdUsername" class="col-sm-4 control-label">Username<span style="color:red;">*</span></label>
						<div class="col-sm-8">                                       
							<input type="text" class="form-control" placeholder="Username" name="txtAdminUpdUsername" required="" value="<?php echo $txtAdminUpdUsername; ?>" disabled="disabled">
						</div>
					</div>
					<div class="form-group">
						<label for="txtAdminUpdPwd" class="col-sm-4 control-label">Password<span style="color:red;">*</span></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" placeholder="Password" name="txtAdminUpdPwd" required="" value="<?php echo $txtAdminUpdPwd; ?>" disabled="disabled">
						</div>
					</div>
					<div class="form-group">
						<label for ="txtAdminUpdEmail" class="col-sm-4 control-label">Email<span style="color:red;">*</span></label>
						<div class="col-sm-8">				
							<input type="text" class="form-control" placeholder="Email" name="txtAdminUpdEmail" required="" value="<?php echo $userDtls["strEmail"]; ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="txtAdminUpdMobile" class="col-sm-4 control-label">Mobile No<span style="color:red;">*</span></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" placeholder="Mobile No" name="txtAdminUpdMobile" required="" value="<?php echo $userDtls["strMobileNum"]; ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="txtAdminUpdAddress" class="col-sm-4 control-label">Address<span style="color:red;">*</span></label>
						<div class="col-sm-8">                                       				
							<textarea class="form-control" placeholder="Address" name="txtAdminUpdAddress" required="" cols="50" rows="5"><?php echo $userDtls["strAddress"]; ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="txtAdminUpdZIP" class="col-sm-4 control-label">Zip Code<span style="color:red;">*</span></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" placeholder="Zip Code" name="txtAdminUpdZIP" required="" value="<?php echo $userDtls["intZipCode"]; ?>">
						</div>
					</div>											   
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-primary">Update</button>
						</div>
					</div>
			</form>
		</div>
	<?php include 'footer.php';?>	
</body>
</html>