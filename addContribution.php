<?php

	session_start();
	include 'functions.php';
	$conn = new mysqli("localhost","planettree","planettree","bankdb");
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . mysqli_connect_error());
			}
			else {	
				if($_POST["cardno"] == 1){
					$number = $_POST['cardnonew'];
				}else{			
					$number = $_POST['cardno'];
				}
		
		$booleanValidations = validateChecksum($number);
		if($booleanValidations==true){
			
			if (isset($_POST) && !empty($_POST)) {
				$query = "SELECT * FROM species where intSpecies = '" . $_POST["intSpecies"] . "'";
				$result = $conn->query($query);
				$row = $result->fetch_assoc();
				$x=1;
				while ($x <= $_POST["quantity"]) {
					
					if($_POST["cardno"] == 1){
					$code=  codegen($row["strSpeciesName"]).substr(time(), -2).  rand(100, 999);
					$sql = "INSERT INTO contribution (contributor_name,strSpecies,intSpecies,contribution_code,cardName,address,zipcode,cardNumber,cvv,expmonth,expyear,cost)
			VALUES ('" . $_SESSION["user"] . "','" . $row["strSpeciesName"] . "','" . $_POST["intSpecies"] . "','" . $code . "','" . $_POST["namecard"] . "',"
							. "'" . $_POST["address"] . "','" . $_POST["zipcode"] . "','" . $_POST["cardnonew"] . "','" . $_POST["cvv"] . "','" . $_POST["expmonth"] . "','" . $_POST["expyear"] . "','" . $row["intCost"] . "')";
							print_r("if");
							print_r($sql);
							print_r($_POST[cardnonew]);
							print_r($_POST[cardno]);
							$conn->query($sql);
					$x++;
					}
					else{							
							$code=  codegen($row["strSpeciesName"]).substr(time(), -2).  rand(100, 999);
					$sql = "INSERT INTO contribution (contributor_name,strSpecies,intSpecies,contribution_code,cardName,address,zipcode,cardNumber,cvv,expmonth,expyear,cost)
			VALUES ('" . $_SESSION["user"] . "','" . $row["strSpeciesName"] . "','" . $_POST["intSpecies"] . "','" . $code . "','" . $_POST["namecard"] . "',"
							. "'" . $_POST["address"] . "','" . $_POST["zipcode"] . "','" . $_POST["cardno"] . "','" . $_POST["cvv"] . "','" . $_POST["expmonth"] . "','" . $_POST["expyear"] . "','" . $row["intCost"] . "')";
							print_r("else");
							print_r($sql);
							print_r($_POST[cardnonew]);
							print_r($_POST[cardno]);
							$conn->query($sql);
							$x++;
					}
					
				}
			}
		header('Location: contribute.php?st=Contribution Added Succesfully');

		}
		else {
			header('Location: contribute.php?st=Invalid Card number');
		}
			
	}

	function codegen($str) {
		$ret = '';
		foreach (explode(' ', $str) as $word)
			$ret .= strtoupper($word[0]);
		return $ret;
	}




