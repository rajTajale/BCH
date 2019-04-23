function displayProfile(){
  var x =   document.getElementById("userProfile");
  var valueChng = document.getElementById("profilebtn");
  if(valueChng.value == "View Profile"){
    valueChng.value = "Close";
  }else{
    valueChng.value = "View Profile"
  }

  if (x.style.display == "block"){
    x.style.display = "none";
  } else{
    x.style.display = "block";
  }


}

function displayAppointment(){
  var y = document.getElementById("scheduleAppointment");
  var valueChng = document.getElementById("schedulebtn");

  if(valueChng.value == "Schedule Appointment"){
    valueChng.value = "Done";
  }else{
    valueChng.value = "Schedule Appointment"
  }

  if (y.style.display == "block"){
    y.style.display = "none";

  } else{
    y.style.display = "block";
  }
}
