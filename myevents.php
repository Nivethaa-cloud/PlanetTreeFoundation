<?php error_reporting(E_ALL ^ E_NOTICE) ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> My enrolled events </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" media="all" href="style.css" />
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
		$conn = new mysqli("localhost","planettree","planettree","bankdb");
	?>
	<div class="page-content  text-center">
		<div class="container">
			<h1>My enrolled events</h1>
				<section class="card">								
					<div class="card-block">
						<table id="table" class="table table-bordered" style="background:#fff;">					
							<thead>
								<tr>
									<th> Event Id </th>
									<th> Species </th>
									<th>No of Trees to be planted</th>
									<th>Location</th>
									<th>Coordinates</th>
									<th>EventDate</th>								
								</tr>
							</thead>
							<tbody>						
								<?php	
									$user = $_SESSION['user'];
									//echo $user;
									
									$query = "SELECT * FROM  volunteerevents WHERE VolunteerName='$user'";
									$result = executeSelectQuery($query);
									while($req_row = $result->fetch_assoc())
									{

									$eventId = $req_row['EventId'];
									$query1 = "SELECT * FROM  events WHERE intId='$eventId' and completed='1'";
									$result1 = executeSelectQuery($query1);
									
									
									  while($req_row1 = $result1->fetch_assoc()) {	
								?>
								<tr>
									<td><?php echo $req_row1['intId']; ?></td>
									<td><?php echo $req_row1['strSpecies']; ?></td>
									<td><?php echo $req_row1['intQuantity']; ?></td>
									<td><?php echo $req_row1['strLocation']; ?></td>
									<td><?php echo $req_row1['strCoordinates']; ?></td>
									<td><?php echo $req_row1['EventDate']; ?></td>
								</tr>						
								<?php
									}  }
								?>						
							</tbody>
						</table>
					</div>					
				</section>					
		</div><!--.container-fluid-->
	</div><!--.page-content-->		
	<?php include 'footer.php';?>	
</body>
</html>