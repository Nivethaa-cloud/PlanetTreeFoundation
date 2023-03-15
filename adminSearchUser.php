<?php error_reporting(E_ALL ^ E_NOTICE) ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Search User </title>
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
			<h1>Search User Details</h1>
			<?php	  
				if (isset($_POST['btnAdminUsrSearchSubmit'])) {
				//Fetch form field values 
				$userName = $_POST['txtAdminUsername'];
				$userDtls = fetchUser($userName);
				if($userDtls == null){
					echo "<p> User not found!!! </p>";
				}
				else{
				session_start();	
				$_SESSION['txtAdminUpdUsername'] = $userDtls["strUsername"];	
				$_SESSION['txtAdminUpdPwd'] = $userDtls["strPassword"];
				$_SESSION['txtAdminUpdEmail'] = $userDtls["strEmail"];
				$_SESSION["txtAdminUpdMobile"] = $userDtls["strMobileNum"];
				$_SESSION["txtAdminUpdAddress"] = $userDtls["strAddress"];
				$_SESSION["txtAdminUpdZIP"] = $userDtls["intZipCode"];
				$_SESSION["txtAdminUpdHospCode"] = $userDtls["strHospCode"];
				header("location: adminUpdateUser.php");
				}
				}
			?>
			<label for="txtAdminUsername">Username: </label>
			<input type="text" name="txtAdminUsername" required="true"/>
			<input type="submit" name="btnAdminUsrSearchSubmit" value="Search" />
		</div>
	</form>
	<?php include 'footer.php';?>	
</body>
</html>