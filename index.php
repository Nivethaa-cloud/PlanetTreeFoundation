<?php error_reporting(E_ALL ^ E_NOTICE) ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Home Page </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<style type="text/css">
		.centre {
			width: 20%;
			height:20%;
			display: block;
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
			//header("location: login.php");
		}
		echo '<p style="color:brown;">Hello '.$_SESSION['user'].' </p>';
		
		
	?>
	<section>
		<img class="mySlides" src="images/tree12.jpg" style="width:100%">
		<img class="mySlides" src="images/tree2.jpg" style="width:100%">
		<img class="mySlides" src="images/tree-in-hand.jpg" style="width:100%">
	</section>
	<script>
		// Automatic Slideshow - change image every 3 seconds
		var myIndex = 0;
		carousel();
		function carousel() {
			var i;
			var x = document.getElementsByClassName("mySlides");
			for (i = 0; i < x.length; i++) {
			x[i].style.display = "none";
		}
		myIndex++;
		if (myIndex > x.length) {myIndex = 1}
			x[myIndex-1].style.display = "block";
			setTimeout(carousel, 3000);
		}
	</script>	
	<?php include 'footer.php';?>
</body>
</html>