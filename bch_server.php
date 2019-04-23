<?php

session_start();

//initailizing the variables
$FirstName = "";
$LastName = "";
$Phone = "";
$Gender = "";
$Password ="";


//array for storing all the validation errors
$errors = array();


//connecting to SQLiteDatabase

$db = mysqli_connect('localhost','detoxx','','hospital') or die("Couldn't connect to the database");

//registering the users
if(isset($_POST['register_user'])) {

  $FirstName = mysqli_real_escape_string($db, $_POST['FirstName']);
  $LastName = mysqli_real_escape_string($db, $_POST['LastName']);
  $Phone = mysqli_real_escape_string($db, $_POST['Phone']);
  $Gender = mysqli_real_escape_string($db, $_POST['Gender']);
  $Password = mysqli_real_escape_string($db, $_POST['Password']);

  //form validation

  if(empty($FirstName)){
    array_push($errors, "First Name is required.");
  }
  if(empty($LastName)){
    array_push($errors, "Last Name is required.");
  }
  if(empty($Phone)){
    array_push($errors, "Contact number is required.");
  }

  if(empty($Password)){
    array_push($errors, "Password is required.");
  }

  //checking the database for existing user with Same first Name and Last Name

  $Phone_check_query = "SELECT * FROM PATIENT WHERE Phone = '$Phone' LIMIT 1";
  $results = mysqli_query($db, $Phone_check_query);
  $user = mysqli_fetch_assoc($results);

  if($user){
    if($user['Phone'] === $Phone){
      array_push($errors, "User already exists.");
    }
  }


  //Registering the user if no errors

  if(count($errors) == 0){

    $query = "INSERT INTO PATIENT (FirstName, LastName, Phone, Gender, Password) VALUES ('$FirstName', '$LastName', '$Phone','$Gender', '$Password')";

    mysqli_query($db, $query);
    $_SESSION['Phone'] = $Phone;
    $_SESSION['success'] = "You are now logged in.";
    header("location:bch_index.php");

  }

}


//logging in the users

if(isset($_POST['login_user'])) {
  $Phone = mysqli_real_escape_string($db, $_POST['Phone']);
  $Password = mysqli_real_escape_string($db, $_POST['Password']);

  if(empty($Phone)){
    array_push($errors, "Contact number is required.");
  }

  if(empty($Password)){
    array_push($errors, "Password is required.");
  }


  if(count($errors) == 0){

    $query = "SELECT * FROM PATIENT WHERE Phone = '$Phone' AND Password = '$Password'";
    $results = mysqli_query($db, $query);


    if(mysqli_num_rows($results) == 1) {

      $_SESSION['Phone'] = $Phone;
      $_SESSION['success'] = "Succesfully logged in.";
      header("location:bch_index.php");

    }else{
      array_push($errors, "Wrong telephone number or password. Please try again.");
    }
  }
}



  
  