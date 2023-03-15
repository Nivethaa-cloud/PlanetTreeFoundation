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
			<h1>To View Volunteers that are registered in an event</h1>
			<?php	  
				if (isset($_GET['btnRegStep1'])) {
					//Fetch form field values 
					$eventSelected = $_GET['events'];
					$_SESSION['eventSelected'] = $eventSelected;
					
					header("location: eventListVolunteers.php");
					
				}
			?>
			<?php
					$query = "SELECT DISTINCT EventId FROM volunteerevents";
					$result = executeSelectQuery($query);	
			?>
			<label for="species">Event to View: </label>
			<select name="events" required="true">
				<?php while ($row = $result->fetch_assoc()) { ?>
					<option value="<?php echo $row['EventId']; ?>" ><?php echo $row['EventId'];?></option>
				<?php } ?> 
			</select>
			<input type="submit" class="btn btn-primary" name="btnRegStep1" value="Proceed" />
		</div>
	</form>
	<?php include 'footer.php';?>	
</body>
</html>