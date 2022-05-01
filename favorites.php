<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbname = "project_two_cs4610";

$conn = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);

$x = filter_input(INPUT_GET, "movieID");
$delete = "DELETE FROM favorites WHERE movieID = $x";
$query= mysqli_query($conn, $delete);

if (!$conn) {
    die('Could not connect: ' . mysqli_connect_error());
}

//$result = mysqli_query($conn, "SELECT * FROM movies");

$columns = array('MovieID, Production_cost','Name','Release_date', 'BoxOffice');

$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];

$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

if ($result = $conn->query('SELECT * FROM favorites ORDER BY ' .  $column . ' ' . $sort_order)) {

    $up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order);
    $asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
    $add_class = ' class="highlight"';
?>


<!DOCTYPE html>
<html lang="en">
<head>
     <title>Collected Movies</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="./index.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/projectTwo.js"></script>
    <style>
        input[type=button] {
        background-color: #3399ff;
        border: none;
        color: white;
        padding: 12px 24px;
        text-decoration: none;
        margin: 4px 2px;
        cursor: pointer;
        }
    </style>
</head>
<header>
    <div id="top-header">

        <nav>
            <div class="topnav">
                <ul>
                    <li><a href="index.php"> Home</a></li>
                    <li><a class="active" href="movies.php"> Movies</a></li>
                    <li><a href="watchlist.php"> Watchlist</a></li>
                    <li><a href="favorites.php"> Favorites</a></li>
                    <li><a href="friends.php"> Friends</a></li>
                    <li><a href="schedule.php"> Schedule</a></li>
                </ul>

                <div class="search-container">
                    <form action="/placeholder.php">
                        <input type="text" placeholder="Search Movies.." name="search">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>

        </nav>
    </div>
</header>
<body>
<table>
    <h2> Favorites</h2>
    <tr>
        <th><a href="index.php?column=joined&order=<?php echo $asc_or_desc; ?>">MovieID<i class="fas fa-sort<?php echo $column == 'MovieID' ? '-' . $up_or_down : ''; ?>"></i></a></th>        
<!--        <th><a href="index.php?column=joined&order=<?php echo $asc_or_desc; ?>">User<i class="fas fa-sort<?php echo $column == 'User' ? '-' . $up_or_down : ''; ?>"></i></a></th>-->
        <th><a href="index.php?column=name&order=<?php echo $asc_or_desc; ?>">Production Cost<i class="fas fa-sort<?php echo $column == 'Production_cost' ? '-' . $up_or_down : ''; ?>"></i></a></th>
        <th><a href="index.php?column=age&order=<?php echo $asc_or_desc; ?>">Movie Name<i class="fas fa-sort<?php echo $column == 'Name' ? '-' . $up_or_down : ''; ?>"></i></a></th>
        <th><a href="index.php?column=joined&order=<?php echo $asc_or_desc; ?>">Release Date<i class="fas fa-sort<?php echo $column == 'Release_date' ? '-' . $up_or_down : ''; ?>"></i></a></th>
        <th><a href="index.php?column=joined&order=<?php echo $asc_or_desc; ?>">Box Office<i class="fas fa-sort<?php echo $column == 'BoxOffice' ? '-' . $up_or_down : ''; ?>"></i></a></th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td<?php echo $column == 'MovieID' ? $add_class : ''; ?>><?php echo $row['MovieID']; ?></td>
        <td<?php echo $column == 'Production_cost' ? $add_class : ''; ?>><?php echo $row['Production_cost']; ?></td>
        <td<?php echo $column == 'Name' ? $add_class : ''; ?>><?php echo $row['Name']; ?></td>
        <td<?php echo $column == 'Release_date' ? $add_class : ''; ?>><?php echo $row['Release_date']; ?></td>
        <td<?php echo $column == 'BoxOffice' ? $add_class : ''; ?>><?php echo $row['BoxOffice']; ?></td>
                
        <th style="width: 8em">
            <form>
                <input type="button" value="Remove from Favorites" onClick="removeFromFavorites(<?php print $row['MovieID']; ?>)" /> 
            </form>
        </th>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
    <?php
    $result->free();
}
?>

