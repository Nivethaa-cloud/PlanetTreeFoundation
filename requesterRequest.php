<?php error_reporting(E_ALL ^ E_NOTICE) ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Request plantation in your area </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<style type="text/css">
		div {
			margin-bottom: 10px;
		}
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
		  <h1>Request for Planting Trees</h1>
	<?php	  
	if (isset($_POST['btnRecRequestSubmit'])) {
		//Fetch form field values 
		$userName = $_SESSION['user'];
		$species = $_POST['species'];
		$quantity = $_POST['txtRecQty'];
		$latitude = $_POST['latitude'];
		$longitude = $_POST['longitude'];
		$location = $_POST['location'];	
		$reason = $_POST['reason'];	
		
		
		requestTree($userName, $species, $quantity, $latitude,$longitude,$location,$reason);
	}
	?>
		<div class="container text-center">
		<?php
			$query = "SELECT * FROM species";
			$result = executeSelectQuery($query);	
        ?>
		<label for="species">Species: </label>
		

		<select name="species" required="true">
			<?php while ($row = $result->fetch_assoc()) { ?>
				<option value="<?php echo $row['strSpeciesName']; ?>" ><?php echo $row['strSpeciesName'];?></option>
                <?php } ?> 
        </select>
										

		<!--<select name="species" required="true">
			<option value="Red Maple">Red Maple</option>
			<option value="Oak Tree">Oak Tree</option>
			<option value="Chestnut">Chestnut</option>
		</select>-->	
		</div> <br>
		<div class="container text-center">
			<label for="txtRecQty">Quantity: </label>
			<input type="text" name="txtRecQty" placeholder="No. of Trees to be planted" required="true"/> <br>
			<label for="latitude">Latitude: </label>
			<input type="text" name="latitude" placeholder="latitude" required="true"/><br>
			<label for="longitude">longitue: </label>
			<input type="text" name="longitude" placeholder="longitude" required="true"/><br>
			<label for="location">location: </label>
			<input type="text" name="location" placeholder="location" required="true"/><br>
			<label for="Reason">Reason : </label>
			<input type="textarea" name="reason" placeholder="Reason" required="true"/><br>
			
		</div>
		
		<div class="container text-center">
			<input type="submit" name="btnRecRequestSubmit" value="Submit" />
		</div>
		</div>
		</form>
	<?php include 'footer.php';?>	
</body>
</html>