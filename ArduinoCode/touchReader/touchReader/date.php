<?php
	include("connect.php");
	$query = "SELECT * FROM Timetable WHERE room_id = '1'";
	$execute = mysqli_query($dbc,$query);
	$date = getdate();
	while($row = mysqli_fetch_array($execute))
	{
		echo "<p>";
		echo $row['time_in']." ";
		echo $row['time_out'];
		echo "------";
		$rel = strtotime($row['time_in']);
		if ($date["year"]==date("Y",$rel))
		{
			if ($date["mon"]==date("m",$rel))
			{
				if ($date["mday"]==date("d",$rel))
				{
					if (($date["hours"]==date("H",$rel))&&($date["minutes"]<30))
					{
						echo "We're in! But a few minutes late";
					}
					else if (($date["hours"]==(date("H",$rel)-1))&&($date["minutes"]>30))
					{
						echo "We're in! But a few minutes early";
					}
				}
			}
		}
		echo "</p>";
	}
	//$string =  $date["year"]."-".$date["mon"]."-".$date["mday"]." ".$date["hours"].":".$date["minutes"].":".$date["seconds"];
	//echo $string;
?>