<?php
	$date = getdate(); //Gets current time to make sure no double entries are made
	$query = "SELECT * FROM Attendance WHERE student_id = '$sid'"; //Queries database to get recent attendances from student
	$execute = mysqli_query($dbc,$query); //fetches information from database
	$continue = true; //halts update if it's already been made
	while($row = mysqli_fetch_array($execute)) // loops through recent attendances to check if one has already been made for the class
	{
		$lastcheckin = strtotime($row['timestamp']); //gets time of attendance in correct format
		if (($date["year"]==date("Y",$lastcheckin))&&($date["mon"]==date("m",$lastcheckin))&&($date["mday"]==date("d",$lastcheckin)))
		{ //Checks attendances was from this day
			if ((($date["hours"]==date("H",$lastcheckin))&&($date["minutes"]<=30))||(($date["hours"]==(date("H",$lastcheckin)-1))&&($date["minutes"]>30)))
			{ //Checks if the attendance already happened within half an hour of the current time
				$continue = false; //stops program if it has
			}
		}
	}
	if ($continue) //Only proceeds if table hasn't already been updated
	{
		$time = date("Y-m-d H:i:s"); //Current time in the correct format
		$query = "INSERT INTO Attendance(course_id,student_id,timestamp) VALUES ('$courseID','$sid','$time')"; //Updates attendance table with correct time
		mysqli_query($dbc,$query); //Updates database
	}
?>