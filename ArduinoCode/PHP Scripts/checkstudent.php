<?php
	$query = "SELECT * FROM Students WHERE cardID = '$cid'"; //Queries database for list of students with the card number from the arduino
	$execute = mysqli_query($dbc,$query); //gets list from database (should be only one entry)
	$confirm = mysqli_fetch_array($execute); //Gets the data from the returned list
	if ($confirm)//If the user is listed then their student details can be fetched
	{
		$sid = $confirm["Student_ID"]; //Student ID (currently just an int but easily changeable for a more usual student ID)
		$courses = $confirm["Course_ID"]; //Courses returned as a single string with the course IDs in it. Convenient for demonstration but an expanded form would be used in a professionals system
		$checkenrol = true; //Confirms that the main php script can continue
	}
?>