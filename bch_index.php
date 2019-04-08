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
    <title>Home</title>
  </head>
  <body>

    <h1>HomePage</h1>
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

        <p><a href="bch_index.php?logout='1'">Logout</a></p>

      <?php endif ?>
    </div>



  </body>
</html>
