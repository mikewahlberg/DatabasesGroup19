<!--
Group 19
COP 4710
Admin_Create_Membership
	Create the memberships from Admin_Menu.
-->
<?php
session_start();
$_SESSION["NumMemberships"] = $_GET["NumMemberships"];
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

<h1 align="center">Creating Memberships</h1>
<p align="center">Please choose your parameters for creating your new memberships.</p>

<div id="newSessionInfo">

<fieldset>

<legend> GC Membership </legend>
<br>
	
	<form action='Process_Create_Membership.php' method='GET'>
	
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
		
		//Check for valid input.
		if($_SESSION["NumMemberships"] < 1){
			echo "<tr>NUMBER OF MEMBERSHIPS IS LESS THAN 1<tr>";
			exit();
		}
		
		//Create query to get all sessions and GC members.
		$sql_ses = "SELECT DISTINCT session_id 
			FROM gtams.GTA_SESSION 
			ORDER BY session_id;";
		
		$sql_fac = "SELECT DISTINCT faculty_id 
			FROM gtams.GRADUATE_COMMITTEE 
			ORDER BY faculty_id;";
		
		$result_ses = $conn->query($sql_ses);
		$result_fac = $conn->query($sql_fac);
		
		// Check results of query.
		if (!$result_ses) {
			echo "<h1>FAILED SEARCHING FOR SESSIONS.</h1>";
			exit();
		}
		
		if (!$result_fac) {
			echo "<h1>FAILED SEARCHING FOR FACULTY.</h1>";
			exit();
		}
		
		//Table header
		echo "<table align='center'>";
		echo "<tr><th>Membership</th>
			<th>Session ID</th>
			<th>Faculty ID</th></tr>";
			
		//Dynamically create multiple form fields.
		for($i = 1; $i <= $_SESSION["NumMemberships"]; $i++){
			echo "<tr><td>Membership #$i:</td>";
			echo "<td><select name='MemSession$i'>";
			
			while($row = $result_ses->fetch_assoc()) {
				echo "<option value='".$row["session_id"]."'>".$row["session_id"]."</option>";
			}
			
			echo "</select></td>";
			
			echo "<td><select name='MemFac$i'>";
			
			while($row = $result_fac->fetch_assoc()) {
				echo "<option value='".$row["faculty_id"]."'>".$row["faculty_id"]."</option>";
			}
			
			echo "</select></td></tr>";
			
			//Re-execute queries to populated them again.
			$result_ses = $conn->query($sql_ses);
			$result_fac = $conn->query($sql_fac);
		}
		
		echo "</table>";
		echo "<center><input type='submit' value='Process Memberships'><center>";
		?>
		
	</form>
	
</fieldset>

</div>

<br>
<a href = "file:///C:/Users/Mark/Desktop/html%20files/login%20page%20WIP.html" type="logout" align="center"> Log Out </a>

</body>
</html>