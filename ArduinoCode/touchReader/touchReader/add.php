<?php
	include("connect.php");
	$cid = $_GET["cid"];
	$room = $_GET["room"];
	$query = "INSERT INTO Students(cardID) VALUES ('$cid')";
	mysqli_query($dbc,$query);
?>