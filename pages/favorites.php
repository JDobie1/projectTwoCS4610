<?php 
	include('server.php');


	if (!isset($_SESSION['fName'])) {
	  	header('location: login.php');
	  }
	  if (isset($_GET['logout'])) {
	  	session_destroy();
	  	header("location: login.php");
	  }
          
$dbhost = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbname = "project_two_cs4610";

$conn = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);

$mID = filter_input(INPUT_GET, "movieID");
$delete = "DELETE FROM favorites WHERE movieID = $mID";
$query= mysqli_query($conn, $delete);

if (!$conn) {
    die('Could not connect: ' . mysqli_connect_error());
}
?>

<!DOCTYPE html>

<html>

	<head>
		<title>Social Theater - Favorites</title>


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
                        /*background-size: cover;*/
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
			            <li class="nav-item active">
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
		<div class="col-md-12">
		        <h2 class="pageTitle">Your Favorites</h2>		        
		</div>
            		<section>

			<?php 

				$columns = array('Production_cost','Name','Release_date', 'BoxOffice');

				$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];

				$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';


				if ($result = $db->query('SELECT * FROM favorites ORDER BY ' .  $column . ' ' . $sort_order)) {

				    $up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order);
				    $asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
				    $add_class = ' class="highlight"';

				}

			?>

			<div>
				<table class="moviesTable">
				    <tr>
				        <th><a href="favorites.php?column=MovieID&order=<?php echo $asc_or_desc; ?>">Movie ID<i class="fas fa-sort<?php echo $column == 'MovieID' ? '-' . $up_or_down : ''; ?>"></i></a></th>                                        
				        <th><a href="favorites.php?column=Production_cost&order=<?php echo $asc_or_desc; ?>">Production Cost<i class="fas fa-sort<?php echo $column == 'Production_cost' ? '-' . $up_or_down : ''; ?>"></i></a></th>
				        <th><a href="favorites.php?column=Name&order=<?php echo $asc_or_desc; ?>">Movie Name<i class="fas fa-sort<?php echo $column == 'Name' ? '-' . $up_or_down : ''; ?>"></i></a></th>
				        <th><a href="favorites.php?column=Release_date&order=<?php echo $asc_or_desc; ?>">Release Date<i class="fas fa-sort<?php echo $column == 'Release_date' ? '-' . $up_or_down : ''; ?>"></i></a></th>
				        <th><a href="favorites.php?column=BoxOffice&order=<?php echo $asc_or_desc; ?>">Box Office<i class="fas fa-sort<?php echo $column == 'BoxOffice' ? '-' . $up_or_down : ''; ?>"></i></a></th>
				    </tr>
				    <?php while ($row = $result->fetch_assoc()): ?>
				    <tr>
                                        <td<?php echo $column == 'MovieID' ? $add_class : ''; ?>><?php echo $row['MovieID']; ?></td>
				        <td<?php echo $column == 'Production_cost' ? $add_class : ''; ?>><?php echo $row['Production_cost']; ?></td>
				        <td<?php echo $column == 'Name' ? $add_class : ''; ?>><?php echo $row['Name']; ?></td>
				        <td<?php echo $column == 'Release_date' ? $add_class : ''; ?>><?php echo $row['Release_date']; ?></td>
				        <td<?php echo $column == 'BoxOffice' ? $add_class : ''; ?>><?php echo $row['BoxOffice']; ?></td>
				            <th>
                                                <form>
                                                    <input type="button" value="Delete" onClick="removeFromFavorites(<?php print $row['MovieID']; ?>)" /> 
                                                </form>
                                            </th>
                                    </tr>
				    <?php endwhile; ?>
				</table>
			</div>
		</section>


		<footer>


		</footer>


	</body>


</html>