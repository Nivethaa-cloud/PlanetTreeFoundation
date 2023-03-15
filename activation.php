<?php error_reporting(E_ALL ^ E_NOTICE) ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Activation Page </title>
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
</head>
<body style="background-color: #e6e6e6;">
	<?php include 'master.php';?>
		<form action=# method="get">
			<div class="container text-center" >
				<h1>Activation Page</h1>
				<?php	  
					if (isset($_GET['btnActActivate'])) {
					$userName = $_GET["txtActUsername"];
					$ActCode = $_GET["txtActCode"];
					activateUser($userName,$ActCode);
					}
				?>
				<div class="container">
					<div class="row centered-form">
						<div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
							<div class="panel panel-default">
								<div class="panel-body">
									<form role="form">					
										<div class="form-group">
											<label for="actUsername" >Username </label>
											<input type="text" class="form-control input-sm" placeholder="Username" name="txtActUsername" value="<?php echo htmlspecialchars($_GET["txtActUsername"]); ?>"/>
										</div>
										<div class="form-group">                
											<label for="actCode">ActivationCode</label>
											<input type="text" class="form-control input-sm" placeholder="ActivationCode" name="txtActCode" value="<?php echo htmlspecialchars($_GET["txtActCode"]); ?>" />
										</div>	
								</div>
										<input type="submit" class="btn btn-info btn-block" name="btnActActivate" value="Activate" />  
									</form>
							</div>
						</div>
					</div>
				</div>
			</div>
	<?php include 'footer.php';?>	
</body>
</html>
