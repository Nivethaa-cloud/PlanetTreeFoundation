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
			<h1>Current Available Species</h1>
			<section class="card">
				<div class="card-block">
					<table id="table" class="table table-bordered" style="background:#fff;">					
						<thead>
							<tr>											
								<th>Update</th> 
								<th>Delete</th>
								<th>Species Name</th> 
								<th>Species Price</th>
							</tr>
						</thead>
						<tbody>						
							<?php	
							$user = $_SESSION['user'];
							//echo $user;							
							$query = "SELECT * from species order by intSpecies DESC ";
							$result = executeSelectQuery($query);
							if ($result->num_rows > 0){
								while($req_row = $result->fetch_assoc()) {						
							?>
							<tr>
								<td><a href="updateSpecies.php?id=<?php echo $req_row['intSpecies']; ?>"><span class="label label-info">Update</span></a></td> 
								<td><a href="deleteSpecies.php?id=<?php echo $req_row['intSpecies']; ?>"><span class="label label-danger">Delete</span></a></td>
								<td><?php echo $req_row['strSpeciesName']; ?></td> 
								<td><?php echo " $ ".$req_row['intCost']; ?></td>        		   
							</tr>											
							<?php								
								}  }						
							?>						
						</tbody>
						<tbody>							
							<a href="updateSpecies.php"><span class="label label-info">Add New Species</span></a>				
						</tbody><br>
					</table>						
				</div>					
			</section>					
		</div><!--.container-fluid-->
	</div><!--.page-content-->		
	<?php include 'footer.php';?>	
</body>
</html>