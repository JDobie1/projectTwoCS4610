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
		<title>Social Theater - Users</title>


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
		        <li class="nav-item">
		          <a class="nav-link" href="favorites.php">Favorites</a>
		        </li>
		        <li class="nav-item active">
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
		        <h2 class="fade-in-text">Users</h2>


		        <form method="POST" action="users.php">

		          <div class="inputGroup col-md-6 offset-md-3 row">
		            <label class="col-md-6">Search By Last Name:</label>
		            <input class="col-md-6" type="text" name="lName" placeholder="Search By Last Name" value="<?php if (isset($_POST['users_search'])) { echo $_POST['lName']; } else if(isset($_GET['lName'])){ echo $_GET['lName']; } ?>">
		          </div>

		          <div class="inputGroup col-md-6 offset-md-3 row">
		            <button type="submit" class="btn" name="users_search">Search</button>
		          </div>
		        </form>
		        
		    </div>


		    <div class="row">
		    	<?php
		    		if (isset($_POST['users_search'])) {

						$lName = mysqli_real_escape_string($db, $_POST['lName']);

						$query = "SELECT * 
									FROM users
									WHERE Lname LIKE '%$lName%'";

						$result = mysqli_query($db, $query);


						while($row = mysqli_fetch_array($result)) {
							$fName = $row[1];
							$lName = $row[2];
							$role = $row[3];
							$state = $row[4];
							$zip = $row[5];

							if(strcasecmp($fName, $_SESSION['fName']) != 0 || strcasecmp($lName, $_SESSION['lName']) != 0){
								echo '<div class="card userResult col-md-6 offset-md-3"> 
									<h4>First Name: ' . $fName . '</h4> 
									<h4>Last Name:' . $lName . '</h4>
									<h4>Role: ' . $role . '</h4>
									<h4>State: ' . $state . '</h4>
									<h4>Zip: ' . $zip . '</h4>
									<form method="POST" action="users.php?lName=' . $_POST['lName'] . '">
										<input type="hidden" value="' . $fName . '" name="fNameReciever">
										<input type="hidden" value="' . $lName . '" name="lNameReciever">
										<input type="hidden" value="' . $_SESSION["fName"] . '" name="fNameSender">
										<input type="hidden" value="' . $_SESSION["lName"] . '" name="lNameSender">
										<button type="submit" class="btn friendRequest" name="friend_request">Friend Request</button>
									</form>
									
								</div>';
							}
						}

					}
		    	?>

		    </div>
		</section>


		<footer>


		</footer>


	</body>


</html>