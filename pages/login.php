<?php include('server.php') ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Social Theater - User Login</title>


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
            <li class="nav-item">
              <a class="nav-link" href="users.php">Users</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="theaters.php">Theaters</a>
            </li>
          </ul>


          <ul class="navbar-nav ms-auto">
            <?php if(count($_SESSION) > 0) : ?>
              <li class="nav-item">
                  <a class="nav-link" href="myProfile.php" data-bs-target="#myModal" data-bs-toggle="modal"><?php echo $_SESSION['fName']?></a>
              </li>
            <?php  endif ?>
            <?php if(count($_SESSION) == 0) : ?>
              <li class="nav-item">
                  <a class="nav-link" href="register.php" data-bs-target="#myModal" data-bs-toggle="modal">Register</a>
              </li>
              <li class="nav-item active">
                  <a class="nav-link" href="login.php" data-bs-target="#myModal" data-bs-toggle="modal">Login</a>
              </li>
            <?php  endif ?>
          </ul>
        </div>

      </nav>
    </header>


    <section>

      <div class="col-md-12">
        <h2 class="pageTitle">User Login</h2>
        <form method="POST" action="login.php">

          <?php include('errors.php'); ?>

          <div class="inputGroup col-md-6 offset-md-3 row">
            <label class="col-md-6">First Name:</label>
            <input class="col-md-6" type="text" name="fName" placeholder="First Name">
          </div>

          <div class="inputGroup col-md-6 offset-md-3 row">
            <label class="col-md-6">Last Name:</label>
            <input class="col-md-6" type="text" name="lName" placeholder="Last Name">
          </div>


          <div class="col-md-6 offset-md-3 row">
            <p class="col-md-6">
              Not registered? Sign up <a href="register.php">here</a>.
            </p>
          </div>

          <div class="inputGroup col-md-6 offset-md-3 row">
            <button type="submit" class="btn" name="login_user">Login</button>
          </div>
        </form>
      </div>

    </section>


    <footer>


    </footer>
  </body>
</html>