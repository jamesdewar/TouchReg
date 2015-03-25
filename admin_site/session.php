<!--
This is the main file of the admin website. Most/ALL of the logic and DISPLAY is programmed in here
Here is a list of url/websites which were used to help build this website
ALOT of the implementations are my own and I will explain in detail so the reader can follow along
URL: 
- http://openenergymonitor.org/emon/node/107 -- was used but not extensive, only ides
- www.w3schools.com

---->

<?php
// This php file was made with the help of: http://www.formget.com/login-form-in-php/
include 'stats.php';
$dbc = mysqli_connect('localhost', 'ma303jd', 'james23','ma303jd_admin');

$colors_of_charts = array("#808080","#FD7C6E","#1F75FE","#CB4154","#00CC99");
session_start();// Starting Session

// Storing Session -- If the user is not connected, redirct him to the Login page
if (!isset($_SESSION['email']))
{
	header ('Location: index.html');
}
//Creating the session variable. This is necessary to get all the relevant PERSONALISED information on the 
//logged in user
$user=$_SESSION['email'];

// query for the welcome message at the top left of the home screen
$query_welcome=mysqli_query($dbc,"SELECT FirstName from teacher where Email='$user'");
$row_welcome = mysqli_fetch_array($query_welcome,MYSQLI_ASSOC);
$login =$row_welcome['FirstName']; // login variable will hold the first name of the logged in user

// Query for the course list the teacher is registered on
$query_course_list= mysqli_query($dbc,"SELECT course_list from teacher where Email ='$user'");
$final_list= array(); // Store the result in an ASSOCIATIVE array -- This array will hold the list of course NAMES
$row_course_list = mysqli_fetch_array($query_course_list,MYSQLI_ASSOC);
$course_list = $row_course_list['course_list'];
$_SESSION["course_list"]= $course_list;
$list_individual_courses = explode(" ",$course_list); // we use the explode statement to seperate the results within
//a cell of the table. This allows us the seprate the results

//We can now go through the list of individual courses To get the course name 
foreach($list_individual_courses as $ray)
{
	$query_course_name = mysqli_query($dbc,"SELECT Course_Name from Courses where Course_id ='$ray'");
	$row_course_name = mysqli_fetch_array($query_course_name,MYSQLI_ASSOC);
	$course_name = $row_course_name['Course_Name'];
	array_push($final_list,$course_name);
}


// Query for the student list registered on the course
$course_id = array_values($list_individual_courses);
$first_course =  $course_id[0]; // Selecting the first course the teacher is registered on.
$query_student_list = mysqli_query($dbc,"SELECT Student_enlisted from Courses where Course_id = '$first_course'");
$row_student_name = mysqli_fetch_array($query_student_list,MYSQLI_ASSOC);
$student_list = $row_student_name['Student_enlisted'];

$list_individual_student = explode(" ",$student_list); //Exploding the results from the query.
$final_list_first_name = array(); //array of first name of the student on that course
$final_list_last_name = array();//array of Last name of the student on that course
$final_list_student_id = array();//array of student_id of the student on that course

//Query to POPULATE the 3 arrays described above. 
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

// From here we start introducing some of the HTML that will be rendered on the page
// This part will write the Head part: references to scripts/libraries, fonts. and the hello message
echo '<!DOCTYPE html>
<html>
<head>
<title>Your Home Page</title>
<link href="css/home.css" rel="stylesheet" type="text/css">
';

echo '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script><script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<script type="text/javascript" src="js/graph.js"></script>
<script type="text/javascript" src="js/hiding2.js"></script>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
<link rel="stylesheet" type="text/css" href="css/normalize.css" />
<link rel="stylesheet" type="text/css" href="css/demo.css" />
<link rel="stylesheet" type="text/css" href="css/component.css" />
<!--[if IE]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
';

echo "
</head>
<body>";
echo " <div class =\"headbar\"></div>";
echo " <div class=\"head\"><img src=\"images/user.png\"/> </div>";
echo "<div class= \"title\"> Hello, " .$login . "</div>";
//printing the course list the teacher is registered on
echo "<div class = \"courses\"> Courses </div>";

// We start getting into the timetables and start compiling the necessary info to build graphs

$list_of_course_dates = array(); // array to hold list of dates in a specific course
$list_of_students = array(); //Array to hold list of students in a specific course

// The genereal attendance SESSION variable as been defined in the STATS.PHP file
// It is a associative array of lectures dates and number of STUDENTS who showed up
for($i=0;$i<count($_SESSION["general_attendance"]); $i++){
	//Putting into the array the contents of the general attendance variable.
	// Arrays are easier to work with AND are necessary for the JS library we are going through

	foreach ( $_SESSION["general_attendance"][$i] as $key => $value){
		array_push($list_of_course_dates,$key);
		array_push($list_of_students,$value);
	}

}

// NOW we create 2 session variables that will hold the values for the specific course + specific attendance record
$_SESSION["general_attendance_course"] = $list_of_course_dates;
$_SESSION["general_attendance_number"] = $list_of_students;

echo "<div class = \"course_list\">";
$temp_index = 1;
//This html is used to present the list of Students on the right side of the page
foreach ($final_list as $t){
	echo '<div id="list_course'. $temp_index .'">'.$t .' </div><br>';
	$temp_index++;
}
echo "</div>";
echo "<div class = \"students\"> Students </div>";

