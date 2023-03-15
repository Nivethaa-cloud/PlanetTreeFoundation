<?php error_reporting(E_ALL ^ E_NOTICE) ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> List Accounts in the system </title>
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
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="get">
			<div class="container text-center">
				<h1>Admin page for Navigating to user accounts</h1>
				<?php	  
				if (isset($_GET['btnRegStep1'])) {
					//Fetch form field values 
					$userType = $_GET['selRegUsrType'];
					if($userType=="Volunteers"){
							header("location: adminListVolunteers.php");
						}
					else if($userType=="Requesters") header("location: adminListRequesters.php");
					else if($userType=="Contributors") header("location: adminListContributors.php");
					
				}
				?>
				<label for="selRegUsrType">Accoun type to view </label>
				<select name="selRegUsrType" required="true" style="margin-bottom: 10px;">
					<option value="Volunteers">Volunteers</option>
					<option value="Requesters">Requesters</option>
					<option value="Contributors">Contributors</option>		
				</select>
				<input type="submit" class="btn btn-primary" name="btnRegStep1" value="Proceed" />
			</div>
		</form>
	<?php include 'footer.php';?>	
</body>
</html>