<!--
Group 19
COP 4710
Admin_Create_GC
	Menu for administators to administrate the GTAMS database.
-->
<?php
session_start();
$_SESSION["NumGC"] = $_GET["NumGC"];
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

<h1 align="center">Creating GC Members</h1>
<p align="center">Please choose your parameters for creating your new GC members.</p>

<div id="newSessionInfo">

<fieldset>

<legend> GC Members </legend>
<br>
	
	<form action='Process_Create_GC.php' method='GET'>
	
		<?php
		//Check for valid input.
		if($_SESSION["NumGC"] < 1){
			echo "<tr>NUMBER OF GC MEMBERS IS LESS THAN 1<tr>";
			exit();
		}
		
		echo "<table align='center'>";
		echo "<tr><th>GC Members</th>
			<th>Faculty ID</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Is Chairman?</th></tr>";
			
		//Dynamically create multiple form fields.
		for($i = 1; $i <= $_SESSION["NumGC"]; $i++){
			echo
			"<tr>
				<td>GC Member #$i:</td>
				<td><input type='text' name='FacID$i'></td>
				<td><input type='text' name='FacFName$i'></td>
				<td><input type='text' name='FacLName$i'></td>
				<td><input type='text' name='FacEmail$i'></td>
				<td>
					<select name='FacChair$i'>
						<option value='FALSE'>NO</option>
						<option value='TRUE'>YES</option>
					</select>
				</td>
			</tr>";
		}
		
		echo "</table>";
		echo "<center><input type='submit' value='Process GC Members'><center>";
		?>
		
	</form>
	
</fieldset>

</div>

<br>
<a href = "file:///C:/Users/Mark/Desktop/html%20files/login%20page%20WIP.html" type="logout" align="center"> Log Out </a>

</body>
</html>