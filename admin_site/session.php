
<?php

$dbc = mysqli_connect('localhost', 'ma303jd', 'james23','ma303jd_admin');
// Selecting Database
//$db = mysqli_select_db($dbc, 'ma303jd_admin');
session_start();// Starting Session
// Storing Session
$user=$_SESSION['email'];
// SQL Query To Fetch Complete Information Of User
$query=mysqli_query($dbc,"SELECT FirstName from teacher where Email='$user'");
$row = mysqli_fetch_array($query,MYSQLI_ASSOC);

$login =$row['FirstName'];
if(!isset($login)){
mysql_close($connection); // Closing Connection
header('Location: index.html'); // Redirecting To Home Page
}
?>
