<?php
	include("connect.php");
	$cid = $_GET["cid"];
	$room = $_GET["room"];
	$date = getdate();
	$dump = "Received cid = $cid and room = $room.";
	$query = "SELECT * FROM Students WHERE cardID = '$cid'";
	$execute = mysqli_query($dbc,$query);
	$confirm = mysqli_fetch_array($execute);
	if ($confirm)
	{
		$sid = $confirm["Student_ID"];
		$courses = $confirm["Course_ID"];
		$dump = "$dump student id is $sid and courses are $courses.";

	}
	else
	{
		$dump = "$dump student ID not found";
	}
	$outquery = "INSERT INTO output(dump) VALUES ('$dump')";
	mysqli_query($dbc,$outquery);
?>