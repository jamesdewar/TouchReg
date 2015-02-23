
<?php
// This php file was made with the help of: http://www.formget.com/login-form-in-php/

$dbc = mysqli_connect('localhost', 'ma303jd', 'james23','ma303jd_admin');
// Selecting Database
//$db = mysqli_select_db($dbc, 'ma303jd_admin');
session_start();// Starting Session
// Storing Session
if (!isset($_SESSION['email']))
{
header ('Location: index.html');
}
$user=$_SESSION['email'];
// query for the welcome at the top left of the home screen
$query_welcome=mysqli_query($dbc,"SELECT FirstName from teacher where Email='$user'");
$row_welcome = mysqli_fetch_array($query_welcome,MYSQLI_ASSOC);
$login =$row_welcome['FirstName'];

// Query for the course list the teacher is registered on
$query_course_list= mysqli_query($dbc,"SELECT course_list from teacher where Email ='$user'");
$final_list= array();
$row_course_list = mysqli_fetch_array($query_course_list,MYSQLI_ASSOC);
$course_list = $row_course_list['course_list'];
$list_individual_courses = explode(" ",$course_list);

foreach($list_individual_courses as $ray)
{
print_r($ray);
$query_course_name = mysqli_query($dbc,"SELECT Course_Name from Courses where Course_id ='$ray'");
$row_course_name = mysqli_fetch_array($query_course_name,MYSQLI_ASSOC);
$course_name = $row_course_name['Course_Name'];
array_push($final_list,$course_name);
}

if(!isset($login)){
mysql_close($connection); // Closing Connection
header('Location: index.html'); // Redirecting To Home Page
}
?>
