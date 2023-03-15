<?php error_reporting(E_ALL ^ E_NOTICE) ?>
<?php 

	/* Function to validate the registration form */
	function validateRegistrationForm($username, $password, $cnfrmPassword, $email, $mobile, $zip, $role){	
		//Check username availability
		$sqlQuery = "Select strUsername	from usertbl where strUsername='$username' AND role = '$role'";
		$users = executeSelectQuery($sqlQuery);
		if ($users->num_rows > 0){
			echo '<p> User Name already exists, Please choose a new one </p>';
			return false;
		}
		//Check passowrd rules
		if(!empty($password) && !empty($cnfrmPassword)) {
			if($password===$cnfrmPassword){
				if (strlen($password) < '8') {
					echo '<p> Your Password Must Contain At Least 8 Characters! </p>';
					return false;
				}
				elseif(!preg_match("/(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]/",$password)) {
					echo '<p> Your Password must contain atleast one alphabet and one number  </p>';
					return false;
				}
			}
			else {
				echo '<p> Password mismatch, Please try again </p>';
				return false;
			}
		}
		//Check email rules
		$sqlQuery = "Select strUsername	from usertbl where strEmail='$email' AND role = '$role'";
		$users = executeSelectQuery($sqlQuery);
		if ($users->num_rows > 0){
			echo '<p> Sorry the Email has already been registered with other user </p>';
			return false;
		}
		//Check Mobile Number rules
		if (strlen($mobile) != '10') {
			echo '<p> Your Mobile Number must contain 10 numbers </p>';
			return false;
		}
		else if(!preg_match("/^[1-9][0-9]*$/",$mobile)) {
			echo '<p> Invalid Mobile Number  </p>';
			return false;
		}
		//Check ZIP Code rules
		if (strlen($zip) != '5') {
			echo '<p> Your ZIP Code must contain only 5 numbers </p>';
			return false;
		}
		else if(!preg_match("/^[1-9][0-9]*$/",$zip)) {
			echo '<p> Invalid ZIP Code  </p>';
			return false;
		}
		//echo '<p> You have been registered. You must activate your account from the activation link sent to '.$email.'</p>';
		return true;
	}
	
	
	function validatePassword($password, $cnfrmPassword){
		//print_r("inside validate password");
		if(!empty($password) && !empty($cnfrmPassword)) {
			if($password===$cnfrmPassword){
				if (strlen($password) < '8') {
					echo '<p> Your Password Must Contain At Least 8 Characters! </p>';
					return false;
				}
				elseif(!preg_match("/(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]/",$password)) {
					echo '<p> Your Password must contain atleast one alphabet and one number  </p>';
					return false;
				}
			}
			else {
				echo '<p> Password mismatch, Please try again </p>';
				return false;
			}
		}
		return true;
	}

	/* Function to execute the given sql query and return the result list */
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

	/* Function to insert new user details into database during registration */
	function registerUserInDB($username, $password, $email, $mobile, $address, $zip, $userType, $role){
		$activationLink = buildActivationUrl($username);
			// Create DB connection
			$conn = new mysqli("localhost","planettree","planettree","bankdb");
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . mysqli_connect_error());
			}
			else {
				//echo '<p> Connection Success </p>';
				$pass = md5 ($password);
				$sql = "INSERT INTO usertbl (strUsername, strPassword, strEmail, blnActive, strCode, strDate, strRole, strMobileNum, strAddress, intZipCode, role) 
									VALUES ('$username', '$pass', '$email', 0, '$activationLink', sysdate(), '$userType', '$mobile', '$address', '$zip', '$role')";
				if ($conn->query($sql) === TRUE) {
					echo '<p>User Registered, Please activate to complete the registration</p>';
$message = "http://ec2-13-59-33-43.us-east-2.compute.amazonaws.com/activation.php?txtActUsername={$username}&txtActCode={$activationLink}";					
		$send = mail($email,"Account created","Congratulations, you have successfully created account with us. click <a href=\"{$message}\">here</a> to activate your account.");
				} else {
					echo "Error: " . $sql . "<br>" . $conn->error;
				}
				$conn->close();
			}
	}
	
	/* Function to update password for a given username */
	function updatePassword($username, $password, $email, $role){
			// Create DB connection
			$conn = new mysqli("localhost","planettree","planettree","bankdb");
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . mysqli_connect_error());
			}
			else {
				//echo '<p> Connection Success </p>';
				$pass = md5 ($password);
				$sql = "UPDATE usertbl SET strPassword ='$pass' WHERE strUsername = '$username' AND strEmail ='$email'  AND role='$role'";
				
				if ($conn->query($sql) === TRUE) {
					echo '<p>Password Updated Successfully</p>';
					return true;
				} else {
					echo "Error: " . $sql . "<br>" . $conn->error;
				}
				$conn->close();
			}
	}

	/* Function to build activationLink for the new user */
	function buildActivationUrl($username){
			//echo '<p> http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'].'</p>';
			//Build url for activation
			$host = $_SERVER['HTTP_HOST'];
			$file = "/activation.php";
			$actCode = substr( md5(rand()), 0, 7);    //Function to generate random code
			$values = "?txtActUsername=".$username."&txtActCode=".$actCode;
			$completeUrl = "http://".$host.$file.$values;
			//echo '<p>'.$completeUrl.'</p>';
			return $actCode;
	}

	/* Function to activate a new user */
	function activateUser($userName,$ActCode){
			// Create DB connection
			$conn = new mysqli("localhost","planettree","planettree","bankdb");
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . mysqli_connect_error());
			}
			else {
				//echo '<p> Connection Success </p>';
				$sql = "UPDATE usertbl SET  blnActive = 1 WHERE strUsername='$userName'";
				if ($conn->query($sql) === TRUE) {
					echo "<p> Activation Successful, Your registration process is complete </p>";
				} else {
					echo "Error: " . $sql . "<br>" . $conn->error;
				}
				$conn->close();
			}
	}

