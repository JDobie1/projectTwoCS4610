<?php
	session_start();
	$db = mysqli_connect('localhost', 'root', '', 'Matt');

	function getDateFromString($input){
		$time_input = str_replace("-", "/", $input);
		$time_input = strtotime($time_input);
		$date_input = getDate($time_input);  
		return $date_input['year'] . "-" . $date_input['mon'] . "-" . $date_input['mday'];
	}


?>

<html>

	<head>
		<title>Social Theater</title>

		<!--Importing libraries: Bootstrap, jquery, fonts.-->
		<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="css/bootstrap-grid.min.css" rel="stylesheet" type="text/css" />
		<link href="css/bootstrap-reboot.min.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

		<script src="js/jquery-3.6.0.js" type="text/javascript"></script>
		<script src="js/bootstrap.min.js" type="text/javascript"></script>

		<!--Importing my own external files.-->
		<link href="css/style.css" rel="stylesheet" type="text/css" />
		<script src="js/script.js" type="text/javascript"></script>
	</head>


	<body>
		<header>
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<a class="navbar-brand" href="index.php">Social Theater</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item">
							<a class="nav-link" href="index.php">Home</a>
						</li>
                        <li class="nav-item active">
							<a class="nav-link" href="movies.php">Movies</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="pages/watchlist.php">Watchlist</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="pages/favorites.php">Favorites</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="pages/users.php">Users</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="pages/theaters.php">Theaters</a>
						</li>
					</ul>

					<ul class="navbar-nav ms-auto">
						<?php if(count($_SESSION) > 0) : ?>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<?php echo $_SESSION['fName']?>
								</a>
								<div class="dropdown-menu" aria-labelledby="navbarDropdown">
									<a class="dropdown-item" href="pages/myProfile.php">My Profile</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="index.php?logout='1'">Log Out</a>
								</div>
							</li>
						<?php  endif ?>
		                <?php if(count($_SESSION) == 0) : ?>
							<li class="nav-item">
			                    <a class="nav-link" href="pages/register.php" data-bs-target="#myModal" data-bs-toggle="modal">Register</a>
			                </li>
			                <li class="nav-item">
			                    <a class="nav-link" href="pages/login.php" data-bs-target="#myModal" data-bs-toggle="modal">Login</a>
			                </li>
						<?php  endif ?>
		            </ul>
				</div>

			</nav>
		</header>


		<section>
			<form method="POST" action="load.php">
				<button type="submit" class="btn friendRequest" name="load_movies">Load Movies</button>
				<button type="submit" class="btn friendRequest" name="load_actors">Load Actors</button>
				<button type="submit" class="btn friendRequest" name="load_theaters">Load Theaters</button>
				<button type="submit" class="btn friendRequest" name="load_users">Load Users</button>
			</form>

			<?php

				if (isset($_POST['load_movies'])) {
					$open = fopen("data/movie.csv", "r");

					$data = fgetcsv($open, 1000, ",");

					while(($data = fgetcsv($open, 1000, ",")) !== FALSE)
					{

						$productioncost = intval($data[0]);
						$name = $data[1];
						$releasedate = getDateFromString($data[2]);
						$boxoffice = intval($data[3]);

						$query = "INSERT INTO movies (MovieID, Name, BoxOffice, Release_Date, Production_Cost)
									VALUES (null, '$name', '$boxoffice', '$releasedate', '$productioncost');";

						mysqli_query($db, $query);
					}

					echo "Movies LOADED";
					fclose($open);
				}


				if (isset($_POST['load_actors'])) {
					$open = fopen("data/actor.csv", "r");

					$data = fgetcsv($open, 1000, ",");

					

					while(($data = fgetcsv($open, 1000, ",")) !== FALSE)
					{

						$fname = $data[0];
						$lname = $data[1];
						$awards = intval($data[2]);

						var_dump($data);

						$query = "INSERT INTO actor (ActorID, Fname, Lname, Award_num)
									VALUES (null, '$fname', '$lname', '$awards');";

						echo $query;
						mysqli_query($db, $query);
					}

					echo "Actors LOADED";
					fclose($open);
				}


				if (isset($_POST['load_theaters'])) {
					$open = fopen("data/theater.csv", "r");

					$data = fgetcsv($open, 1000, ",");

					

					while(($data = fgetcsv($open, 1000, ",")) !== FALSE)
					{

						$type = $data[0];
						$street = $data[1];
						$city = $data[2];
						$state = $data[3];
						$zip = $data[4];

						$query = "INSERT INTO theater (TheaterID, Type, Street, City, State, Zip)
									VALUES (null, '$type', '$street', '$city', '$state', '$zip');";

						mysqli_query($db, $query);
					}

					echo "Theaters LOADED";
					fclose($open);
				}



				if (isset($_POST['load_users'])) {
					$open = fopen("data/user.csv", "r");

					$data = fgetcsv($open, 1000, ",");
					
					while(($data = fgetcsv($open, 1000, ",")) !== FALSE)
					{

						$fname = $data[0];
						$lname = $data[1];
						$role = $data[2];
						$state = $data[3];
						$zip = $data[4];

						//var_dump($data);

						$query = "INSERT INTO users (UserID, Fname, Lname, Role, State, Zip)
									VALUES (null, '$fname', '$lname', '$role', '$state', '$zip');";

						//echo $query;
						mysqli_query($db, $query);
					}

					echo "Users LOADED";
					fclose($open);
				}
				

			?>
		</section>

	</body>

</html>