<!--
This is the main file of the admin website. Most/ALL of the logic and DISPLAY is programmed in here
Here is a list of url/websites which were used to help build this website
ALOT of the implementations are my own and I will explain in detail so the reader can follow along
URL: 
- php Manual was also extensievly used
- http://openenergymonitor.org/emon/node/107 -- was used but not extensive, only ides
- www.w3schools.com

---->

<?php
// This php file was made with the help of: http://www.formget.com/login-form-in-php/

include 'stats.php'; // this script is used to create the Course statistics

//Connecting to the databse
$dbc = mysqli_connect('localhost', 'ma303jd', 'james23','ma303jd_admin');

//this array of Hex values is used to vary the colors of the bar charts

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

//Query to POPULATE the 3 arrays defined above. 
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
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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

// The genereal attendance SESSION variable has been defined in the STATS.PHP file
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
//Adding total attendance over semester to calculate overall attendance percentage
$total_class_att_semester = 0;
foreach($_SESSION["general_attendance_number"] as $number)
{
$total_class_att_semester = $total_class_att_semester + $number; 
}

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
$total_expected_add_semester = ($length -1)*10;
 for($i = 0; $i<$length; $i++){
	echo "<div id =\"$final_list_student_id[$i]\"> ".$final_list_first_name[$i] . " " . $final_list_last_name[$i] . "<br></div>";
}
echo "</div>";
//Building the percentage number of the course. We round the number to make it better.
$percentage_att_semester = round(($total_class_att_semester / $total_expected_add_semester)*100);

//This is the js for the overall attendance graph
//We use the Session varaibles to poupulate. I read about the json_encode method here: http://php.net/manual/en/function.json-encode.php
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
thickInterval: 1,
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
<div id = "percentage">
<h2>Average Attendance: <b>'.$percentage_att_semester.'%</b></h2>
</div>
';

//This Part of the Script is for dealing with individual attendance.
// that is the attendance performance of EACH student in EACH of the classes he is registered on
$attendance_table = array();
$script_to_be_sent = ""; // the string that will be interpreted by the browser.

//This first LOOP is meant the go through the every student registered on that course
for($z=0; $z<count($final_list_student_id);$z++)
{
	//query to slecto the courses  the student is registered on
	$query = "SELECT DISTINCT course_id from Attendance where student_id='$final_list_student_id[$z]' ORDER BY course_id ASC";
	$result = mysqli_query($dbc,$query);
	$list_ind_courses = array();
	//Populate array of course the studen is registered on
	while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
	{       
		$list_ind_courses[] = $row;
	}
	$list_ind_course_name = array();

	//loop to get the NAME of the courses he is attending. The two method (one above, one below) could not be merged into one
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
	//$individual_courses_seperator =  '<div id = "individual_courses'.$final_list_student_id[$z].'">';

	//Now that we know what courses the student attends we can get the stats for EACH one, this is the use of this loop
	for ($i=0;$i<count($list_ind_courses);$i++)
	{
		// We start populating the string/script that will be sent to the browser and will build the graphs
		if($i == 0)
		{
			$script_to_be_sent .= '<div id = "individual_courses'.$final_list_student_id[$z].'"><h1 class= "student_name_header">'.$final_list_first_name[$z].' '.$final_list_last_name[$z].'</h1>';
		}
		//query to select the timestampt for that student in a specific course
		$course_id = $list_ind_courses[$i]['course_id'];
		$query_timestamps = "SELECT timestamp from Attendance where student_id='$final_list_student_id[$z]'  and course_id = '$course_id' ORDER BY timestamp ASC";
		$individual_attendance_record = array();
		$all_attendance_timestamp = array();
		$overall_ind_attendance = array();
		$result_timestamp = mysqli_query($dbc,$query_timestamps);

		// populating array of results from that query. THIS ARRAY HOLDS TIMESTAMP OF THE STUDENT IN A SPECIFIC COURSE
		while ($row =  mysqli_fetch_array($result_timestamp,MYSQLI_ASSOC))
		{
			array_push($all_attendance_timestamp,$row);
		}
		//we can now call the attendance_check method which is defined below. Learn more about it where is it defined
		$individual_attendance_record = attendance_check($course_id,$all_attendance_timestamp);

		//We can empty the array to use in the next iteration of the loop.	
		unset($all_attendance_timestamp);
		// We now make a call to the getting_timetable method below .  Learn more about it where is it defined
		$overall_ind_attendance = getting_timetable($course_id);
		$offset = 0;	
		$top = rand(0,100); // Used to create unique id in the css
		$individual_color = rand(0,4); //random int. used for the colors of the graphs

		// We now can build the graph as we hold the information in the form of 2 arrays.
		//The string is appended each loop, so new scripts are added everytime the loop goes around.
		// the string that is built in the end will hold ALL the info for ALL the graphs of ALL the students
		//These graphs we built using High charts library. Please find more info here: http://www.highcharts.com/
		// Other links that helped me build these graphs. 
		// - http://jsfiddle.net/gh/get/jquery/1.9.1/highslide-software/highcharts.com/tree/master/samples/highcharts/demo/line-basic/
		$individual_att_rec_for_table = array();
		$individual_att_rec_for_table = $individual_attendance_record;
	
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
min:0,
max:2,
tickInterval:1,
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
legend: {
layout: \'vertical\',
	align: \'right\',
	verticalAlign: \'middle\',
	borderWidth: 0      
	},
series:[{
color : \''.$colors_of_charts[$individual_color].'\',
	name: \''.$list_ind_course_name[$i].'\',
	data: number'.$top.'
       }]
});
});
</script></div>'; 

