<?php
$db =  mysqli_connect('localhost', 'ma303jd', 'james23','ma303jd_admin');
session_start();
//Get students in the course
$name = $_SESSION["course_list"];
$list_attendees= array();
$list_classes = array();
$query_attendees = mysqli_query($db,"SELECT timestamp from Attendance where course_id = '$name'");

while ($row = mysqli_fetch_array($query_attendees,MYSQLI_ASSOC))
{
$list_attendees[] = $row;
}

$query_timestamps = mysqli_query($db,"SELECT time_in,time_out from Timetable where course_id= '$name'");
while ($row = mysqli_fetch_array($query_timestamps,MYSQLI_ASSOC))
{
$list_classes[] = $row;
}
//print_r($list_classes);
$final_attendance_list = array();
//Getting the amount of students per week
foreach($list_classes as $temp)
{
$time_in = new DateTime($temp['time_in']);
$time_out = new DateTime($temp['time_out']);
$num = 0;
foreach($list_attendees as $pet)
{
//echo gettype($pet['timestamp']);
$encoded = new DateTime($pet['timestamp']);
if ($encoded > $time_in && $encoded < $time_out)
{
$num++;
}
}
//Creating an array of attendance over the whole time period
$format_date = $time_in->format('Y-m-d');
$final_attendance_list[] = array($format_date => $num); 
}
print_r($final_attendance_list);
?>