//Printing the student list for that course
echo "<div class = \"student_list\">";
$length = count($final_list_first_name);
for($i = 0; $i<$length; $i++){
	echo "<div id =\"$final_list_student_id[$i]\"> ".$final_list_first_name[$i] . " " . $final_list_last_name[$i] . "<br></div>";
}
echo "</div>";

echo '
<div id= "tableGraph">
<div id = "stat" style="min-width: 600px; height: 400px;">

<script>
var dates = []; 
var number = []; 
number = '.json_encode($_SESSION['general_attendance_number']).'; 
dates = '.json_encode($_SESSION['general_attendance_course']).';
$(function () {
		$(\'#stat\').highcharts({
chart: {
type: \'column\'
},	
title: {
text: \'Overall Attendance\',
x: -20 //center
},
xAxis: {
categories: dates
},
yAxis: {
min: 0,    
title: {
text: \'Number of Students (weekly)\'
},
},
plotOptions: {
bar: {
dataLabels: {
enabled: true
	    }
     }
	     },
tooltip: {
valueSuffix: \' Weekly\'
	 },
legend: {
layout: \'vertical\',
	align: \'right\',
	verticalAlign: \'middle\',
	borderWidth: 0	
	},
series:[{
name: \'Course 1\',
      data: number
       }]
});
});
</script>
</div>
';

//This Part of the Script is for dealing with individual attendance.
// that is the attendance performance of EACH student in EACH of the classes he is registered on
$attendance_table = array();
$script_to_be_sent = "";
for($z=0; $z<count($final_list_student_id);$z++)
{
	$query = "SELECT DISTINCT course_id from Attendance where student_id='$final_list_student_id[$z]' ORDER BY course_id ASC";
	$result = mysqli_query($dbc,$query);
	$list_ind_courses = array();
	while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
	{       
		$list_ind_courses[] = $row;
	}
	$list_ind_course_name = array();
	for ($r=0;$r<count($list_ind_courses);$r++)
	{ 
		$course_id = $list_ind_courses[$r]['course_id'];
		$query_course_name = "SELECT Course_Name from Courses where Course_id = '$course_id'";
		$result_course_name = mysqli_query($dbc,$query_course_name);
		$row_result = mysqli_fetch_array($result_course_name,MYSQLI_ASSOC);
		$row_course_name = $row_result['Course_Name'];
		array_push($list_ind_course_name,$row_course_name);	
	}
	$final_ind_attendance = array();
	$individual_courses_seperator =  '<div id = "individual_courses'.$final_list_student_id[$z].'">';

	for ($i=0;$i<count($list_ind_courses);$i++)
	{
		if($i == 0)
		{
			$script_to_be_sent .= '<div id = "individual_courses'.$final_list_student_id[$z].'"><h1 class= "student_name_header">'.$final_list_first_name[$z].' '.$final_list_last_name[$z].'</h1>';
		}
		$course_id = $list_ind_courses[$i]['course_id'];
		$query_timestamps = "SELECT timestamp from Attendance where student_id='$final_list_student_id[$z]'  and course_id = '$course_id'";
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
		$individual_color = rand(0,4);
		$script_to_be_sent .= '<div id = "personal_stat'.$final_list_student_id[$z].''.$top.'" style="width: 600px; height: 400px; margin: 0 auto"><script>var dates'.$top.' = []; 
		var number'.$top.' = []; 
		number'.$top.' = '.json_encode($individual_attendance_record).'; 
		dates'.$top.' = '.json_encode($overall_ind_attendance).';
		$(function () {
				$(\'#personal_stat'.$final_list_student_id[$z].''.$top.'\').highcharts({
chart:{
type: \'column\'
},
title: {
text: \''.$list_ind_course_name[$i].'\',
x: -20 //center
},
xAxis: {
categories: dates'.$top.'
},
yAxis: {
title: {
text: \'Number of Students (weekly)\'
},
},
plotOptions: {
bar: {
dataLabels: {
enabled: true
}
}
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
color : \''.$colors_of_charts[$individual_color].'\',
name: \'Course '.$top.'\',
      data: number'.$top.'
       }]
});
});
</script></div>'; 

unset($individual_color);
if ($i == count($list_ind_courses)-1)
{
	$script_to_be_sent .= '</div>';
}
}
$attendance_table[$final_list_student_id[$z]] = $individual_attendance_record;
unset($individual_attendance_record);unset($overall_ind_attendance);

}
//The styling and layout for the table 
echo'
<div class="container">
<div class="component">
<table>
<thead>
<tr>
<th>Student Names</th>
';
foreach($_SESSION["general_attendance_course"] as $dates)
{
echo '<th>'.$dates.'</th>';
}
echo '
</tr>
</thead>
<tbody>';
for($pip=0;$pip<count($final_list_first_name);$pip++)
{
echo '<tr><th>'.$final_list_first_name[$pip].', '.$final_list_last_name[$pip].'</th>';
foreach($attendance_table[$final_list_student_id[$pip]] as $toto)
{
if ($toto == 1)
{
echo '<td style="color:green;">&#x2714 </td>';
}
else 
{
echo '<td style="color:red;">&#x2716</td>';
}
}
echo '</tr>';
}
//<td>52</td>
echo '
</tbody>
</table>
</div>
</div>
</div>';



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
