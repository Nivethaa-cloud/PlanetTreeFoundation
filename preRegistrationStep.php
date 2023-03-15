<?php error_reporting(E_ALL ^ E_NOTICE) ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Registration Page </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<style type="text/css">
	select{
		margin-top: 20px;
	}
	p {
		color: red;
	}
	</style>
</head>

<body style="background-color: #e6e6e6;">
	<?php include 'master.php';?>
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="get">
			<div class="container text-center">
				<h2>Registration Page</h2>
				<?php	  
				if (isset($_GET['btnRegStep1'])) {
					//Fetch form field values 
					$userType = $_GET['selRegUsrType'];
					if($userType=="volunteer"){
						header("location: registrationVolunteer.php");
					}
					else if($userType=="requester") header("location: registrationRequester.php");
					else if($userType=="contributor") header("location: registrationContributor.php");
				}
				?>
				<label for="selRegUsrType">Who are you: </label>
				<select name="selRegUsrType" required="true" style="margin-bottom: 10px;">
					<option value="volunteer">volunteer</option>
					<option value="requester">requester</option>
					<option value="contributor">contributor</option>			
				</select>
				<input type="submit" class="btn btn-primary" name="btnRegStep1" value="Proceed" />
			</div>
		</form>
	<?php include 'footer.php';?>	
</body>
</html>