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
    
    <!-- Utilizing <style> here because for some reason body and image formatting would not work within the css file -->
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
            width: 100%;
            min-height: 100%;
            background-image: url('backgroundImage.png');
            background-repeat: no-repeat;
            background-attachment: fixed;
/*            background-size: cover;*/
        }
        p > img {
            width: 150px;
            height: 150px;
            object-fit: contain;
            margin-top: 5px;
            margin-left: 25px;
            margin-right: 100px;
            float: left;
        }
    </style>
    
</head>

<header>

    <div id="top-header">
          

        <nav>
            <div class="topnav">
                <p><img src="umslLogo.jpg"/></p>                
                <ul>                    
                    <li><a class="active" href="index.php"> Home</a></li>
                    <li><a href="movies.php"> Movies</a></li>
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
</body>
</html>


