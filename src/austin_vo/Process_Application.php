<!--
Group 19
COP 4710
4-13-2016
Process_Application.php
	This file takes takes the inputs from GTA_Application_WIP.html
	and INSERTS them accordingly into the MySQL Database.
-->
<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>COP 4710 - Group 19 - Homepage</title>
	<style>
	body 
	{
		background-color: lightblue;
	}

	div {
		border: 8px solid darkblue;
		border-radius: 5px;
		background-color: lightgray;
		padding: 40px;
	}

	input[type=submit]:hover{ background-color: lightGreen;}

	input[type=submit]{
			width: 20%;
			background-color: green;
			color: white;
			padding: 14px 20px;
			margin: 8px 0;
			border: none;
			border-radius: 4px;
			cursor: pointer;
			}
			
	a[type=logout]{
		width: 50%;
		background-color: navy;
		color: white;
		padding: 5px 10px;
		margin: 5px 0;
		border: none;
		border-radius: 4px;
		cursor: pointer;
	}
	</style>
</head>

<body>
	<div id="newSessionInfo">
	<fieldset>
	
	<center>
	
	<form action='default.php'>
		<button>Click this button to go back to the home page</button>
	</form>

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
		
		// Query to insert into gtams.APPLICANT.
		$sql =
		"INSERT INTO gtams.APPLICANT 
		VALUES ( '".$_GET["GTAPID"]."' 
		,'".$_GET["GTAname"]."' 
		,'".$_GET["GTAlname"]."' 
		,'".$_GET["GTAemail"]."' 
		,'".$_GET["GTAphone"]."' 
		,".$_GET["phdChoice"]." 
		,".$_GET["GTAsemestercount"]." 
		,".$_GET["speakChoice"]." 
		,".$_GET["GTAworkingsemestercount"]." 
		,".$_GET["totalGPA"]." );";
		
		//echo nl2br($sql . "</br></br>");
		$result = $conn->query($sql);
		
		// If INSERT failed, then do not stop PHP and MySQL queries.
		if(!$result) {
			echo nl2br("<h1>Insert failed for applicant.</h1></br></br>");
			exit();
		}
		
		//echo nl2br("Inserted successfully for new applicant.</h1></br></br>");
		
		// Query to insert into gtams.COMPLETED_COURSES.
		for( $i = 1; $i <= $_SESSION['numCompletedCourses']; $i++ ) {
			$sql =
				"INSERT INTO gtams.completed_courses
				VALUES ('".$_GET["GTAPID"]."'
				, '".$_GET["Gradcourse$i"]."'
				, '".$_GET["gradcourseChoice$i"]."');";
			
			//echo nl2br($sql . "</br></br>");
			$result = $conn->query($sql);
			
			// If INSERT failed, then do not stop PHP and MySQL queries.
			if(!$result) {
				echo nl2br("<h1>Insert failed for applicant's completed courses.</h1></br></br>");
				exit();
			}
		}
		
		// Query to insert into gtams.PUBLISHED_PUB.
		for( $i = 1; $i <= $_SESSION['numPublications']; $i++ ) {
			$sql =
				"INSERT INTO gtams.published_pub
				VALUES ('".$_GET["GTAPID"]."'
				, '".$_GET["publication$i"]."'
				, '".$_GET["date$i"]."'
				, '".$_GET["citation$i"]."');";
			
			//echo nl2br($sql . "</br></br>");
			$result = $conn->query($sql);
			
			// If INSERT failed, then do not stop PHP and MySQL queries.
			if(!$result) {
				echo nl2br("<h1>Insert failed for applicant's publications.</h1></br></br>");
				exit();
			}
		}
		
		// Query to insert into gtams.PREVIOUS_ADV.
		for( $i = 1; $i <= $_SESSION['numPrevAdvisors']; $i++ ) {
			$sql =
				"INSERT INTO gtams.previous_adv
				VALUES ('".$_GET["GTAPID"]."'
				, '".$_GET["fname$i"]."'
				, '".$_GET["lname$i"]."'
				, ".$_GET["timeSpent$i"].");";
			
			//echo nl2br($sql . "</br></br>");
			$result = $conn->query($sql);
			
			// If INSERT failed, then do not stop PHP and MySQL queries.
			if(!$result) {
				echo nl2br("<h1>Insert failed for applicant's previous advisers.</h1></br></br>");
				exit();
			}
		}
		
		// Query to insert into gtams.CURRENT_ADV.
		$sql =
			"INSERT INTO gtams.CURRENT_ADV
			VALUES ('".$_GET["GTAPID"]."'
			, '".$_GET["c_fname"]."'
			, '".$_GET["c_lname"]."'
			, ".$_GET["c_email"].");";
		
		//echo nl2br($sql . "</br></br>");
		$result = $conn->query($sql);
		
		// If INSERT failed, then do not stop PHP and MySQL queries.
		if(!$result) {
			echo nl2br("<h1>Insert failed for applicant's current adviser.</h1></br></br>");
			exit();
		}
		
		// Query to insert into gtams.APPLICATION.
		$sql =
		"INSERT INTO gtams.application
		VALUES ('".$_SESSION["selectedSession"]."'
		, '".$_GET["GTAPID"]."'
		, 'OPEN'
		, FALSE
		, FALSE
		, NULL
		, NULL
		, NULL
		, '".$_GET["date"]."'
		, TRUE);";
		
		//echo nl2br($sql . "</br></br>");
		$result = $conn->query($sql);
		
		// If INSERT failed, then do not stop PHP and MySQL queries.
		if(!$result) {
			echo nl2br("Failed to create application.</br></br>");
			exit();
		}
		
		echo nl2br("<h1>Successfully created new application.</h1></br></br>");
		
		mysqli_close($conn);
	?>
	
	</center>
	
</fieldset>
</div>
</body>
</html>