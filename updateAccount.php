<?php
	session_start();
	$conn = new mysqli("localhost","planettree","planettree","bankdb");
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . mysqli_connect_error());
	}
	else {
		$sqlQuery = "UPDATE usertbl SET  strEmail = '" . $_POST["txtAdminUpdEmail"] . "',strMobileNum='" . $_POST["txtAdminUpdMobile"] . "',strAddress='" . $_POST["txtAdminUpdAddress"] . "',intZipCode='" . $_POST["txtAdminUpdZIP"] . "' WHERE strUsername='" . $_SESSION["user"] . "'";
		if ($conn->query($sqlQuery) === TRUE)
		{
			header('Location: account.php?st=Account updated Succesfully');
		}
		else {
			header('Location: account.php?st=Something Went Wrong while updating Account');
		}
	}
	$conn->close();			
?>