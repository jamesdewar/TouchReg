<?php
	include("connect.php"); //Connects PHP script to the database
	$cid = $_GET["cid"]; //Gets card ID from the arduino 
	$room = $_GET["room"]; //Gets room number from the arduino
	include("checkstudent.php"); //Checks student card is registered to the database
	if ($checkenrol) //If student is enrolled the program proceeds to check the student is in the correct time and place
	{
		include("getcourse.php"); //Checks the room against the course and updates the attendance tables
	}
?>