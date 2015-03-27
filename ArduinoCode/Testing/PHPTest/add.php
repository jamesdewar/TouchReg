<?php //Tests Arduino - Databse connection
	//also used to upload the card numbers to the database
	include("connect.php"); //connects to database
	$cid = $_GET["cid"]; //recieves card number from arduino
	$room = $_GET["room"]; //receives room number from arduino
	$query = "INSERT INTO Students(cardID) VALUES ('$cid')"; //inserts information into db with SQL query
	mysqli_query($dbc,$query); //executes query to update the datbase
?>