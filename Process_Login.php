<!--
Group 19
COP 4710
4-14-2016
Process Login.
-->
<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Process Login</title>
</head>
<body>

<?php
	// Connecting to MySQL using mysqli
	//echo nl2br("Connecting to MySQL Server Desktop Instance using mysqli...\n");

	$servername = "127.0.0.1:3306";
	$username = "root";
	$password = "";

	// Create connection
	$conn = new mysqli($servername, $username, $password);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	//echo nl2br("Connected successfully using mysqli\n\n");
	
	// Query to check of the login info was correct.
	$sql =
	"SELECT faculty_id
	FROM gtams.login
	WHERE faculty_id = '".$_GET["userID"]."'
	AND login_password = '".$_GET["userPassword"]."';";
	
	echo nl2br($sql . "</br></br>");
	$result = $conn->query($sql);
	
	// Check if login is valid.
	// A faculty_id must have a unique login.
	if($result->num_rows <> 1) {
		echo nl2br("LOGIN FAILED</br></br>");
		exit();
	}
	
	echo nl2br("LOGIN SUCCESSFUL</br></br>");
	
	// Create the cookie for the login.
	$cookie_name = $_GET["userID"];
	$cookie_value = $_GET["userPassword"];
	setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
	
	//Differentiate whether the login is a GC member or admin.
	//This query tests if the user is an admin.
	$sql =
	"SELECT faculty_id
	FROM gtams.administrators
	WHERE faculty_id = '".$_GET["userID"]."';";
	
	echo nl2br($sql . "</br></br>");
	$result = $conn->query($sql);
	
	if ($result->num_rows == 1) {
		echo nl2br("You are an ADMINISTRATOR</br></br>");
	}
	else{
		//This query tests if the user is a GC member.
		$sql =
		"SELECT faculty_id
		FROM gtams.graduate_committee
		WHERE faculty_id = '".$_GET["userID"]."';";
		
		echo nl2br($sql . "</br></br>");
		$result = $conn->query($sql);
		
		if ($result->num_rows == 1) {
			echo nl2br("You are a GC MEMBER</br></br>");
		}
		else{
			echo nl2br("You are not an ADMIN or GC MEMBER</br></br>");
			exit();
		}
	}
?>

</body>