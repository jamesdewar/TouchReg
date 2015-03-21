<?php
	//echo "<p>Hello world";
	//include("connect.php");
	$dbc = mysqli_connect("localhost","ma301wm","wikfe517","ma301wm_test");
	//echo mysqli_error($dbc);
	//$room = $_POST["room"];
	$sid = "ma301wm";
	$name = "will";
	$id = $_POST["studentID"];
	$query = "INSERT INTO Students(studentID,cardID) VALUES ('$sid','$id')";
	//echo "$query</p>";
	mysqli_query($dbc,$query);
?>