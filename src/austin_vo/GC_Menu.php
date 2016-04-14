<!--
Group 19
COP 4710
GC_Menu
	Menu for administators to administrate the GTAMS database.
-->
<?php
session_start();
?>
<!doctype html>
<html>
<head>
	<title>COP 4710 - Group 19 - Graduate Commmittee Menu</title>
	
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

<h1 align="center"> Welcome Graduate Committee Member!</h1>
<p align="center"> To choose an option, entire a value and click a button for the corresponding choice. </p>

<div id="newSessionInfo">

<fieldset>

<legend> What do you want to do? </legend>
<br>

	<table align='center'>
	
		<!--Form selects creates GTA Sessions.-->
		<form action="Scores.php" method="GET">
		<tr>
			<td>Select a GTA Session:</td>
			<td>
				<select name="GCSession">
				
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
				
				// Create and execute MySQL query.
				$sql = "SELECT session_id FROM gtams.gta_session ORDER BY session_id;";
				
				$result = $conn->query($sql);
				
				//Check if results exist.
				if(!$result){
					echo "<option value=''>NO SESSIONS AVAILABLE</option>";
					exit();
				}
				
				//Dynamically fill dropdown with all sessions.
				while($row = $result->fetch_assoc()) {
					echo "<option value='" . $row["session_id"] . "'>" . $row["session_id"] . "</option>";
				}
				?>
					
				</select>
			</td>
			<td><input type="submit" value="Select Session"></td>
		</tr>
		</form>
		
	</table>
	
</fieldset>
</div>

<br>
<a href = "file:///C:/Users/Mark/Desktop/html%20files/login%20page%20WIP.html" type="logout" align="center"> Log Out </a>

</body>
</html>