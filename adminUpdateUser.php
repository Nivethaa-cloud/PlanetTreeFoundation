<?php error_reporting(E_ALL ^ E_NOTICE) ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Update User Details </title>
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
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
		<div class="container text-center">
			<h1>Update User Details</h1>
			<?php	  
				//Set UserDetails to fields 
				$_POST["txtAdminUpdUsername"] = $_SESSION['txtAdminUpdUsername'];
				$_POST["txtAdminUpdPwd"] = $_SESSION["txtAdminUpdPwd"];
				$_POST["txtAdminUpdEmail"] = $_SESSION["txtAdminUpdEmail"];
				$_POST["txtAdminUpdMobile"] = $_SESSION["txtAdminUpdMobile"];
				$_POST["txtAdminUpdAddress"] = $_SESSION["txtAdminUpdAddress"];
				$_POST["txtAdminUpdZIP"] = $_SESSION["txtAdminUpdZIP"];
				$_POST["txtAdminUpdHospCode"] = $_SESSION["txtAdminUpdHospCode"];
				
				//Post Submit actions				
				if (isset($_POST['btnAdminUpdateUsrSubmit'])) {
					$user["strUsername"] = $_POST["txtAdminUpdUsername"];
					updateUserDetails($user);
				}
				else if (isset($_POST['btnAdminDelUsrSubmit'])) {
					deleteUser($_POST["txtAdminUpdUsername"]);
				}
			?>
			<label for="txtAdminUpdUsername">Username: </label>
				<input type="text" name="txtAdminUpdUsername" required="true" value="<?php echo htmlspecialchars($_POST["txtAdminUpdUsername"]); ?>" disabled="disabled"/><br>
			<label for="txtAdminUpdPwd">Password: </label>
				<input type="password" name="txtAdminUpdPwd" required="true" value="<?php echo htmlspecialchars($_POST["txtAdminUpdPwd"]); ?>" disabled="disabled"/><br>
			<label for="txtAdminUpdEmail">Email: </label>
				<input type="email" name="txtAdminUpdPwd" required="true" value="<?php echo htmlspecialchars($_POST["txtAdminUpdEmail"]); ?>" disabled="disabled"/><br>
			<label for="txtAdminUpdMobile">Mobile: </label>
				<input type="text" name="txtAdminUpdMobile" value="<?php echo htmlspecialchars($_POST["txtAdminUpdMobile"]); ?>"/><br>
			<label for="txtAdminUpdAddress">Address: </label>
				<input type="text" name="txtAdminUpdAddress" value="<?php echo htmlspecialchars($_POST["txtAdminUpdAddress"]); ?>"/><br>
			<label for="txtAdminUpdZIP">ZIP Code: </label>
				<input type="text" name="txtAdminUpdZIP" value="<?php echo htmlspecialchars($_POST["txtAdminUpdZIP"]); ?>"/><br>
			<label for="txtAdminUpdHospCode">Hospital Code: </label>
				<input type="text" name="txtAdminUpdHospCode" value="<?php echo htmlspecialchars($_POST["txtAdminUpdHospCode"]); ?>"/><br>
		</div>
		<div class="container text-center">
			<input type="submit" name="btnAdminUpdateUsrSubmit" value="Update" />
			<input type="submit" name="btnAdminDelUsrSubmit" value="Delete" />
		</div>
	</form>
	<?php include 'footer.php';?>	
</body>
</html>