/* Function to validate the user Info */
	function validateUserInfo($userName,$email, $role){
		$query = "SELECT * FROM usertbl WHERE strUsername='$userName' AND strEmail = '$email' AND role='$role'";
		$result = executeSelectQuery($query);
		if ($result->num_rows ==	0){
			echo "<p> User does not exist </p>";
			return false;
		}
		else{
			return true;
		}
	}

	/* Function to validate the login credentials */
	function validateCredentials($userName,$password,$role){
		$query = "SELECT strPassword FROM usertbl WHERE strUsername='$userName' AND role = '$role' ";
		$result = executeSelectQuery($query);
		if ($result->num_rows ==	0){
			echo "<p> User does not exist </p>";
			return false;
		}
		while($row = $result->fetch_assoc()) {
			$actualPassword = $row["strPassword"];
		}
		if($password ===$actualPassword)
		{
			return true;
		}
		elseif(md5($password) === $actualPassword){
			return true;
		}
		else {
			echo "<p> Invalid passowrd </p>";
			return false;
		}
	}
	/* function to validate the tree contribution */

	/* Function to fetch role of user */
	function fetchRole($userName, $role){
		$query = "SELECT strRole FROM  usertbl WHERE strUsername='$userName' AND role = '$role'";
		//print_r($query);
		$result = executeSelectQuery($query);
		if ($result->num_rows ==	0){
			return null;
		}
		while($row = $result->fetch_assoc()) {
			$role = $row["strRole"];
		}
		return $role;
	}

	/* Function to fetch user details */
	function fetchUser($userName, $role){
		$query = "SELECT * FROM  usertbl WHERE strUsername='$userName' AND role='$role'";
		$result = executeSelectQuery($query);
		if ($result->num_rows ==	0){
			return null;
		}
		$row = $result->fetch_assoc();
		return $row;
	}

	/* Function to requests for planting trees from recievers */
	function requestTree($userName, $species, $quantity, $latitude,$longitude,$location,$reason){
		// Create DB connection
		$conn = new mysqli("localhost","planettree","planettree","bankdb");
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . mysqli_connect_error());
		}
		else {
			//echo <p> Connection Success </p>;
			$sql = "INSERT INTO requestdetailstbl (strUsername, strSpecies, intQuantity, strLatitude, strLongitude, strLocation,strReason,strStartDate,blnReqOpen) 
						VALUES ('$userName', '$species', '$quantity', '$latitude','$longitude','$location','$reason' ,sysdate(), 1)";
			if ($conn->query($sql) === TRUE) {
				echo "<p> Request has been generated successfully </p>";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
			$conn->close();
		}
	}

	function fetchRequests($userName, $role)
	{
		$query = "SELECT * FROM  requestdetailstbl WHERE strUsername='$userName'  AND role='$role'";
		$result = executeSelectQuery($query);
		if ($result->num_rows ==	0){
			return null;
		}
		$row = $result->fetch_assoc();
		return $row;
	}

	function validateChecksum($number) {	 
		// Get the string length and parity
		$number_length = strlen($number);
		$parity = $number_length % 2;
		 
		// Split up the number into single digits and get the total
		$total=0;
		for ($i=0; $i<$number_length; $i++) {
			$digit=$number[$i];
			// Multiply alternate digits by two
			if ($i % 2 == $parity) {
				$digit*=2;
				// If the sum is two digits, add them together
				if ($digit > 9) {
					$digit-=9;
				}
			}
			// Sum up the digits
			$total+=$digit;
		}		 
		// If the total mod 10 equals 0, the number is valid
		return ($total % 10 == 0) ? TRUE : FALSE;
		 
	}
?>

