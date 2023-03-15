<?php
	session_start();
	$conn = new mysqli("localhost","planettree","planettree","bankdb");
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . mysqli_connect_error());
	}
	else {
		$sqlQuery = "INSERT INTO volunteerevents (VolunteerName,EventId)
		 			VALUES ('" . $_GET["user"] . "','" . $_GET["id"] . "')";
				
		if ($conn->query($sqlQuery) === TRUE)
		{
			header('Location: myevents.php');
		}
	}
	$conn->close();			
?>