<?php
	session_start();

	$conn = new mysqli("localhost","planettree","planettree","bankdb");
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . mysqli_connect_error());
	}
	else {			
		$sqlQuery = "delete from species where intSpecies ='" . $_GET["id"] . "'";		
	}
	if ($conn->query($sqlQuery) === TRUE)
	{		
		if ($rs === TRUE) {
			header('Location: adminSpecies.php?st=Species Deleted Succesfully');
		}else {
			header('Location: adminSpecies.php?st=Something Went Wrong while Deleting Species');
		}
	}else{
		header('Location: adminSpecies.php?st=Something Went Wrong while Deleting Species');
	}
	$conn->close();
?>