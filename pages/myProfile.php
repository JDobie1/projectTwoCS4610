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
		        <h2 class="fade-in-text">My Profile</h2>
		        <form method="POST" action="myProfile.php">

		          <?php include('errors.php'); ?>

		          <?php

		          	$fName = $_SESSION['fName'];
		          	$lName = $_SESSION['lName'];
		          	$query = "SELECT * FROM users WHERE fName='$fName' AND lName = '$lName'";
		          	$results = mysqli_query($db, $query);

					while($row = mysqli_fetch_array($results)) {
						$fName = $row[1];
						$lName = $row[2];
						$role = $row[3];
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



		    <div>
		    	<h3 class="pageSubtitle">Friend Requests</h3>
		    	<div>
		    	<?php
					$lName = mysqli_real_escape_string($db, $_SESSION['lName']);
					$fName = mysqli_real_escape_string($db, $_SESSION['fName']);

					$query = "SELECT UserID 
								FROM users
								WHERE Lname = '$lName' AND Fname = '$fName'";

					$result = mysqli_query($db, $query);

					$userId = $result->fetch_array()[0];

					$query = "SELECT * 
								FROM FriendRequest
								WHERE UserIDReciever = '$userId'";

					$result = mysqli_query($db, $query);

					while($row = mysqli_fetch_array($result)) {
						$senderId = $row[0];
						$recieverId = $row[1];
						$accepted = $row[2];

						if($accepted == 0)
						{
							if(!isset($result2)){
								echo "<h4 class='pageSubtitle'>Pending Friend Requests</h4>";
							}

							$query2 = "SELECT * 
								FROM users
								WHERE UserID = '$senderId'";

							$result2 = mysqli_query($db, $query2);

							while($row2 = mysqli_fetch_array($result2)) {
								//print_r($row);
								$fName = $row2[1];
								$lName = $row2[2];
								$role = $row2[3];
								$state = $row2[4];
								$zip = $row2[5];

								echo '<div class="card userResult col-md-6 offset-md-3"> 
										<h4>First Name: ' . $fName . '</h4> 
										<h4>Last Name:' . $lName . '</h4>
										<h4>Role: ' . $role . '</h4>
										<h4>State: ' . $state . '</h4>
										<h4>Zip: ' . $zip . '</h4>
										<form method="POST" action="myProfile.php">
											<input type="hidden" value="' . $senderId . '" name="senderId">
											<input type="hidden" value="' . $recieverId . '" name="recieverId">
											<button type="submit" class="btn friendRequest" name="accept_friend_request">Accept</button>
										</form>
									</div>';
							}

						}else if($accepted == 1){
							if(!isset($result3)){
								echo "<h4 class='pageSubtitle'>Accepted Friend Requests</h4>";
							}
							
							$query3 = "SELECT * 
								FROM users
								WHERE UserID = '$senderId'";

							$result3 = mysqli_query($db, $query3);


							while($row3 = mysqli_fetch_array($result3)) {
								$fName = $row3[1];
								$lName = $row3[2];
								$role = $row3[3];
								$state = $row3[4];
								$zip = $row3[5];

								echo '<div class="card userResult col-md-6 offset-md-3"> 
										<h4>First Name: ' . $fName . '</h4> 
										<h4>Last Name:' . $lName . '</h4>
										<h4>Role: ' . $role . '</h4>
										<h4>State: ' . $state . '</h4>
										<h4>Zip: ' . $zip . '</h4>
										<form method="POST" action="myProfile.php">
											<input type="hidden" value="' . $senderId . '" name="senderId">
											<input type="hidden" value="' . $recieverId . '" name="recieverId">
											<button type="submit" class="btn friendRequest" name="remove_friend_request">Remove</button>
										</form>
									</div>';
							}
						}

					}




					$query4 = "SELECT * 
								FROM FriendRequest
								WHERE UserIDSender = '$userId'";


					$result4 = mysqli_query($db, $query4);

					while($row4 = mysqli_fetch_array($result4)) {
						$senderId = $row4[0];
						$recieverId = $row4[1];
						$accepted = $row4[2];

						if($accepted == 0){
							if(!isset($result5)){
								echo "<h4 class='pageSubtitle'>My Pending Friend Requests</h4>";
							}

							$query5 = "SELECT * 
								FROM users
								WHERE UserID = '$recieverId'";

							$result5 = mysqli_query($db, $query5);

							while($row5 = mysqli_fetch_array($result5)) {
								$fName = $row5[1];
								$lName = $row5[2];
								$role = $row5[3];
								$state = $row5[4];
								$zip = $row5[5];

								echo '<div class="card userResult col-md-6 offset-md-3"> 
										<h4>First Name: ' . $fName . '</h4> 
										<h4>Last Name: ' . $lName . '</h4>
										<h4>Role: ' . $role . '</h4>
										<h4>State: ' . $state . '</h4>
										<h4>Zip: ' . $zip . '</h4>
										<form method="POST" action="myProfile.php">
											<input type="hidden" value="' . $senderId . '" name="senderId">
											<input type="hidden" value="' . $recieverId . '" name="recieverId">
											<button type="submit" class="btn friendRequest" name="delete_friend_request">Delete</button>
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