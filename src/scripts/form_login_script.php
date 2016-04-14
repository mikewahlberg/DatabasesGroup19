<?
  $uid = $_GET['userID'];
  $pwd = $_GET['userpassword'];
  //connect to db
  $link = mysql_connect("my host", "my user", "my password", "my db");
  if (!$link){
    die('could not connect:' . mysql_error());
  }
  $id = mysql_query( SELECT faculty_id FROM LOGIN WHERE faculty_id = $uid AND login_password = $pwd );
  if(!$id){
    echo 'incorrect username or password';
    }
  else
  {
    
  }
  ?>
