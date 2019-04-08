<?php include('bch_server.php') ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="user_reg.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <title></title>
  </head>
  <body>
    <section class="user-create">
      <img class="img1" src="images/create_acc.jpg" alt="loading">
      <div class="container">
        <nav class="navbar navbar-default navbar-fixed-top" style="background-color: #405DE6;">
          <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href="#">Bhaktapur Cancer Hospital</a>
            </div>
            <ul style="float: right !important;" class="nav navbar-nav">
              <li><a href="bch_login.php">Home</a></li>
              <li><a href="#">Appointment</a></li>
              <li><a href="#">Services</a></li>
              <li><a href="#">Contacts</a></li>
              <li><a href="bch_userReg.php">Create account</a></li>
            </ul>

          </div>
        </nav>
      </div>

      <div id="home" class="container">
        <div class="container-fluid">
          <div class="col" id="form_container">
            <div class="row-sm-2">
              <form action="bch_userReg.php" method="post">
                <?php include('bch_errors.php') ?>
                <div class="form-group">
                  <label for="firstName"></label>
                  <input type="text" name="firstName" class="form-control" id="firstName" placeholder="First Name">
                </div>
                <div class="form-group">
                  <label for="lastName"></label>
                  <input type="text" name="lastName" class="form-control" id="lastName" placeholder="Last Name">
                </div>
                <div class="form-group">
                  <label for="telephone"></label>
                  <input type="tel" name="telephone" class="form-control" id="telephone" placeholder="Phone Number">
                </div>
                <div class="form-group">
                  <label for="password"></label>
                  <input type="password" name="password" class="form-control" id="pwd" placeholder="Password">
                </div>
                <br>
                <button type="submit" name= "register_user" class="btn btn-default">Create</button>
              </form>

            </div>

          </div>

        </div>

      </div>

    </section>


  </body>
</html>