unset($individual_color); //unset color so the grpahs have different colors
if ($i == count($list_ind_courses)-1)
{
	$script_to_be_sent .= '</div>';
}
if ($i == 0)
{
	$attendance_table[$final_list_student_id[$z]] = $individual_attendance_record; // Array for the table below

}
}

unset($individual_attendance_record);
		unset($overall_ind_attendance);
		unset($all_attendance_timestamp);
		}
		//The styling and layout for the table 
		//print_r($attendance_table);
		echo'
		<div class="container">
		<div class="sticky-wrap">
		<table class = "sticky-enabled">
		<thead>
		<tr>
		<th>Student Names</th>';

		//Looping through the dates array for the course the table is for
		foreach($_SESSION["general_attendance_course"] as $dates)
		{
		echo '<th>'.$dates.'</th>';
		}
echo '
</tr>
</thead>
<tbody>';

// this loop goes through every student registered on the course so we can get his info
for($pip=0;$pip<count($final_list_first_name);$pip++)
{
	echo '<tr><th>'.$final_list_first_name[$pip].', '.$final_list_last_name[$pip].'</th>';

	//go through his attendance records and dislay an X or a tick 
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
echo '
</tbody>
</table>
</div>
</div>
</div>';

//After all the loop and function calls we can finally print the string to the browser
echo $script_to_be_sent;


// This method is used to return and array of timestamps of lectures for a given course 
function getting_timetable($course_num)
{
	$list_lectures = array();
	$dbc = mysqli_connect('localhost', 'ma303jd', 'james23','ma303jd_admin');
	$query_timetable = mysqli_query($dbc,"SELECT time_in from Timetable where course_id= '$course_num' ORDER BY time_in ASC");
	while ($row = mysqli_fetch_array($query_timetable,MYSQLI_ASSOC))
	{
		$list_lectures[] = $row;
	}

	for($l=0;$l<count($list_lectures);$l++)
	{
		$time_in = new DateTime($list_lectures[$l]['time_in']);


		//Creating an array of attendance over the whole time period
		$format_date = $time_in->format('Y-m-d'); // formatting the timestamp as we want to display
		$final_attendance_record_dates[] = $format_date;

	}
	return $final_attendance_record_dates; //return array of timestamps
}

//this method is meant to take in a course number and students timestamps and return an array of representing the students attendance over 
//the term period

function attendance_check($course_num,$input)
{
	$dbc = mysqli_connect('localhost', 'ma303jd', 'james23','ma303jd_admin');
	$final_attendance_record = array(0,0,0,0,0,0,0,0,0,0); // array of results initialised
	$list_classes = array();
	$temp_query = "SELECT time_in,time_out from Timetable where course_id= '$course_num' ORDER BY time_in";
	$query_attendance = mysqli_query($dbc,$temp_query);
	while ($row = mysqli_fetch_array($query_attendance,MYSQLI_ASSOC))
	{	

		$list_classes[] = $row; 
	}
	//Now that we have an array representing the times the student attended class we can compare them with the times
	// he should of been in class
	for($k=0;$k<count($list_classes);$k++)
	{
		//times he should be in 
		$time_in = new DateTime($list_classes[$k]['time_in']);
		$time_out = new DateTime($list_classes[$k]['time_out']);
		//looping over the student timestamps and checking they are in the lectures timeframe
		foreach($input as $pop)
		{
			$encoded = new Datetime($pop['timestamp']);
			if ($encoded > $time_in && $encoded < $time_out)
			{

				$final_attendance_record[$k] = 	1; //if yes, replace 0 with 1
			}
		}
	}
	return $final_attendance_record; // return the Array
}


//Chacking Session and seeing if the user should be logging in or not. Retunrn to login is not
if(!isset($login)){
	mysql_close($connection); // Closing Connection
	header('Location: index.html'); // Redirecting To Home Page
}
?>
