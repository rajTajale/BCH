<?php

session_start();
$errors = array();
$db = mysqli_connect('localhost', 'detoxx', '', 'hospital');

$date = "";
$starttime = "";
$treatment = "";
$doctor = "";
$user = "";




if (!isset($_SESSION['Phone'])) {

  $_SESSION['msg'] = "You need to login first.";
  header("location:bch_login.php");
}

if (isset($_GET['logout'])) {

  session_destroy();
  unset($_SESSION['Phone']);
  header("location:bch_login.php");
}

//Scheduling the appointment 

if (isset($_POST['schedule_Appointment'])) {
  $date = mysqli_real_escape_string($db, $_POST['Date']);
  //getting the value directly from the select option
  $treatment = $_POST['TreatmentName'];
  $starttime = mysqli_real_escape_string($db, $_POST['starttime']);
  $doctor = $_POST['selecteddoc'];
  $phone = $_SESSION['Phone'];

  $schedulequery = "INSERT INTO APPOINTMENT (Date, TreatmentName, starttime, DoctorID, PatientID)
  VALUES ('$date','$treatment', '$starttime', 
  (SELECT DoctorID FROM DOCTOR WHERE FullName = '$doctor'), 
  (SELECT PatientID FROM PATIENT WHERE Phone = '$phone'))";

  if (mysqli_query($db, $schedulequery)) {
    echo 'Scheduled succesfully.';
  } else {
    echo '<h1>Error:' . mysqli_error($db) . '</h1>';
  }
  header("location: bch_index.php");
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
  <script type="text/javascript" src="main.js"></script>
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
          <ul id="topBotomBordersOut" style="float: right !important;" class="nav navbar-nav">
            <li><a href="bch_login.php">HOME</a></li>
            <li><a href="#">APPOINTMENT</a></li>


            <li><a href="bch_index.php?logout='1'">SIGN OUT</a></li>
          </ul>

        </div>
      </nav>
    </div>

    <!--adding profile section-->
    <div class="container" id="profile-container">
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

        <div class="content">

          <?php if (isset($_SESSION['success'])) : ?>
            <div>
              <h6>
                <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
              </h6>
            </div>
          <?php endif ?>

          <!--button to view logged in user profile-->
          <div class="userbtnacctions">
            <input type="button" class="btn btn-outline-primary" onclick="displayProfile()" id="profilebtn" value="View Profile" </button> <div class="divider"></div>
          <input type="button" class="btn btn-outline-primary" onclick="displayAppointment()" id="schedulebtn" value="Schedule Appointment" </button> </div> <!--User Profile from database-->
          <?php
          $Phone = $_SESSION['Phone'];
          $sql = "SELECT PATIENT.PatientID, PATIENT.FirstName, PATIENT.LastName, PATIENT.Phone
                    FROM PATIENT
                    WHERE PATIENT.Phone = $Phone";
          $query = mysqli_query($db, $sql);
          if (mysqli_num_rows($query) == 0) {
            echo '<div class="showAppt">';
            echo 'There are no appointments yet.';
            echo '</div>';
          } else {
            while ($row = mysqli_fetch_assoc($query)) {
              echo '<div class="user-appointContent">';
              echo '<h3 id="welecometxt">Welcome' . "&nbsp;" . '<i>' . $row['FirstName'] . "&nbsp;" . $row['LastName'] . '</i>' . '</h3>';
              echo "</div>";
            }
          }
          ?>

          <div id="userProfile" class="container">
            <?php

            $Phone = $_SESSION['Phone'];
            $profilesql = " SELECT PATIENT.FirstName, PATIENT.LastName, PATIENT.Phone, PATIENT.Gender
                                FROM Patient
                                WHERE PATIENT.Phone = $Phone";
            $profilesqlresult = mysqli_query($db, $profilesql);

            while ($data  = mysqli_fetch_assoc($profilesqlresult)) {
              echo '<div class="profile-info">';
              echo '<h5>First Name</h5>';
              echo '<h6>' . $data['FirstName'] . '</h6>';
              echo '<h5>Last Name</h5>';
              echo '<h6>' . $data['LastName'] . '</h6>';
              echo '<h5>Gender</h5>';
              echo '<h6>' . $data['Gender'] . '</h6>';
              echo '<h5>Phone Number</h5>';
              echo '<h6>' . $data['Phone'] . '</h6>';
              echo '</div>';
            }
            ?>


          </div>

          <br>
          <br>

          <div class="container-fluid" id="scheduleAppointment">
            <form action="bch_index.php" method="post">
              <!-- <?php include('bch_errors.php') ?> -->
              <div class="form-group row">
                <label for="Date" class="col-sm-3 col-form-label">Date</label>
                <div class="col-sm-2">
                  <input name="Date" type="date" class="form-control" id="Date">
                </div>
              </div>
              <div class="verticaldivider">
              </div>

              <div class="form-group row">
                <label for="TreatmentName" class="col-sm-3 col-form-label">Treatments</label>
                <div class="col-sm-2" id="listofservices">
                  <select name="TreatmentName" class="form-control">
                    <?php

                    $treatmentsql = "SELECT DEPARTMENT.DepartmentTreatment
                                    FROM DEPARTMENT";
                    $treatmentsqlresult = mysqli_query($db, $treatmentsql);

                    while ($services = mysqli_fetch_assoc($treatmentsqlresult)) {
                      echo '<option>' . $services['DepartmentTreatment'] . '</option>';
                    }



                    ?>
                  </select>
                </div>
              </div>
              <div class="verticaldivider">
              </div>

              <div class="form-group row">
                <label for="starttime" class="col-sm-3 col-form-label">Time</label>
                <div class="col-sm-2">
                  <input name="starttime" type="time" class="form-control" id="starttime">
                </div>

              </div>
              <div class="verticaldivider">
              </div>

              <div id="docshcedule" class="form-group row">
                <label for="doctor" class="col-sm-3 col-form-table">Available Doctor</label>
                <div class="col-sm-2">
                  <select name='selecteddoc' class="form-control" name="">
                    <?php
                    $availabledocsql = "SELECT DOCTOR.FullName, DOCTOR.AvailabilityStart, DOCTOR.AvailabilityEnd
                                          FROM DOCTOR";
                    $availabledocsqlresult = mysqli_query($db, $availabledocsql);

                    while ($doc = mysqli_fetch_assoc($availabledocsqlresult)) {
                      echo '<option>' . $doc['FullName'] . '</option>';
                    }
                    ?>

                  </select>

                </div>
                <div class=" verticaldivider">

                </div>
                <br>
                <div id="schtable" class="form-group row">
                  <table>
                    <tr>
                      <th>Name</th>
                      <th>Available From</th>
                      <th>Available Till</th>
                    </tr>


                    <?php

                    $availabledocsql = "SELECT DOCTOR.FullName, DOCTOR.AvailabilityStart, DOCTOR.AvailabilityEnd
                                          FROM DOCTOR";
                    $availabledocsqlresult = mysqli_query($db, $availabledocsql);

                    while ($doc = mysqli_fetch_assoc($availabledocsqlresult)) {
                      echo '<tr>';
                      echo '<td>' . $doc['FullName'] . '</td>';
                      echo '<td>' . $doc['AvailabilityStart'] . '</td>';
                      echo '<td>' . $doc['AvailabilityEnd'] . '</td>';
                      echo '</tr>';
                    }

                    ?>

                  </table>


                </div>


              </div>
              <button type="submit" name="schedule_Appointment" id="schedule_Appointment_btn" class="btn btn-outline-primary">Schedule</button>



            </form>

          </div>

          <!-- <?php if (isset($_SESSION['Phone'])) : ?>
                        <div class="welecometxt">
                          <h3>Welcome <?php echo $_SESSION['Phone'];  ?>  </h3>
                        </div>
            <?php endif ?> -->





        </div>



      </div>


    </div>

  </section>





</body>

</html>