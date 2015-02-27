
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
$query_course_name = mysqli_query($dbc,"SELECT Course_Name from Courses where Course_id ='$ray'");
$row_course_name = mysqli_fetch_array($query_course_name,MYSQLI_ASSOC);
$course_name = $row_course_name['Course_Name'];
array_push($final_list,$course_name);
}
// Query for the student list registered on the course
$course_id = array_values($list_individual_courses);
$first_course =  $course_id[0];
$query_student_list = mysqli_query($dbc,"SELECT Student_enlisted from Courses where Course_id = '$first_course'");
$row_student_name = mysqli_fetch_array($query_student_list,MYSQLI_ASSOC);
$student_list = $row_student_name['Student_enlisted'];

$list_individual_student = explode(" ",$student_list);
$final_list_first_name = array();
$final_list_last_name = array();
foreach($list_individual_student as $temp)
{
$query_student_name = mysqli_query($dbc,"Select First_Name,Last_Name from Students where Student_id = '$temp'");
$row_student_name_individual = mysqli_fetch_array($query_student_name,MYSQLI_ASSOC);
$student_first_name = $row_student_name_individual['First_Name'];
$student_last_name = $row_student_name_individual['Last_Name'];
array_push($final_list_first_name,$student_first_name);
array_push($final_list_last_name,$student_last_name);
}
echo " <div class =\"headbar\"></div>";
echo " <div class=\"head\"><img src=\"images/user.png\"/> </div>";
echo "<div class= \"title\"> Hello, " .$login . "</div>";
//printing the course list the teacher is registered on
echo "<div class = \"courses\"> Courses </div>";

echo "<div class = \"course_list\">";
foreach ($final_list as $t){
echo "- ".$t . "<br>";
}
echo "</div>";
echo "<div class = \"students\"> Students </div>";

//Printing the studnet list for that course
echo "<div class = \"student_list\">";
$length = count($final_list_first_name);
for($i = 0; $i<$length; $i++){
echo "- ".$final_list_first_name[$i] . " " . $final_list_last_name[$i] . "<br>";
}
echo "</div>";

if(!isset($login)){
mysql_close($connection); // Closing Connection
header('Location: index.html'); // Redirecting To Home Page
}
?>
