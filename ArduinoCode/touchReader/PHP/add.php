<?php
	include("connect.php");
	$link = connection();
	$sql = "INSERT INTO Table_name(room,studentid) VALUES ('".$_GET["room"]."', '".$_GET["studentid"]."')";
	mysql_query($sql,$link);
?>