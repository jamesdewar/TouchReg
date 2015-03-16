
<?php
// This php file was made with the help of: http://www.formget.com/login-form-in-php/
include 'stats.php';
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
$_SESSION["course_list"]= $course_list;
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
$final_list_student_id = array();
foreach($list_individual_student as $temp)
{
	$query_student_name = mysqli_query($dbc,"Select First_Name,Last_Name,Student_ID from Students where Student_id = '$temp'");
	$row_student_name_individual = mysqli_fetch_array($query_student_name,MYSQLI_ASSOC);
	$student_first_name = $row_student_name_individual['First_Name'];
	$student_last_name = $row_student_name_individual['Last_Name'];
	$student_id = $row_student_name_individual['Student_ID'];
	array_push($final_list_first_name,$student_first_name);
	array_push($final_list_last_name,$student_last_name);
	array_push($final_list_student_id,$student_id);
}
echo '<!DOCTYPE html>
<html>
<head>
        <title>Your Home Page</title>
        <link href="css/home.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/graph.js"></script>';

echo "<script src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js\"></script><script src=\"http://code.highcharts.com/highcharts.js\"></script>
<script src=\"http://code.highcharts.com/modules/exporting.js\"></script>";
echo "
</head>
<body id=\"general\">";
echo " <div class =\"headbar\"></div>";
echo " <div class=\"head\"><img src=\"images/user.png\"/> </div>";
echo "<div class= \"title\"> Hello, " .$login . "</div>";
//printing the course list the teacher is registered on
echo "<div class = \"courses\"> Courses </div>";
//echo count($_SESSION["general_attendance"]);
$list_of_course_dates = array();
$list_of_students = array();
for($i=0;$i<count($_SESSION["general_attendance"]); $i++){

	foreach ( $_SESSION["general_attendance"][$i] as $key => $value){
		array_push($list_of_course_dates,$key);
		array_push($list_of_students,$value);
		//echo "$key,$value";
	}
	
}
//print_r($list_of_course_dates);
//$list_of_course_dates_js = json_encode($list_of_course_dates);
//$list_of_students_js = json_encode($list_of_students);
$_SESSION["general_attendance_course"] = $list_of_course_dates;
$_SESSION["general_attendance_number"] = $list_of_students;
echo "<div class = \"course_list\">";
foreach ($final_list as $t){
	echo "<a href=\"\">".$t . "</a><br>";
}
echo "</div>";
echo "<div class = \"students\"> Students </div>";

//Printing the studnet list for that course
echo "<div class = \"student_list\">";
$length = count($final_list_first_name);
for($i = 0; $i<$length; $i++){
	echo "<div id =\"$final_list_student_id[$i]\" class= \"clickable\"  data-id =\"$final_list_student_id[$i]\"> ".$final_list_first_name[$i] . " " . $final_list_last_name[$i] . "<br></div>";
}
echo "</div>";
//Testing individual array
$query = "SELECT DISTINCT course_id from Attendance where student_id=1 ORDER BY course_id ASC";
$result = mysqli_query($dbc,$query);
$list_ind_courses = array();
while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
{       
	$list_ind_courses[] = $row;
}
//echo $list_ind_courses[0]['course_id'];
//print_r($list_ind_courses);
$final_ind_attendance = array();
$script_to_be_sent = "";
for ($i=0;$i<count($list_ind_courses);$i++)
{
	$course_id = $list_ind_courses[$i]['course_id'];
	$query_timestamps = "SELECT timestamp from Attendance where student_id=1  and course_id = '$course_id'";
	$individual_attendance_record = array();
	$all_attendance_timestamp = array();
	$overall_ind_attendance = array();
	$result_timestamp = mysqli_query($dbc,$query_timestamps);
	while ($row =  mysqli_fetch_array($result_timestamp,MYSQLI_ASSOC))
	{
		array_push($all_attendance_timestamp,$row);
	}

	$individual_attendance_record = attendance_check($course_id,$all_attendance_timestamp);
//	print_r($individual_attendance_record);	
	unset($all_attendance_timestamp);
	$overall_ind_attendance = getting_timetable($course_id);
	$offset = 0;	
	$top = $i +1;
	$script_to_be_sent .= '<div id = "personal_stat'.$top.'" style="min-width: 600px; height: 400px; margin: 0 auto"><script>var dates'.$top.' = []; 
        var number'.$top.' = []; 
        number'.$top.' = '.json_encode($individual_attendance_record).'; 
        dates'.$top.' = '.json_encode($overall_ind_attendance).';
        $(function () {
    $(\'#personal_stat'.$top.'\').highcharts({
        title: {
            text: \'Overall Attendance\',
            x: -20 //center
        },
        xAxis: {
            categories: dates'.$top.'
        },
        yAxis: {
            title: {
                text: \'Number of Students (weekly)\'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: \'#808080\'
            }]
        },
        tooltip: {
            valueSuffix: \'Weekly\'
        },
        legend: {
            layout: \'vertical\',
            align: \'right\',
            verticalAlign: \'middle\',
            borderWidth: 0      
        },
        series:[{
        name: \'Course '.$top.'\',
         data: number'.$top.'
        }]
    });
});
</script></div>'; 
	unset($individual_attendance_record);
	unset($overall_ind_attendance);
}
echo $script_to_be_sent;
function getting_timetable($course_num)
{
	$list_lectures = array();
	$dbc = mysqli_connect('localhost', 'ma303jd', 'james23','ma303jd_admin');
	$query_timetable = mysqli_query($dbc,"SELECT time_in from Timetable where course_id= '$course_num'");
	while ($row = mysqli_fetch_array($query_timetable,MYSQLI_ASSOC))
	{
		$list_lectures[] = $row;
	}

	for($l=0;$l<count($list_lectures);$l++)
	{
		$time_in = new DateTime($list_lectures[$l]['time_in']);


		//Creating an array of attendance over the whole time period
		$format_date = $time_in->format('Y-m-d');
		$final_attendance_record[] = $format_date;
	
	}
	return $final_attendance_record;
}
function attendance_check($course_num,$input)
{
	$dbc = mysqli_connect('localhost', 'ma303jd', 'james23','ma303jd_admin');
	$final_attendance_record = array(0,0,0,0,0);
	$list_classes = array();
	$temp_query = "SELECT time_in,time_out from Timetable where course_id= '$course_num'";
	$query_attendance = mysqli_query($dbc,$temp_query);
	while ($row = mysqli_fetch_array($query_attendance,MYSQLI_ASSOC))
	{	

		$list_classes[] = $row; 
	}
	//	print_r($list_classes);
	for($k=0;$k<count($list_classes);$k++)
	{
		$time_in = new DateTime($list_classes[$k]['time_in']);
		$time_out = new DateTime($list_classes[$k]['time_out']);
		foreach($input as $pop)
		{
			$encoded = new Datetime($pop['timestamp']);
			if ($encoded > $time_in && $encoded < $time_out)
			{

				$final_attendance_record[$k] = 	1;
			}
		}
	}
	return $final_attendance_record;
}


//Chacking Session and seeing if the user should be logging in or not. Retunrn to login is not
if(!isset($login)){
	mysql_close($connection); // Closing Connection
	header('Location: index.html'); // Redirecting To Home Page
}
?>
