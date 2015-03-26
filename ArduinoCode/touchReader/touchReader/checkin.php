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
		$query = "SELECT * FROM Timetable WHERE room_id = '$room'";
		$execute = mysqli_query($dbc,$query);
		$date = getdate();
		while($row = mysqli_fetch_array($execute))
		{
			$rel = strtotime($row['time_in']);
			if ($date["year"]==date("Y",$rel))
			{
				if ($date["mon"]==date("m",$rel))
				{
					if ($date["mday"]==date("d",$rel))
					{
						if (($date["hours"]==date("H",$rel))&&($date["minutes"]<=30))
						{
							$courseID = $row["course_ID"];
						}
						else if (($date["hours"]==(date("H",$rel)-1))&&($date["minutes"]>30))
						{
							$courseID = $row["course_ID"];
						}
					}
				}
			}
			$dump = "$dump Room is $room "
		}
	}
	else
	{
		$dump = "$dump student ID not found";
	}
	$outquery = "INSERT INTO output(dump) VALUES ('$dump')";
	mysqli_query($dbc,$outquery);
?>