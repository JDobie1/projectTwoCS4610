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
    header('location: myProfile.php');
  }
}



//Login Page
if (isset($_POST['login_user'])) {
  $fName = mysqli_real_escape_string($db, $_POST['fName']);
  $lName = mysqli_real_escape_string($db, $_POST['lName']);



  if (count($errors) == 0) {
    $query = "SELECT * FROM users WHERE fName='$fName' AND lName='$lName'";

    echo $query;
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



//Users Page (handling friend requests)

if (isset($_POST['friend_request'])) {
  $fNameReciever = mysqli_real_escape_string($db, $_POST['fNameReciever']);
  $lNameReciever = mysqli_real_escape_string($db, $_POST['lNameReciever']);
  $fNameSender = mysqli_real_escape_string($db, $_POST['fNameSender']);
  $lNameSender = mysqli_real_escape_string($db, $_POST['lNameSender']);

  if (count($errors) == 0) {


    $queryFindSender = "SELECT UserID
                        FROM users
                        WHERE Fname = '$fNameSender' AND Lname = '$lNameSender'";

    $queryFindReciever = "SELECT UserID
                          FROM users
                          WHERE Fname = '$fNameReciever' AND Lname = '$lNameReciever'";


    $senderId = mysqli_query($db, $queryFindSender);
    $recieverId = mysqli_query($db, $queryFindReciever);

    $senderId = $senderId->fetch_array()[0];
    $recieverId = $recieverId->fetch_array()[0];

    $query = "INSERT INTO FriendRequest (UserIdSender, UserIdReciever, Accepted)
              VALUES ($senderId, $recieverId, false)";


    mysqli_query($db, $query);
    header('location: myProfile.php');
  }

}



//My Profile Page Accepting a Friend Request

if (isset($_POST['accept_friend_request'])) {
  $recieverId = mysqli_real_escape_string($db, $_POST['recieverId']);
  $senderId = mysqli_real_escape_string($db, $_POST['senderId']);


  if (count($errors) == 0) {
    $query = "UPDATE FriendRequest 
              SET Accepted = true
              WHERE UserIdSender = $senderId AND UserIdReciever = $recieverId";

    mysqli_query($db, $query);
    header('location: myProfile.php');
  }

}



//My Profile Page Removing a Friend Request

if (isset($_POST['remove_friend_request'])) {
  $recieverId = mysqli_real_escape_string($db, $_POST['recieverId']);
  $senderId = mysqli_real_escape_string($db, $_POST['senderId']);


  if (count($errors) == 0) {
    $query = "UPDATE FriendRequest 
              SET Accepted = false
              WHERE UserIdSender = $senderId AND UserIdReciever = $recieverId";

    mysqli_query($db, $query);
    header('location: myProfile.php');
  }

}


//My Profile Page Deleting a Friend Request

if (isset($_POST['delete_friend_request'])) {
  $recieverId = mysqli_real_escape_string($db, $_POST['recieverId']);
  $senderId = mysqli_real_escape_string($db, $_POST['senderId']);

  if (count($errors) == 0) {
    $query = "DELETE FROM FriendRequest 
              WHERE UserIdSender = $senderId AND UserIdReciever = $recieverId";


    mysqli_query($db, $query);
    header('location: myProfile.php');
  }

}



//Theaters page view more takes to theater page
if (isset($_POST['view_theater'])) {
  $theaterId = mysqli_real_escape_string($db, $_POST['theaterId']);

  $_SESSION["theaterId"] = $theaterId;

  header('location: theater.php');

}

//Theater page meet at button
if (isset($_POST['meet_theater'])) {
  $theaterId = mysqli_real_escape_string($db, $_POST['theaterId']);
  $fname = mysqli_real_escape_string($db, $_POST['fName']);
  $lname = mysqli_real_escape_string($db, $_POST['lName']);

  $query = "SELECT UserID
            FROM users
            WHERE Fname = '$fname' AND Lname = '$lname'";

  $userId = mysqli_query($db, $query);
  $userId = $userId->fetch_array()[0];

  
  $query = "INSERT INTO MeetAt (TheaterID, UserID)
            VALUES ($theaterId, $userId)";

  mysqli_query($db, $query);


}



?>