<?php
	session_start();
	$conn = new mysqli("localhost","planettree","planettree","bankdb");
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . mysqli_connect_error());
	}
	else {				
		$sqlQuery = "delete from usertbl where strUsername ='" . $_GET["id"] . "'";
		if ($conn->query($sqlQuery) === TRUE)
		{
			header('Location: adminUserDetails.php?echo st=Account Deleted Succesfully');			
		}
	}
	$conn->close();				
?>