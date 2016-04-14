<!--
Group 19
COP 4710
4-14-2016
Process_Scores
	Processes and inserts the scores from Scores.php.
-->
<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>COP 4710 - Group 19 - Process Scores</title>
</head>
<body>
	<?php
	// Connecting to MySQL using mysqli
	$servername = "127.0.0.1:3306";
	$username = "root";
	$password = "";

	// Create connection
	$conn = new mysqli($servername, $username, $password);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
		
	// Find all sessions with all student applications with all GC members evaluating that session.
	$sql_get = "SELECT
			S.session_id
			,A.PID
			,M.faculty_id
		FROM
			gtams.gta_session AS S
			INNER JOIN
			gtams.application AS A ON
				S.session_id = A.session_id
			INNER JOIN
			gtams.member AS M ON
				S.session_id = m.session_id
				AND A.session_id = m.session_id
		ORDER BY
			S.session_id
			,A.PID
			,M.faculty_id;";
	
	$results_get = $conn->query($sql_get);
	
	if(!$results_get) {
		echo nl2br("Failed to get all sessions, students, and GC members.</br></br>");
		exit();
	}
	
	// Check results of $sql_get.
	if ($results_get->num_rows > 0) {
		//Use this to get the dynamically created forms.
		$i = 1;
			
		//Insert scores.
		while($row = $results_get->fetch_assoc()) {
			$sql_insert =
				"INSERT INTO gtams.scores
				VALUES ('".$row["session_id"]."'
				, '".$row["PID"]."'
				, '".$row["faculty_id"]."'
				, ".$_GET["score$i"]."
				, '".$_GET["comments$i"]."');";
			
			$results_insert = $conn->query($sql_insert);
			echo $sql_insert."</br></br>";
			
			if(!$results_insert) {
				echo nl2br("Failed to insert scores.</br></br>");
				exit();
			}
			
			$i++;
		}
	}
	else {
		echo "No session has students and/or GC members available to evaluate applicants.</br></br>";
	}
	
	echo "Successfully inserted all scores.</br></br>";
	
	?>
</body>
</html>