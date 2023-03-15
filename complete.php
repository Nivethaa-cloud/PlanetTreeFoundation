<?php error_reporting(E_ALL ^ E_NOTICE) ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Complete Event </title>
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
			<h1>Complete Event</h1>			
			<?php 
				$requestid=$_GET['id'];
				//echo $requestid;
				$query = "SELECT * FROM events where intId='$requestid'";
				$result = executeSelectQuery($query);
				if ($result->num_rows > 0){
					while($req_row = $result->fetch_assoc()) {					
			?>
			<form class="form-horizontal" role="form" enctype="multipart/form-data" method="post" action="markComplete.php">
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-4 control-label">Event Id <span style="color:red;">*</span></label>
					<div class="col-sm-8">                                       
						<input type="text" class="form-control" id="eid"  name="eid" placeholder="Requested User" required="" readonly="" value="<?php echo $req_row['intId'] ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="col-sm-4 control-label">Completion Comments <span style="color:red;">*</span></label>
					<div class="col-sm-8">
						<input type="textarea" class="form-control" id="comments"  name="comments" placeholder=" Completion Comments" required="" >
					</div>
				</div>									
				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						<button type="submit" class="btn btn-primary">Complete</button>
					</div>
				</div>
			</form>
			<?php 
				} }
				else
				{
				echo "failed";
				}
			?>
		</div>
	</div>
</body>
</html>