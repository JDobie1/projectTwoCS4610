<?php 
	include('server.php');


	if (!isset($_SESSION['fName'])) {
	  	header('location: login.php');
	  }
	  if (isset($_GET['logout'])) {
	  	session_destroy();
	  	header("location: login.php");
	  }
?>

<!DOCTYPE html>

<html>

	<head>
		<title>Social Theater - <?php echo $_SESSION['fName']?> Profile</title>


		<!--Importing libraries: Bootstrap, jquery, fonts.-->
	    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	    <link href="../css/bootstrap-grid.min.css" rel="stylesheet" type="text/css" />
	    <link href="../css/bootstrap-reboot.min.css" rel="stylesheet" type="text/css" />
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

		<script src="../js/jquery-3.6.0.js" type="text/javascript"></script>
		<script src="../js/bootstrap.min.js" type="text/javascript"></script>


		<!--Importing my own external files.-->
		<link href="../css/style.css" rel="stylesheet" type="text/css" />
		<script src="../js/script.js" type="text/javascript"></script>
                
                <style>
                    body {
                        margin: 0;
                        padding: 0;
                        font-family: Arial, Helvetica, sans-serif;
                        width: 100%;
                        min-height: 100%;
                        background-image: url('../background_noText.png');
                        background-repeat: no-repeat;
                        background-attachment: fixed;
                    }
                </style>
	</head>


	<body>
		<header>
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<a class="navbar-brand" href="../index.php">Social Theater</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mr-auto">
			            <li class="nav-item">
			              <a class="nav-link" href="../index.php">Home</a>
			            </li>
                                    <li class="nav-item">
                                      <a class="nav-link" href="../movies.php">Movies</a>
                                    </li>    
			            <li class="nav-item">
			              <a class="nav-link" href="watchlist.php">Watchlist</a>
			            </li>
			            <li class="nav-item">
			              <a class="nav-link" href="favorites.php">Favorites</a>
			            </li>
			            <li class="nav-item">
			              <a class="nav-link" href="schedule.php">Schedule</a>
			            </li>
			            <li class="nav-item">
			              <a class="nav-link" href="users.php">Users</a>
			            </li>
			            <li class="nav-item">
			              <a class="nav-link" href="theaters.php">Theaters</a>
			            </li>
			          </ul>

					<ul class="navbar-nav ms-auto">
						<?php if(count($_SESSION) > 0) : ?>
							<li class="nav-item dropdown active">
								<a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<?php echo $_SESSION['fName']?>
								</a>
								<div class="dropdown-menu" aria-labelledby="navbarDropdown">
									<a class="dropdown-item" href="myProfile.php">My Profile</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="../index.php?logout='1'">Log Out</a>
								</div>
							</li>
						<?php  endif ?>
		                <?php if(count($_SESSION) == 0) : ?>
							<li class="nav-item">
			                    <a class="nav-link" href="register.php" data-bs-target="#myModal" data-bs-toggle="modal">Register</a>
			                </li>
			                <li class="nav-item">
			                    <a class="nav-link" href="login.php" data-bs-target="#myModal" data-bs-toggle="modal">Login</a>
			                </li>
						<?php  endif ?>
		            </ul>
				</div>

			</nav>
		</header>

		<section>
			<div class="col-md-12">
		        <h2 class="pageTitle">My Profile</h2>
		        <form method="POST" action="myProfile.php">

		          <?php include('errors.php'); ?>


		          <?php

		          	$fName = $_SESSION['fName'];
		          	$lName = $_SESSION['lName'];
		          	$query = "SELECT * FROM users WHERE fName='$fName' AND lName = '$lName'";
		          	$results = mysqli_query($db, $query);

					while($row = mysqli_fetch_array($results)) {
						$fName = $row[0];
						$lName = $row[1];
						$role = $row[2];
						$state = $row[4];
						$zip = $row[5];
					}

		          ?>

		          <div class="inputGroup col-md-6 offset-md-3 row">
		            <label class="col-md-6">First Name:</label>
		            <div class="col-md-6">
		            	<p><?php echo $fName ?></p>
		            </div>
		          </div>


		          <div class="inputGroup col-md-6 offset-md-3 row">
		          	<label class="col-md-6">Last Name:</label>
		          	<div class="col-md-6">
		            	<p><?php echo $lName ?></p>
		            </div>
		          </div>

		          <div class="inputGroup col-md-6 offset-md-3 row">
		            <label class="col-md-6">State:</label>
		            <input class="col-md-6" type="text" name="state" placeholder="State" value="<?php echo $state ?>">
		          </div>

		          <div class="inputGroup col-md-6 offset-md-3 row">
		            <label class="col-md-6">Role:</label>
		            <input class="col-md-6" type="text" name="role" placeholder="Role" value="<?php echo $role ?>">
		          </div>

		          <div class="inputGroup col-md-6 offset-md-3 row">
		            <label class="col-md-6">Zip:</label>
		            <input class="col-md-6" type="text" name="zip" placeholder="Zip" value="<?php echo $zip ?>">
		          </div>

		          <div class="inputGroup col-md-6 offset-md-3 row">
		            <button type="submit" class="btn" name="login_update">Update Info</button>
		          </div>
		        </form>
		    </div>
		</section>


		<footer>


		</footer>


	</body>


</html>