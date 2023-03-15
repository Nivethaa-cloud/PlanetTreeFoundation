<?php error_reporting(E_ALL ^ E_NOTICE) ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<style type="text/css">
		div.jumbotron {
			padding-top: 10px;
			background-image: url(images/tree1.jpg);
		}
		p.tagLine {
			color: white;
		}
		nav.navbar.navbar-inverse {
			background-image: url(images/tree3.jpg);
		}
	</style>
</head>
<body>
	<div class="jumbotron">
		<div class="container text-center">
			<h1 style="font-weight: 900;">Planet Tree</h1>
			<p class="tagLine">Plant a Tree,Save the environment</p>
		</div>
	</div>
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
					<li class="active"><a href="index.php" style="background-color: #4d3319;"><span class="glyphicon glyphicon-home"></span> Home </a></li>
					<li><a href="aboutUs.php">About Us</a></li>
					<li><a href="contact.php">Contact Us</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<?php include 'functions.php';?>
					<?php
						session_start();
						if(isset($_SESSION['user']))
						{
							$isLogged = true;
							//Check the role of user
							$role = fetchRole($_SESSION['user'], $_SESSION['selRegUsrType']);
							//echo $role;
						}
						else { $isLogged = false; }
						
						//Menu options 
						if($isLogged)
						{
							if("volunteer"==$role){
								echo '<li><a href="events.php"><span class="glyphicon glyphicon-pencil"></span> Scheduled events </a></li>';
								echo '<li><a href="myevents.php"><span class="glyphicon glyphicon-pencil"></span> My Events </a></li>';
								echo '<li><a href="completeevents.php"><span class="glyphicon glyphicon-pencil"></span> Complete Events </a></li>';
								echo '<li><a href="account.php"><span class="glyphicon glyphicon-pencil"></span> My Account </a></li>';							
							}
							if("requester"==$role){
								echo '<li><a href="requesterRequest.php"><span class="glyphicon glyphicon-pencil"></span> Request for Planting trees </a></li>';
								echo '<li><a href="requesterList.php"><span class="glyphicon glyphicon-pencil"></span> My Requests </a></li>';
								echo '<li><a href="account.php"><span class="glyphicon glyphicon-pencil"></span> My Account </a></li>';
							}
							if("contributor"==$role){
								echo '<li><a href="contribute.php"><span class="glyphicon glyphicon-pencil"></span> Contribute</a></li>';
								echo '<li><a href="contribution.php"><span class="glyphicon glyphicon-pencil"></span> My Contributions </a></li>';
								echo '<li><a href="account.php"><span class="glyphicon glyphicon-pencil"></span> My Account </a></li>';
							}
							if("admin"==$role){
								echo '<li><a href="adminUserDetails.php"><span class="glyphicon glyphicon-pencil"></span> User Details </a></li>';
								echo '<li><a href="adminCompletedEvents.php"><span class="glyphicon glyphicon-pencil"></span> Completed Events </a></li>';
								echo '<li><a href="account.php"><span class="glyphicon glyphicon-pencil"></span> My Account </a></li>';
								echo '<li><a href="adminSpecies.php"><span class="glyphicon glyphicon-pencil"></span> Update Species </a></li>';
								echo '<li><a href="adminFunds.php"><span class="glyphicon glyphicon-pencil"></span> Current Funds </a></li>';
								echo '<li><a href="adminContributions.php"><span class="glyphicon glyphicon-pencil"></span> Contributions </a></li>';
								echo '<li><a href="scheduleRequest.php"><span class="glyphicon glyphicon-pencil"></span> Schedule a Request </a></li>';
								echo '<li><a href="unCompletedReq.php"><span class="glyphicon glyphicon-pencil"></span> Scheduled/ uncompleted request</a></li>';				
								echo '<li><a href="eventList.php"><span class="glyphicon glyphicon-pencil"></span> Events List </a></li>';
							}
							//echo '<li><a href="login.php"><span class="glyphicon glyphicon-user"></span> Your Account </a></li>';
							echo '<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout </a></li>';
						}
						else{
							echo '<li><a href="preRegistrationStep.php"><span class="glyphicon glyphicon-pencil"></span> Register </a></li>';
							echo '<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login </a></li>';
						}
					?>
				</ul>
			</div>
		</div>
	</nav>
</body>
</html>