<?php error_reporting(E_ALL ^ E_NOTICE) ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Update Species </title>
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
	<?php
			session_start();
			if(!isset($_SESSION['user']))
			{
				//When user is not logged in, redirect to login page
				header("location: login.php");
			}
	?>
	<?php echo $_GET['st'] ?> 
	<div class="container">
        <div class="panel-heading">
            <div class="panel-title" style="font-size: 20px;font-weight: bolder;" align="center">Add / Update Species</div>
        </div>
        <div class="panel-body">
            <?php
                if (isset($_GET['id']) && !empty($_GET['id'])) {
                    $query = "SELECT * FROM species where intSpecies='" . $_GET['id'] . "'";
					$result = executeSelectQuery($query);
					$req_row = $result->fetch_assoc()                          
            ?>
            <form class="form-horizontal" role="form" enctype="multipart/form-data" method="post" action="updateSpeciessql.php">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">Name of the Species<span style="color:red;">*</span></label>
                    <div class="col-sm-8">                                       
                        <input type="text" class="form-control" id="name_s"  name="name_s" placeholder="Name of the Species" required="" value="<?php echo $req_row['strSpeciesName']; ?>"> 
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">Price in Dollars<span style="color:red;">*</span></label>
                    <div class="col-sm-8">                                       
						<input type="number" class="form-control" id="cost"  name="cost" required="" step="0.01" min="0.01" value="<?php echo $req_row['intCost']; ?>"> 
                    </div>
                </div>
				<input type="text" value="update" name="update" hidden=""> 
                <input type="text" value="<?php echo $req_row['intSpecies']; ?>" name="speciesId" hidden="">
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" class="btn btn-primary">Update</button>
					</div>
                </div>
            </form>
            <?php } else { ?>
			<form class="form-horizontal" role="form" enctype="multipart/form-data" method="post" action="addSpeciessql.php">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">Name of the Species<span style="color:red;">*</span></label>
                    <div class="col-sm-8">                                       
						<input type="text" class="form-control" id="name_s"  name="name_s" placeholder="Name of the Species" required=""> 
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">Price in Dollars<span style="color:red;">*</span></label>
                    <div class="col-sm-8">                                       
                        <input type="number" class="form-control" id="cost"  name="cost" required="" step="0.01" min="0.01"> 
                    </div>
                </div>
                <div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						<button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
            <?php } ?>
        </div>
    </div>
</body>
</html>