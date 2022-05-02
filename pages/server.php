<?php

//Registration Page
session_start();

$fName = "";
$lName = "";
$role = "";
$state = "";
$zip = "";

$errors = array(); 

$db = mysqli_connect('localhost', 'root', '', 'project_two_cs4610');

if (isset($_POST['reg_user'])) {
  $fName = mysqli_real_escape_string($db, $_POST['fName']);
  $lName = mysqli_real_escape_string($db, $_POST['lName']);
  $role = mysqli_real_escape_string($db, $_POST['role']);
  $state = mysqli_real_escape_string($db, $_POST['state']);
  $zip = mysqli_real_escape_string($db, $_POST['zip']);





  if (count($errors) == 0) {

    $query = "INSERT INTO users (`UserID`, `fName`, `lName`, `role`, `state`, `zip`) 
                VALUES(NULL, '$fName', '$lName', '$role', '$state', '$zip')";

    print_r($query);
    mysqli_query($db, $query);
    $_SESSION['fName'] = $fName;
    $_SESSION['lName'] = $lName;
    header('location: ../index.php');
  }
}



//Login Page
if (isset($_POST['login_user'])) {
  $fName = mysqli_real_escape_string($db, $_POST['fName']);
  $lName = mysqli_real_escape_string($db, $_POST['lName']);

  if (count($errors) == 0) {
    $query = "SELECT * FROM users WHERE fName='$fName' AND lName='$lName'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
      $_SESSION['fName'] = $fName;
      $_SESSION['lName'] = $lName;
      header('location: myProfile.php');
    }else {
      array_push($errors, "Wrong username/password combination");
    }
  }
}



//User Profile Page

if (isset($_POST['login_update'])) {
  $role = mysqli_real_escape_string($db, $_POST['role']);
  $state = mysqli_real_escape_string($db, $_POST['state']);
  $zip = mysqli_real_escape_string($db, $_POST['zip']);

  if (count($errors) == 0) {

    $fNameOld = $_SESSION['fName'];
    $lNameOld = $_SESSION['lName'];

    $query = "UPDATE users 
              SET fName = '$fNameOld', lName = '$lNameOld', role = '$role', state = '$state', zip = '$zip'
              WHERE Fname = '$fNameOld' AND Lname = '$lNameOld'";

    mysqli_query($db, $query);
    $_SESSION['fName'] = $fNameOld;
    $_SESSION['lName'] = $lNameOld;
  }

}


?>