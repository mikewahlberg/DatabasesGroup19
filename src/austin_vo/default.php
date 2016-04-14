<!--
Group 19
COP 4710
4-13-2016
Default.
	Homepage for the GTAMS app.
-->
<?php
session_start();
?>
<!doctype html>

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

	<h1 align="center">Graduate Teaching Assistantship Management System</h1>

	<div id="newSessionInfo">
	<fieldset>

	<h3 align="center">Who are you?</h3>
	<table align='center'>
		<form action='Login_Page.html'>
		<tr><td><button>FACULTY MEMBERS</button></td></tr>
		</form>
		
		<form action='GTA_Application_Prereq_Questions.php'>
		<tr><td><button>STUDENT APPLICANTS</button></td></tr>
		</form>
	</table>
	
	
	</fieldset>
	</div>
</body>