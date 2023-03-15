<?php
session_start();

	$conn = new mysqli("localhost","root","","bankdb");
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . mysqli_connect_error());
			}
			else {
				$sqlQuery = "UPDATE species  SET strSpeciesName='" . $_POST["name_s"] . "',intCost= '" . $_POST["cost"] . "' where intSpecies ='" . $_POST["speciesId"] . "'";	
				if ($conn->query($sqlQuery) === TRUE)
				{
					header('Location: adminSpecies.php?st=Species updated Succesfully');
				}
				else {
					header('Location: adminSpecies.php?st=Something Went Wrong while updating Species');
				}
			}
				$conn->close();
				
?>