<?php
	session_start();
	$conn = new mysqli("localhost","planettree","planettree","bankdb");
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . mysqli_connect_error());
	}
	else {
		$sqlQuery = "Update events set completed ='2', comments = '" . $_POST["comments"] . "' where intId = '" . $_POST["eid"] . "'";	
		$conn->query($sqlQuery) ;
		$sqlQuery1 = "Update contribution set status ='3' where eventId = '" . $_POST["eid"] . "'";		
		$conn->query($sqlQuery1) ;	
		$sqlQuery2 = "select * from events where intId = '" . $_POST["eid"] . "'";		
		$result =executeSelectQuery($sqlQuery2);			
		while ($req_row = $result->fetch_assoc()) {			
			$x=$req_row['intRequestId'];					
			$sql3 = "update requestdetailstbl set blnReqOpen = '3' where `lntRequestId`='$x'";
			$conn->query($sql3);			 
		}
		header('Location: completeevents.php');
	}
	$conn->close();
	function executeSelectQuery($sqlQuery){
		// Create connection
		$conn = new mysqli("localhost","planettree","planettree","bankdb");
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		//echo "Sql query:".$sqlQuery;
		$result = $conn->query($sqlQuery);
		$conn->close();
		return $result;
	}	
?>