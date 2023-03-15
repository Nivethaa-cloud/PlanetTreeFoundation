<?php error_reporting(E_ALL ^ E_NOTICE) ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> My Requests </title>
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
            <h1>My Requests</h1>		
			<section class="card">								
				<div class="card-block">
					<table id="table" class="table table-bordered" style="background:#fff;">					
						<thead>
							<tr>
								<th>Request ID </th>
								<th>Species</th>
								<th>No of trees</th>
								<th>Latitude</th>
								<th>Longitude</th>
								<th>Location</th>
								<th>Reason</th>
								<th>Requested Date</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>						
							<?php	
								$user = $_SESSION['user'];
								echo $user;
								
								$query = "SELECT * FROM  requestdetailstbl WHERE strUsername='$user'";
								$result = executeSelectQuery($query);
								if ($result->num_rows > 0){
									while($req_row = $result->fetch_assoc()) {							
							?>
							<tr>
								<td><?php echo $req_row['lntRequestId']; ?></td>
								<td><?php echo $req_row['strSpecies']; ?></td>
								<td><?php echo $req_row['intQuantity']; ?></td>
								<td><?php echo $req_row['strLatitude']; ?></td>
								<td><?php echo $req_row['strLongitude']; ?></td>
								<td><?php echo $req_row['strLocation']; ?></td>
								<td><?php echo $req_row['strReason']; ?></td>
								<td><?php echo $req_row['strStartDate']; ?></td>                          
								<td>
									<?php 
										if($req_row['blnReqOpen']==3) echo "<span class='label label-custom label-pill label-success'>Completed</span>";
										else echo "<span class='label label-custom label-pill label-default'>In Progress</span>"; 
									?>
								</td> 		                           
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