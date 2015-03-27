<?php
	$date = getdate(); //Current time used for checking purposes
	$query = "SELECT * FROM Timetable WHERE room_id = '$room'"; //Query to get the Schedule for the current room
	$execute = mysqli_query($dbc,$query); //fetches current room's schedule from databse
	while($row = mysqli_fetch_array($execute)) //Cycles through all the time slots
	{
		$time_in = strtotime($row['time_in']); //Converts time schedule of room into a usable format
		if (($date["year"]==date("Y",$time_in))&&($date["mon"]==date("m",$time_in))&&($date["mday"]==date("d",$time_in)))
		{//Above checks for the current day on the schedule (month, day and year)
			if ((($date["hours"]==date("H",$time_in))&&($date["minutes"]<=30))||(($date["hours"]==(date("H",$time_in)-1))&&($date["minutes"]>30)))
			{ //Checks what hour of the schedule, allows 30 minute leeway either side for early or late students
				$courseID = $row['course_id'];//The course currently on in the room
				$try = (string)$courseID; //Converts course ID into a string so the list of courses can be checked
				if (strpos($courses,$try)!==FALSE) //Only registers attendanceif student is enrolled in the course
				{
					include("updateattendance.php"); //calls script to update the attendance table
				}
			}
		}
	}
?>
