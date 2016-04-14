<!--
Group 19
COP 4710
Process_Create_GC
	Inserts the GC members from Admine_Create_GC.php into the MySQL database.
-->
<?php
session_start();
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

<h1 align="center">Processing GC Members</h1>
<p align="center">Determining if your new GC Members are valid.</p>

<div id="newSessionInfo">

<fieldset>

<legend>GC Members</legend>
<br>
	<center>
	
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
	
	for($i = 1; $i <= $_SESSION["NumGC"]; $i++){
		
		// Create and execute MySQL query.
		$sql =
			"INSERT INTO gtams.graduate_committee
			VALUES ('".$_GET["FacID$i"]."'
			,'".$_GET["FacFName$i"]."' 
			,'".$_GET["FacLName$i"]."' 
			,'".$_GET["FacEmail$i"]."'
			, ".$_GET["FacChair$i"].");";
		
		$result = $conn->query($sql);
		
		if(!$result){
			echo "<p>Inserting new GC members failed</p>";
			exit();
		}
	}
	
	echo "<p>Inserted all new GC members successfully.</p>";
	$conn->close();
	?>
	
	<a href = "Admin_Menu.html">
		<button>Go back to Admin Menu</button>
	</a>
	</center>
	
</fieldset>

</div>

<br>
<a href = "file:///C:/Users/Mark/Desktop/html%20files/login%20page%20WIP.html" type="logout" align="center"> Log Out </a>

</body>
</html>