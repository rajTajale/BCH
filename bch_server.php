<?php

session_start();

//initailizing the variables
$firstName = "";
$lastName = "";
$telephone = "";

$errors = array();

//connecting to SQLiteDatabase

$db = mysqli_connect('localhost','detoxx','','members_bch') or die("Couldn't connect to the database");

//registering the users
if(isset($_POST['register_user'])) {

  $firstName = mysqli_real_escape_string($db, $_POST['firstName']);
  $lastName = mysqli_real_escape_string($db, $_POST['lastName']);
  $telephone = mysqli_real_escape_string($db, $_POST['telephone']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  //form validation

  if(empty($firstName)){
    array_push($errors, "First Name is required.");
  }
  if(empty($lastName)){
    array_push($errors, "Last Name is required.");
  }
  if(empty($telephone)){
    array_push($errors, "Contact number is required.");
  }

  if(empty($password)){
    array_push($errors, "Password is required.");
  }

  //checking the database for existing user with Same first Name and Last Name

  $telephone_check_query = "SELECT * FROM reg_user WHERE telephone = '$telephone' LIMIT 1";
  $results = mysqli_query($db, $telephone_check_query);
  $user = mysqli_fetch_assoc($results);

  if($user){
    if($user['telephone'] === $telephone){
      array_push($errors,"User already exists.");
    }
  }


  //Registering the user if no errors

  if(count($errors) == 0){

    $query = "INSERT INTO reg_user (firstName, lastName, telephone, password) VALUES ('$firstName', '$lastName', '$telephone', '$password')";

    mysqli_query($db, $query);
    $_SESSION['telephone'] = $telephone;
    $_SESSION['success'] = "You are now logged in.";
    header("location:bch_index.php");

  }

}


//logging in the users

if(isset($_POST['login_user'])) {

  $telephone = mysqli_real_escape_string($db, $_POST['telephone']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if(empty($telephone)){
    array_push($errors, "Contact number is required.");
  }

  if(empty($password)){
    array_push($errors, "Password is required.");
  }


  if(count($errors) == 0){

    $query = "SELECT * FROM reg_user WHERE telephone = '$telephone' AND password = '$password'";
    $results = mysqli_query($db, $query);


    if(mysqli_num_rows($results) == 1) {

      $_SESSION['telephone'] = $telephone;
      $_SESSION['success'] = "Succesfully logged in.";
      header("location:bch_index.php");

    }else{
      array_push($errors, "Wrong telephone number or password. Please try again.");
    }
  }

}

?>
