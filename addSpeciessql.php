<?php
	session_start();
	$conn = new mysqli("localhost","planettree","planettree","bankdb");
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . mysqli_connect_error());
	}
	else {		
		if (isset($_POST) && !empty($_POST)) {        
			$sqlQuery = "INSERT INTO species (strSpeciesName,intCost)
						VALUES ('" . $_POST["name_s"] . "','" . $_POST["cost"] . "')";
			if ($conn->query($sqlQuery) === TRUE)
			{
				header('Location: adminSpecies.php?st=Species Added Succesfully');
			}
			else {
				header('Location: adminSpecies.php?st=Something Went Wrong while Adding Species');
			}
		}
	}
	$conn->close();	
?>