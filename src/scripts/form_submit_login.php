<?
  $coursenum = coursecount;
  //Connect to SQL DB
  $link = mysql_connect("my host", "my user", "my password", "my db");
  if (!$link){
    die('could not connect:' . mysql_error());
  }
  //Send data to DB
  mysqli_query($link, "INSERT INTO APPLICANT(PID, stu_first_name, stu_last_name, stu_email, stu_phone, PHD_CS, semesters_grad, 
  SPEAK, semesters_GTA, GPA) VALUES (GTAPID, GTAname, GTAlname, GTAemail, GTAphone, phdChoice, GTAsemestercount, speakChoice,
  GTAworkingsemestercount, totalGPA)");
  
  mysql_query($link, "INSERT INTO PUBLISHED_PUB (PID, pub_title, pub_date, citations) VALUES(GTAPID, publication1, date1, citation1)");
  mysql_query($link, "INSERT INTO PUBLISHED_PUB (PID, pub_title, pub_date, citations) VALUES(GTAPID, publication2, date2, citation2)");
  mysql_query($link, "INSERT INTO PUBLISHED_PUB (PID, pub_title, pub_date, citations) VALUES(GTAPID, publication3, date3, citation3)");
  mysql_query($link, "INSERT INTO PUBLISHED_PUB (PID, pub_title, pub_date, citations) VALUES(GTAPID, publication4, date4, citation4)");
  mysql_query($link, "INSERT INTO PUBLISHED_PUB (PID, pub_title, pub_date, citations) VALUES(GTAPID, publication5, date5, citation5)");
  
  mysql_query($link, "INSERT INTO CURRENT_ADV (PID, adv_first_name, adv_last_name, adv_email) VALUES(GTAPID, c_fname, c_lname, advmail)");
  mysql_query($link, "INSERT INTO PREVIOUS_ADV(PID, adv_first_name, adv_last_name, time_spent) VALUES(GTAPID, fname1, lname1, timespent1) ");
  mysql_query($link, "INSERT INTO PREVIOUS_ADV(PID, adv_first_name, adv_last_name, time_spent) VALUES(GTAPID, fname2, lname2, timespent2) ");
  mysql_query($link, "INSERT INTO PREVIOUS_ADV(PID, adv_first_name, adv_last_name, time_spent) VALUES(GTAPID, fname3, lname3, timespent3) ");
  for ( $num = 0; $num<$coursenum; ++$num){
    mysql_query($link, "INSERT INTO COMPLETED_COURSES (PID, course_id, grade) VALUES (Gradcourse . $num, grade . $num )");
  }
  
?>
