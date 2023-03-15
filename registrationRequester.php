<?php error_reporting(E_ALL ^ E_NOTICE) ?>
<?php include 'master.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Registration Page </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<style type="text/css">
		p {
			color: red;
		}
	</style>
		<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript">
		function checkname()
		{
		 var name=document.getElementById( "txtRegUsrName" ).value;
			
		 if(name)
		 {
		  $.ajax({
		  type: 'post',
		  url: 'checkDataRequester.php',
		  data: {
			user_name:name,
		  },
		  success: function (response) {
		   $( '#name_status' ).html(response);
		   if(response=="OK")	
		   {
			return true;	
		   }
		   else
		   {
			return false;	
		   }
		  }
		  });
		 }
		 else
		 {
		  $( '#name_status' ).html("");
		  return false;
		 }
		}

		function checkemail()
		{
		 var email=document.getElementById("txtRegEmail").value;
			
		 if(email)
		 {
		  $.ajax({
		  type: 'post',
		  url: 'checkDataRequester.php',
		  data: {
		   user_email:email,
		  },
		  success: function (response) {
		   $( '#email_status' ).html(response);
		   if(response=="OK")	
		   {
			return true;	
		   }
		   else
		   {
			return false;	
		   }
		  }
		  });
		 }
		 else
		 {
		  $( '#email_status' ).html("");
		  return false;
		 }
		}
		
		function checkmobileNo()
		{
		 var mobile=document.getElementById("txtRegMobile").value;
			
		 if(mobile)
		 {
		  $.ajax({
		  type: 'post',
		  url: 'checkDataRequester.php',
		  data: {
		   mobile_number:mobile,
		  },
		  success: function (response) {
		   $( '#mobile_status' ).html(response);
		   if(response=="OK")	
		   {
			return true;	
		   }
		   else
		   {
			return false;	
		   }
		  }
		  });
		 }
		 else
		 {
		  $( '#mobile_status' ).html("");
		  return false;
		 }
		}

		function checkall()
		{
		 var namehtml=document.getElementById("name_status").innerHTML;
		 var emailhtml=document.getElementById("email_status").innerHTML;
		 var mobilehtml=document.getElementById("mobile_status").innerHTML;
		 //alert(namehtml);alert(emailhtml);alert(mobilehtml);

		 if(namehtmlstr.includes("OK")){
				 if(emailhtml.includes("OK")){
					 if(mobilehtml.includes("OK")){
						return true;
				 }
			 }
		 }
		 else
		 {
			return false;
		 }
		}
	</script>
</head>

<body style="background-color: #e6e6e6;">
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" onsubmit="return checkall();">
		<div class="container text-center">			
			<?php	  
				if (isset($_POST['btnRegSubmit'])) {
					//Fetch form field values 
					$username = $_POST['txtRegUsrName'];
					$password = $_POST['txtRegPassword'];
					$cnfrmPassword = $_POST['txtRegPasswordConfirm'];
					$email = $_POST['txtRegEmail'];	
					$mobile = $_POST['txtRegMobile'];
					$address = $_POST['txtRegAddress'];
					$zip = $_POST['txtRegZip'];
					$role = 1;
					$booleanValidations = validateRegistrationForm($username, $password, $cnfrmPassword, $email, $mobile, $zip, $role);
					if($booleanValidations==true){
						registerUserInDB($username, $password, $email, $mobile, $address, $zip, "requester",$role);
					}
				}
			?>
			<div class="container" style="margin-top: 10px;">
				<div class="row centered-form">
					<div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h2 class="panel-title">Please sign up - Requester </h2>
							</div>
							<div class="panel-body">
								<form role="form">																			
									<div class="form-group">
										<input type="text" id="txtRegUsrName" name="txtRegUsrName" class="form-control input-sm" placeholder="UserName" onkeyup="checkname();" required="true"/>
										<span id="name_status"></span>
									</div>		
									<div class="row">
										<div class="col-xs-6 col-sm-6 col-md-6">
											<div class="form-group">
												<input type="password" name="txtRegPassword" class="form-control input-sm" placeholder="Password"  required="true"/>
											</div>
										</div>
										<div class="col-xs-6 col-sm-6 col-md-6">
											<div class="form-group">
												<input type="password" name="txtRegPasswordConfirm" class="form-control input-sm" placeholder="Retype Password" required="true"/>
											</div>
										</div>
									</div>									  
									<div class="form-group">
										<input type="email" id="txtRegEmail" name="txtRegEmail" class="form-control input-sm" placeholder="Email Address" onkeyup="checkemail();" required="true"/>	
										<span id="email_status"></span>			
									</div>						
									<div class="form-group">
										<input type="text" id="txtRegMobile" name="txtRegMobile" maxlength="10" class="form-control input-sm" placeholder="Mobile Number" onkeyup="checkmobileNo();" required="true"/>
										<span id="mobile_status"></span>
									</div>								  
									<div class="form-group">
										<textarea name="txtRegAddress" rows="2" cols="22" class="form-control input-sm" placeholder="Address" required="true"></textarea>			
									</div>								
									<div class="form-group">
										<input type="text" name="txtRegZip" class="form-control input-sm" placeholder="ZIP Code" required="true"/>
									</div>					
									<input type="submit" name="btnRegSubmit" value="Register" class="btn btn-info btn-block" />
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
	<?php include 'footer.php';?>	
</body>
</html>