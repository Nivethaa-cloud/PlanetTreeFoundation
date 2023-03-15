<?php include 'functions.php';?>
<?php
	$conn = new mysqli("localhost","planettree","planettree","bankdb");
	if(isset($_POST['user_name']))
	{
		$name=$_POST['user_name'];
		$checkdata=" SELECT * FROM usertbl WHERE strUsername = '$name' ";
		$query=executeSelectQuery($checkdata);
		if ($query->num_rows > 0){
			echo "<span style ='font:15px Arial,tahoma,sans-serif;color:#ff0000'> User Name Already Exist </span>";
		}
		else{
			echo "OK" ;
		}
		exit();
	}
	if(isset($_POST['user_email']))
	{
		$emailId=$_POST['user_email']; 
		$checkdata=" SELECT * FROM usertbl WHERE strEmail = '$emailId' ";		 
		$query=executeSelectQuery($checkdata);
		if ($query->num_rows > 0){
			echo "<span style ='font:15px Arial,tahoma,sans-serif;color:#ff0000'> Email Already Exist </span>";
		}
		else{
			echo "OK";
		}
		exit();
	}
	if(isset($_POST['mobile_number']))
	{
		$mobileNum=$_POST['mobile_number'];
		$checkdata=" SELECT * FROM usertbl WHERE strMobileNum = '$mobileNum' ";
		$query=executeSelectQuery($checkdata);
		if ($query->num_rows > 0){
			echo "<span style ='font:15px Arial,tahoma,sans-serif;color:#ff0000'> Mobile Number Already Exist </span>";
		}
		else{
			echo "OK";
		}
		exit();
	}
?>
