<?php
	session_start();

	$conn = new mysqli("localhost","planettree","planettree","bankdb");
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . mysqli_connect_error());
	}
	else {							
		if (isset($_POST) && !empty($_POST)) {        
		   $sql = "INSERT INTO events (strRequester,strRequestedDate,strSpecies,intQuantity,strLocation,strCoordinates,intRequestId,LeadVounteer,EventDate) VALUES ('" . $_POST["ruser"] . "','" . $_POST["rdate"] . "','" . $_POST["species"] . "','" . $_POST["intQuantity"] . "','" . $_POST["loc"] . "','" . $_POST["coordinates"] . "','" . $_POST["requestId"] . "','" . $_POST["volunteer"] . "','" . $_POST["eventDate"] . "')";					
			$conn->query($sql);
			$eventNo=mysqli_insert_id($conn);			
			$x=$_POST["requestId"];
			$y=$_POST["species"];			
			$sql1 = "UPDATE `requestdetailstbl` SET `blnReqOpen` = '2' WHERE `requestdetailstbl`.`lntRequestId` = '$x'";		
			$conn->query($sql1);
					
			$z=$_POST["intQuantity"];

			$sql2= "SELECT * FROM contribution where strSpecies='$y' and status='1' LIMIT $z";
			$result = executeSelectQuery($sql2);
				 
			while ($req_row = $result->fetch_assoc()) {
				$sql3 = "update contribution set status='2',eventId='".$eventNo."' where intId='".$req_row['intId']."'";
				$conn->query($sql3);
				header('Location: index.php');		 
			}
		}
		
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