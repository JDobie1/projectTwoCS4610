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
		<title>Social Theater - Theater</title>


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
				        <li class="nav-item active">
				          <a class="nav-link" href="favorites.php">Favorites</a>
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
		        <h2 class="pageTitle">Theater Information</h2>
		    </div>


		    <div class="row">
		    	<?php
		    		$theaterId = $_SESSION['theaterId'];

					$query = "SELECT * 
								FROM theater
								WHERE TheaterID = '$theaterId'";

					$result = mysqli_query($db, $query);


					while($row = mysqli_fetch_array($result)) {
						$theaterId = $row[0];
						$type = $row[1];
						$street = $row[2];
						$city = $row[3];
						$state = $row[4];
						$zip = $row[5];

						echo '<div class="card userResult col-md-6 offset-md-3"> 
							<h4>Type: ' . $type . '</h4> 
							<h4>Street:' . $street . '</h4>
							<h4>City: ' . $city . '</h4>
							<h4>State: ' . $state . '</h4>
							<h4>Zip: ' . $zip . '</h4>
							<form method="POST" action="theater.php">
								<input type="hidden" value="' . $theaterId . '" name="theaterId">
								<input type="hidden" value="' . $type . '" name="type">
								<input type="hidden" value="' . $street . '" name="street">
								<input type="hidden" value="' . $city . '" name="city">
								<input type="hidden" value="' . $state . '" name="state">
								<input type="hidden" value="' . $zip . '" name="zip">
								<input type="hidden" value="' . $_SESSION["fName"] . '" name="fName">
								<input type="hidden" value="' . $_SESSION["lName"] . '" name="lName">
								<button type="submit" class="btn friendRequest" name="meet_theater">Meet Here</button>
							</form>
							
						</div>';
					}
		    	?>

		    </div>



		    <div>
		    	<?php
		    		$query = "SELECT * 
		    					FROM MeetAt
		    					WHERE TheaterID = $theaterId";

		    		$result = mysqli_query($db, $query);


		    		if(!empty($result)){
		    			echo "<h3 class='pageSubtitle'>People Meeting Here</h3>";
		    		}

		    		while($row = mysqli_fetch_array($result)) {
						$userId = $row[1];
						
						$query1 = "SELECT * 
		    					FROM users
		    					WHERE UserID = $userId";

		    			$result1 = mysqli_query($db, $query1);

		    			while($row1 = mysqli_fetch_array($result1)) {
							$fName = $row1[1];
							$lName = $row1[2];
							$role = $row1[3];
							$state = $row1[4];
							$zip = $row1[5];

							echo '<div class="card userResult col-md-6 offset-md-3"> 
									<h4>First Name: ' . $fName . '</h4> 
									<h4>Last Name:' . $lName . '</h4>
									<h4>Role: ' . $role . '</h4>
									<h4>State: ' . $state . '</h4>
									<h4>Zip: ' . $zip . '</h4>
								</div>';
						}
					}
		    	?>

		    </div>




		</section>


		<footer>


		</footer>


	</body>


</html>