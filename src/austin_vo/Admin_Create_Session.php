<!--
Group 19
COP 4710
Admin_Create_Session
	Menu for administators to administrate the GTAMS database.
-->
<?php
session_start();
$_SESSION["NumSessions"] = $_GET["NumSessions"];
?>
<!doctype html>

<html>

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


<body>

<h1 align="center">Creating GTA Sessions</h1>
<p align="center">Please choose your parameters for creating your new GTA sessions.</p>

<div id="newSessionInfo">

<fieldset>

<legend> GTA Sessions </legend>
<br>
	
	<form action='Process_Create_Session.php' method='GET'>
	
		<?php
		//Check for valid input.
		if($_SESSION["NumSessions"] < 1){
			echo "<tr>NUMBER OF SESSIONS IS LESS THAN 1<tr>";
			exit();
		}
		
		echo "<table align='center'>";
		echo "<tr><th>Number of Sessions</th>
			<th>Session ID</th>
			<th>Aplication Deadline </br>
			(YYYY-MM-DD)</th>
			<th>Referral Letter Deadline </br>
			(YYYY-MM-DD)</th></tr>";
			
		//Dynamically create multiple form fields.
		for($i = 1; $i <= $_SESSION["NumSessions"]; $i++){
			echo
			"<tr>
				<td>Session #$i:</td>
				<td><input type='text' name='newSession$i'></td>
				<td><input type='text' name='appDeadline$i'></td>
				<td><input type='text' name='letterDeadline$i'></td>
			</tr>";
		}
		
		echo "</table>";
		echo "<center><input type='submit' value='Create Sessions'><center>";
		?>
		
	
	</form>
	
</fieldset>

</div>

<br>
<a href = "file:///C:/Users/Mark/Desktop/html%20files/login%20page%20WIP.html" type="logout" align="center"> Log Out </a>

</body>
</html>