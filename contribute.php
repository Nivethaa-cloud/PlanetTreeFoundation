<?php error_reporting(E_ALL ^ E_NOTICE) ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
	</head>
	<body style="background-color: #e6e6e6;">
	
<head>
	<title> contribute </title>
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
	<script>
		function changetextbox()
		{
			if (document.myform.cardno.value == 1) {
				document.myform.cardnonew.disabled = 0;
			} else {
				document.myform.cardnonew.disabled = 1;
			}
		}
	</script>
</head>
<body style="background-color: bisque;">
	<?php include 'master.php';?>
	<?php
		session_start();
		if(!isset($_SESSION['user']))
		{
			//When user is not logged in, redirect to login page
			header("location: login.php");
		}			
		$conn = new mysqli("localhost","planettree","planettree","bankdb");
	?>
	<?php echo "<h2><strong>".$_GET['st']."</strong></h2>" ?>
	<div class="page-content">
		<div class="row">
			<div class="col-md-9">
				<div class="col-md-9">				
					<div class="content-box-large">
						<div class="panel-heading">
							<div class="panel-title" style="font-size: 20px;font-weight: bolder;">Contribute</div>
						</div>
						<div class="panel-body">							
							<form class="form-horizontal" role="form" name = "myform" enctype="multipart/form-data" method="post" action="addContribution.php">
								<?php
									$query = "SELECT * FROM species";
									$result = executeSelectQuery($query);
									
								?>
								<div class="form-group">
									<label class="col-md-4 control-label" for="select-1">Species</label>
									<div class="col-md-8">
										<select class="form-control" name="intSpecies" id="intSpecies" required="">
											<?php while ($row = $result->fetch_assoc()) { ?>
												<option value="<?php echo $row['intSpecies']; ?>" ><?php echo $row['strSpeciesName']." each $ ".$row['intCost'].""; ?></option>
											<?php } ?> 
										</select> 
									</div>
								</div>    
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-4 control-label">Quantity<span style="color:red;">*</span></label>
									<div class="col-sm-8">                                       
										<input type="number" class="form-control"   name="quantity"  required="" min="1" value="1" required=""> 
									</div>
								</div>
								<h4>Card Info</h4><br>
									<?php
										$currentUser = $_SESSION['user'];
										$query = "SELECT DISTINCT cardNumber FROM contribution WHERE contributor_name = '$currentUser'";
										$result = executeSelectQuery($query);	
										//print_r($result);
										if($result->num_rows > 0){
									?>
									<div class="form-group">		
											<label for="select-1" class="col-md-4 control-label">Card Number<span style="color:red;">*</span></label>
											<div class="col-md-8">
												<select class="form-control" name="cardno" id="cccard" required="true"  onChange="changetextbox();">
													<option value="0">Select From Existing</option>
													<option value="1">Don't want to use existing</option>
													<?php while ($row = $result->fetch_assoc()) { ?>
													<option value="<?php echo $row['cardNumber']; ?>" ><?php echo $row['cardNumber']; ?></option>
													<?php } ?> 
												</select> 
											</div>
									</div>
									
									
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-4 control-label">Use New Card<span style="color:red;">*</span></label>
										<div class="col-sm-8">                                       
											<input type="text" class="form-control"  disabled ="true" id= "cccardnew" name="cardnonew"  placeholder="New Card Number" required="true" pattern="^\d{16}"> 
										</div>
									</div>
									
									<?php	}  
									else { ?>
								
								<div class="form-group">	
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-4 control-label">Card Number<span style="color:red;">*</span></label>
										<div class="col-sm-8">                                       
											<input type="text" class="form-control"   id= "cccard" name="cardno"  placeholder="Card Number" required="true" pattern="^\d{16}"> 
										</div>
									</div>
								</div>
									<?php } ?>
								<div class="form-group">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-4 control-label">CVV<span style="color:red;">*</span></label>
										<div class="col-sm-8">                                       
											<input type="text" class="form-control"   name="cvv"  placeholder="CVV" required="" pattern="^\d{3}"> 
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-4 control-label">Card Expiry<span style="color:red;">*</span></label>
										<div class="col-sm-4">  
											<select class="form-control" name="expmonth" id="expmonth" required="">
												<?php for($i=1;$i<=12;$i++) {?>
													<option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
												<?php } ?> 
											</select> 										   
										</div>
										<div class="col-sm-4">                                       
										   <select class="form-control" name="expyear" id="expyear" required="">
												<?php for($i=2017;$i<=2030;$i++) {?>
													<option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
												<?php } ?> 
											</select> 
										</div>
									</div>									
									<label for="inputEmail3" class="col-sm-4 control-label">Name as on the Card<span style="color:red;">*</span></label>
									<div class="col-sm-8">                                       
										<input type="text" class="form-control"   name="namecard"  placeholder="Name on the Card" required=""> 
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-4 control-label">Street Address<span style="color:red;">*</span></label>
									<div class="col-sm-8">                                       
										<input type="text" class="form-control"   name="address"  placeholder="Street Address" required=""> 
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-4 control-label">Zip Code<span style="color:red;">*</span></label>
									<div class="col-sm-8">                                       
										<input type="text" class="form-control"   name="zipcode"  placeholder="Zip Code" required="" pattern="^\d{5}"> 
									</div>
								</div>
								<input type="text" name="user" value="<?php echo $_SESSION['user']; ?>" hidden="">
								<div class="form-group">
									<div class="col-sm-offset-4 col-sm-8">
										<button type="submit" class="btn btn-primary" name="btnRegSubmit">Donate</button>
										<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
										<input type="hidden" name="cmd" value="_s-xclick">
										<input type="hidden" name="hosted_button_id" value="YLEE36RLMEXZW">
										<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
										<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
										</form>
									</div>
								</div>
							</form>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include 'footer.php';?>
</body>
</html>
		