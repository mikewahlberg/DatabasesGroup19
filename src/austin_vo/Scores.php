<!--
Group 19
COP 4710
4-14-2016
Scores
	Scores for each session for each student applicant for each GC member evaluating that student.
-->
<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>COP 4710 - Group 19 - Scores</title>
</head>
<body>
	<h1 align="center">Show all scores for all sessions, students, and GC members.</h1>
	
	<form action='Process_Scores.php' method='GET'>
	<table align='center'>
	
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
	$sql = "SELECT
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
	
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		//Use this to name dynamically created forms.
		$i = 1;
		
		//Create table header.
		echo "<tr><th>Session</th>
			<th>Student</th>
			<th>Evaluator</th>
			<th>Student's Score</th>
			<th>Evaluator's Comments</th>
			</tr>";
			
		//Create scoring form fields for each row.
		while($row = $result->fetch_assoc()) {
			echo "<tr><td>".$row["session_id"]."</td>
				<td>".$row["PID"]."</td>
				<td>".$row["faculty_id"]."</td>
				<td><input type='text' name='score$i'></td>
				<td><input type='text' name='comments$i'></td>
				</tr>";
			$i++;
		}
	}
	else {
		echo "<tr>No session has students and/or GC members available to evaluate applicants.</tr>";
	}
	
	?>
	<tr><td><input type='submit'></td></tr>
	</table>
	</form>

</body>
</html>