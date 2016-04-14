<?
  $id = $_COOKIE[];
  $link = mysql_connect("my host", "my user", "my password", "my db");
  if (!$link){
    die('could not connect:' . mysql_error());
  }
  $count = mysql_query( SELECT COUNT(*) FROM GTA_SESSION WHERE faculty_id = $id);
  for($num = 0; $num<$count; ++$num)
  {
    $session = mysql_query( SELECT session_id FROM GTA_SESSION WHERE faculty_id
    echo 
  }
