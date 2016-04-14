<!--
Group 19
COP 4710
4-13-2016
Application.
	Students fill out this application to apply for a GTA position.
-->
<?php
session_start();
$_SESSION['numCompletedCourses'] = $_GET['numCompletedCourses'];
$_SESSION['numPublications'] = $_GET['numPublications'];
$_SESSION['numPrevAdvisors'] = $_GET['numPrevAdvisors'];
$_SESSION['selectedSession'] = $_GET['selectedSession'];
?>
<!doctype html>

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
        width: 100%;
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

<h1 align="center"> Submit a GTA application </h1>

<p>!!!!!!!!!!This page is still under development, and emails will be automatically generated and sent out to a testing email address. This will happen EVERY time the submit button is clicked. If you want to play with the code and run some tests, the email address is "gtamsautomailtester@gmail.com" and the password is "ucfknights"!!!!!!!!!!!</p>

<div id="form">
<form action="Process_Application.php" method='GET' enctype="text/plain">
<fieldset>
<legend> Application Information:</legend>
<br>
First name: <input type="text" name="GTAname"><br>
Last name: <input type="text" name="GTAlname"><br>
Your PID:  <input type="text" name="GTAPID"><br>
Your Email: <input type="text" name="GTAemail"><br>
Your Phone: <input type="text" name="GTAphone"><br>

Are you a Ph.D. student in Computer Science? 
            <select name="phdChoice" id="phdChoise">
                <option value = "TRUE">Yes</option>
                <option value = "FALSE">No</option>
            </select>
            <br>
Semesters as a grad student: <input type="text" name="GTAsemestercount"><br>
Have you passed the SPEAK Test?
            <select name="speakChoice" id="speakChoice">
                <option value="1">Yes</option>
                <option value="2">No</option>
                <option value="3">Graduated from a U.S. institution</option>
                <option value="4">Newly admitted student</option>
            </select>
            <br>
Semesters working as a GTA: <input type="text" name="GTAworkingsemestercount"><br>

<?php
	/*
	For each numCompletedCourses, create a compelted courses form field.
	*/
	if($_SESSION['numCompletedCourses'] > 0) {
		echo "Graduate level courses completed, and grade awarded:<br> ";
		
		for( $i = 1; $i <= $_SESSION['numCompletedCourses']; $i++ ) {
			echo "
			<input type= 'text' name='Gradcourse$i'>
			<select name='gradcourseChoice$i' id='grade$i'>
				<option value=''>-</option>
				<option value='A'>A</option>
				<option value='B'>B</option>
				<option value='C'>C</option>
				<option value='D'>D</option>
				<option value='F'>F</option>
			</select>
			<br>";
		}
	}
?>

Cumulative G.P.A for the above courses: <input type="text" name="totalGPA"><br>

<?php
	/*
	For each numPublications, create a published publication form field.
	*/
	if($_SESSION['numPublications'] > 0) {
		echo "List of publications (With Citations):  <br>";
		
		for( $i = 1; $i <= $_SESSION['numPublications']; $i++ ) {
			echo "Publication: <input type= 'text' name='publication$i'>; Citation: <input type= 'text' name='citation$i'>; Date: <input type='text' name='date$i'><br>";
		}
	}
?>

Name of current Ph.D. advisor: <br> 
          First Name:<input type="text" name="c_fname">; Last Name: <input type="text" name="c_lname">; Email Address: <input type="text" name="c_email"><br>

<?php
	/*
	For each numPrevAdvisors, create a published publication form field.
	*/
	if($_SESSION['numPrevAdvisors'] > 0) {
		echo "Names and Time Periods With Previous Ph.D. Advisor(s): <br>";
		
		for( $i = 1; $i <= $_SESSION['numPrevAdvisors']; $i++ ) {
			echo "First Name: <input type='text' name='fname$i'>; Last Name <input type='text' name='lname$i'>; Time With advisor: <input type= 'text' name='timeSpent$i'><br>";
		}
	}
?>

Current Time (This will automatically update upon submission): <input id="date" name="date" step="1"><br>

Be sure to remind your academic advisor to submit the support letter before your deadline. <br>
<input type="submit" value="Submit" onclick="document.getElementById('date').value = Date()">
</fieldset>
</form></div>

<br>
<a href = "file:///C:/Users/Mark/Desktop/html%20files/login%20page%20WIP.html" type="logout" align="center"> Log Out </a>

</body>