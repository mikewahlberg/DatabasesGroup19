<?
  //Connect to SQL DB
  $link = mysql_connect("my host", "my user", "my password", "my db");
  if (!$link){
    die('could not connect:' . mysql_error());
  }
  //Send data to DB
  mysqli_query($link, "INSERT INTO APPLICANT(PID, stu_first_name, stu_last_name, stu_email, stu_phone, PHD_CS, semesters_grad, 
  SPEAK, semesters_GTA, GPA) VALUES (GTAPID, GTAname, GTAlname, GTAemail, GTAphone, phdChoice, GTAsemestercount, speakChoice,
  GTAworkingsemestercount, totalGPA)");
?>
