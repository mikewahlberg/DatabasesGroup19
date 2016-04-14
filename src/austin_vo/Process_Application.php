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
	<title>Process Application</title>
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
		
		echo nl2br($sql . "</br></br>");
		$result = $conn->query($sql);
		
		// If INSERT failed, then do not stop PHP and MySQL queries.
		if(!$result) {
			echo nl2br("Insert failed for applicant.</br></br>");
			exit();
		}
		
		echo nl2br("Inserted successfully for new applicant.</br></br>");
		
		// Query to insert into gtams.COMPLETED_COURSES.
		for( $i = 1; $i <= $_SESSION['numCompletedCourses']; $i++ ) {
			$sql =
				"INSERT INTO gtams.completed_courses
				VALUES ('".$_GET["GTAPID"]."'
				, '".$_GET["Gradcourse$i"]."'
				, '".$_GET["gradcourseChoice$i"]."');";
			
			echo nl2br($sql . "</br></br>");
			$result = $conn->query($sql);
			
			// If INSERT failed, then do not stop PHP and MySQL queries.
			if(!$result) {
				echo nl2br("Insert failed for applicant's completed courses.</br></br>");
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
			
			echo nl2br($sql . "</br></br>");
			$result = $conn->query($sql);
			
			// If INSERT failed, then do not stop PHP and MySQL queries.
			if(!$result) {
				echo nl2br("Insert failed for applicant's publications.</br></br>");
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
			
			echo nl2br($sql . "</br></br>");
			$result = $conn->query($sql);
			
			// If INSERT failed, then do not stop PHP and MySQL queries.
			if(!$result) {
				echo nl2br("Insert failed for applicant's previous advisers.</br></br>");
				exit();
			}
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
		
		echo nl2br($sql . "</br></br>");
		$result = $conn->query($sql);
		
		// If INSERT failed, then do not stop PHP and MySQL queries.
		if(!$result) {
			echo nl2br("Failed to create application.</br></br>");
			exit();
		}
		
		echo nl2br("Successfully created new application.</br></br>");
		
		mysqli_close($conn);
	?>
</body>
</html>