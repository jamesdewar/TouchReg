<?php
include('session.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Your Home Page</title>
	<link href="css/home.css" rel="stylesheet" type="text/css">
 <link href='http://fonts.googleapis.com/css?family=Open+Sans:600italic,400,300,600,700' rel='stylesheet' type='text/cs
s'>
<script type="text/javascript" src="jquery-1.11.2.min.js"></script>
<script>
$(document).ready(function(){
$("a").click(function(){
var href = $("a").text();
$("a").append(href);
});
</script>
</head>

<body id= "general">
<div id = "stat">
<img src = "images/stat.png"/>
</div>
	<div id="log_out">
	<a href="logout.php">Log out</a>
</body>
</html>
