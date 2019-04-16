<?php

session_start();

if(!isset($_SESSION['telephone'])){

  $_SESSION['msg'] = "You need to login first.";
  header("location:bch_login.php");
}

if(isset($_GET['logout'])){

  session_destroy();
  unset($_SESSION['telephone']);
  header("location:bch_login.php");

}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="user-profile.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Home</title>
  </head>
  <body>
    <section class="user-section">
      <div class="container">
        <nav class="navbar navbar-default navbar-fixed-top" style="background-color: #536dfe;">
          <div class="container-fluid">
            <div class="navbar-header">
              <img class="logo" src="images/hospital.svg" width="30" height="30" alt="">
              <a class="navbar-brand" style="margin-left: 20px;" href="#">Bhaktapur Cancer Hospital</a>
            </div>
            <ul style="float: right !important;" class="nav navbar-nav">
              <li><a href="bch_login.php">Home</a></li>
              <li><a href="#">Appointment</a></li>
              <li><a href="#">Services</a></li>
              <li><a href="#">Contacts</a></li>
              <li><a href="bch_index.php?logout='1'">Logout</a></li>
            </ul>

          </div>
        </nav>
      </div>

      <!--adding profile section-->
      <div class="profile-container">
        <div class="profile-pic">
          <img class="pp" src="images/boy.svg" alt="">

        </div>
        <div class="user-profile-options">
          <ul id="services">
            <li><a style="color: white;" href="#"><i class="fas fa-calendar-check fa-lg"></i><span>My Appointment</span></a></li>
            <li><a style="color: white;" href="#"><i class="fas fa-money-check-alt fa-lg"></i><span>Bills and Payment</span></a></li>
            <li><a style="color: white;" href="#"><i class="fas fa-user-cog fa-lg"></i><span>Account Setting</span></a></li>
            <li><a style="color: white;" href="#"><i class="fas fa-file-prescription fa-lg"></i><span>Document</span></a></li>
            <li><a style="color: white;" href="#"><i class="fas fa-receipt fa-lg"></i><span>Recepit</span></a></li>
          </ul>

        </div>


      </div>

      <!--User content section-->
      <div class="user-content">
        <div class="container" id="home">
          <h1>Welcome to your account.</h1>

          <div class="content">
            <?php if(isset($_SESSION['success'])) : ?>
              <div>
                <h3>
                  <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                  ?>
                </h3>
              </div>
            <?php endif ?>

            <?php if(isset($_SESSION['telephone'])) : ?>

              <h3>Welcome <?php echo $_SESSION['telephone']; ?> </h3>



            <?php endif ?>

          </div>



      </div>


      </div>

    </section>





  </body>
</html>
