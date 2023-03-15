<?php error_reporting(E_ALL ^ E_NOTICE) ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Requests </title>
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
			<h1>Requests in the system</h1>
			<section class="card">									
				<div class="card-block">
					<table id="table" class="table table-bordered" style="background:#fff;">					
						<thead>
							<tr>
								<th>Schedule an Event</th>
								<th>Location</th> 
								<th>Latitude</th>											
								<th>longitude</th> 
								<th>Species Name</th>
								<th>Requested No's</th>
								<th>Available No's</th>
								<th>Reason</th>
								<th>Requester</th>		   
								<th>Requested On</th>		   
							</tr>
						</thead>
						<tbody>						
							<?php	
								$user = $_SESSION['user'];
								//echo $user;
									
								$query ="SELECT * FROM requestdetailstbl where blnReqOpen='1' order by strStartDate DESC";
								$query1 = "SELECT count(*) as available FROM contribution where strSpecies='".$row['strSpecies']."' and status='1' ";
								$result = executeSelectQuery($query);
								if ($result->num_rows > 0){		
									while ($req_row = $result->fetch_assoc())
									{					
							?>
							<tr>
								<?php
									$query1 = "SELECT count(*) as available FROM contribution where strSpecies='".$req_row['strSpecies']."' and status='1' ";
									$result1 = executeSelectQuery($query1);
									$req_row1 = $result1->fetch_assoc();
									$coodinates=$req_row['strLatitude'];	
								?>
								<?php if($req_row['intQuantity'] <= $req_row1['available']) {?>
								<td><a href="schedule.php?id=<?php echo $req_row['lntRequestId']; ?>"><span class='label label-custom label-pill label-success'>Schedule</span></a></td> 
								<?php } else { ?>
								<td><span "disabled" class='label label-custom label-pill label-danger'> Schedule</span> </td>
								<?php } ?>						
								<td><?php echo $req_row['strLocation']; ?></td> 
								<td><?php echo $coodinates; ?></td>
								<td><?php echo $req_row['strLongitude']; ?></td>
								<td><?php echo $req_row['strSpecies']; ?></td> 
								<td><?php echo $req_row['intQuantity']; ?></td>  
								<td><?php echo $req_row1['available']; ?></td> 
								<td><?php echo $req_row['strReason']; ?></td> 
								<td><?php echo $req_row['strUsername']; ?></td> 
								<td><?php echo $req_row['strStartDate']; ?></td> 
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