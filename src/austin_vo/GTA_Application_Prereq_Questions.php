<!--
Group 19
COP 4710
4-13-2016
Prereq Questions.
	A student answers some questions before they fill out the actual application.
	This helps us dynamically create form fields to account for all students.
-->
<?php
session_start();
?>
<!doctype html>

<head>
	<title>COP 4710 - Group 19 - Prereq Questions</title>
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

<h1 align="center">Please answer these questions before submitting a GTA application. </h1>

<div id="newSessionInfo">
<fieldset>

<form action='GTA_Application.php' method='GET'>
<table align='center'>
	<tr><td>What GTA Session are you applying for?</td>
		<td>
			<select name='selectedSession'>
			
			<?php
			// Dynamically create a list of all available GTA Sessions for a student to apply to.
			// This will be used to INSERT into gtams.APPLICATION.
			
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
			
			// Query to get all available sessions
			$sql = "SELECT session_id FROM gtams.gta_session WHERE app_deadline >= CURDATE() ORDER BY app_deadline;";
				
			$result = $conn->query($sql);
			
			//Check if there are any available upcoming GTA Sessions.
			if ($result->num_rows > 0) {
				//List each available GTA session.
				while($row = $result->fetch_assoc()) {
					echo "<option value='".$row["session_id"]."'>".$row["session_id"]."</option>";
				}
			}
			else{
				echo "<option value=''>NO UPCOMING GTA SESSIONS AVAILABLE</option>";
			}
			?>
			</select>
		</td></tr>
		
	<tr><td>How many graduate courses have you completed?</td>
		<td><input type='text' name='numCompletedCourses'></td></tr>
	<tr><td>How many publications have you published?</td>
		<td><input type='text' name='numPublications'></td></tr>
	<tr><td>How many previous academic advisors have you had?</td>
		<td><input type='text' name='numPrevAdvisors'></td></tr>
	<tr><td><input type='submit'></td></tr>
</table>
</form>
</fieldset>
</div>
</body>