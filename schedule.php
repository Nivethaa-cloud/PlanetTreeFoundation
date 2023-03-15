<?php error_reporting(E_ALL ^ E_NOTICE) ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Schedule Event </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" media="all" href="style.css" />
</head>
<body style="background-color: bisque;">
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
			<h1>Schedule Event</h1>		
			<?php 
				$requestid=$_GET['id'];
				echo $requestid;
				$query = "SELECT * FROM requestdetailstbl where lntRequestId='$requestid'";
				$result = executeSelectQuery($query);
				if ($result->num_rows > 0){
					while($req_row = $result->fetch_assoc()) {				
			?>
			<form class="form-horizontal" role="form" enctype="multipart/form-data" method="post" action="scheduleEvent.php">
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-4 control-label">Requested User<span style="color:red;">*</span></label>
					<div class="col-sm-8">                                       
						<input type="text" class="form-control" id="ruser"  name="ruser" placeholder="Requested User" required="" readonly="" value="<?php echo $req_row['strUsername'] ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="col-sm-4 control-label">Requested Date<span style="color:red;">*</span></label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="rdate"  name="rdate" placeholder="requested date" required="" readonly="" value="<?php echo $req_row['strStartDate'] ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="col-sm-4 control-label">Species<span style="color:red;">*</span></label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="species"  name="species" placeholder="species count" required="" readonly="" value="<?php echo $req_row['strSpecies'] ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="col-sm-4 control-label">Location<span style="color:red;">*</span></label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="loc"  name="loc" placeholder="Location" required="" readonly="" value="<?php echo $req_row['strLocation'] ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="col-sm-4 control-label">coordinates<span style="color:red;">*</span></label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="coordinates"  name="coordinates" placeholder="coordinates" required="" readonly="" value="<?php echo $req_row['strLatitude'].",".$req_row['strLongitude'] ?>">
					</div>
				</div>
				 <?php
					$query1 = "SELECT * FROM usertbl where strRole = 'volunteer'";
					$result1 = executeSelectQuery($query1);						
				?>
				<div class="form-group">
					<label for="inputPassword3" class="col-sm-4 control-label">Lead Volunteer<span style="color:red;">*</span></label>
					<div class="col-sm-8">
						<select class="form-control" name="volunteer" id="volunteer" required="">
							<?php while ($req_row1 = $result1->fetch_assoc()) { ?>
							<option value="<?php echo $req_row1['strUsername']; ?>" ><?php echo $req_row1['strUsername'] ?></option>
							<?php } ?> 
						</select> 
					</div>
				</div>
				<?php  $minDate = date('Y-m-d', time()); ?>
				<div class="form-group">
					<label for="inputPassword3" class="col-sm-4 control-label">Event Date<span style="color:red;">*</span></label>
					<div class="col-sm-8">
						<input type="date" class="form-control" id="eventDate"  name="eventDate"  required="" min="<?php echo $minDate; ?>" value="<?php echo $minDate; ?>">
						<input hidden="" type="text" name="requestId" value="<?php echo $_GET['id']; ?>">
						<input hidden="" type="text" name="intQuantity" value="<?php echo $req_row['intQuantity'] ?>">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</div>
			</form>		
			<?php } 					
				}
				else
				{
				echo "failed";
				}
			?>
		</div>
	</div>
</body>
</html>