<?php error_reporting(E_ALL ^ E_NOTICE) ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Request Status </title>
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
	?>
	<div class="page-content  text-center">
		<div class="container">
			<h1>Status of the Tree Plantation</h1>		
			<?php			
				$query = "select * from contribution where contribution_code = '".$_GET["id"]."'";
				$result = executeSelectQuery($query);
				if ($result->num_rows > 0){		
					$req_row = $result->fetch_assoc();  
					$sql1 = "select * from events where intId = '".$req_row["eventId"]."'";
					$result1 = executeSelectQuery($sql1);
					while ($req_row1 = $result1->fetch_assoc()){
			?>
			<section class="card">						
				<div class="card-block">
					<table id="table" class="table table-bordered" style="background:#fff;">					
						<thead>
							<tr>	
								<th>Species Name </th>
								<th>Location</th>
								<th>Coordinates</th>
								<th> Event Date </th>
								<th> Completed? </th>
							</tr>
						</thead>
						<tbody>							
							<tr>	
								<td><?php echo $req_row1['strSpecies']; ?></td>
								<td><?php echo $req_row1['strLocation']; ?></td>
								<td><?php echo $req_row1['strCoordinates']; ?></td>
								<td><?php echo $req_row1['EventDate']; ?></td>
								<?php if ($req_row['status'] ==3)
								{
									$completed = 'YES';
								}
								else {
									$completed = 'NO';
								}
								?>
								<td><?php echo $completed; ?></td>					   
							</tr>		
						</tbody>
					</table>						
					<?php								
						} }
						if (($req_row['status']) ==' 1'){			
							echo "no event is scheduled yet";
						}
					?>						
					<?php
					?>
				</div>	
			</section>		
		</div><!--.container-fluid-->
	</div><!--.page-content-->
	<?php include 'footer.php';?>	
</body>
</html>