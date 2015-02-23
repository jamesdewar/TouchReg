<?php
include('session.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Your Home Page</title>
	<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div id="profile">
		<b id="welcome">Welcome : <i><?php echo $login; ?></i></b>	
	</div>
	<div id="log_out">
	<a href="logout.php">Log out</a>

        <div id= "course_list">
        List of courses: <?php print_r($final_list);?>
</div>
</body>
</html>
