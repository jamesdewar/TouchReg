<?php
$id = (int)$_POST['id'];
$all_attendance_timestamp = array();
$all_attendance_course = array();
$list_ind_courses = array();
$dbc = mysqli_connect('localhost', 'ma303jd', 'james23','ma303jd_admin');
$query = "SELECT DISTINCT course_id from Attendance where student_id='$id' ORDER BY course_
id ASC";
$result = mysqli_query($dbc,$query);
$list_ind_courses = array();
while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
{
	$list_ind_courses[] = $row;
}
//echo $list_ind_courses[0]['course_id'];
//print_r($list_ind_courses);
$final_ind_attendance = array();
for ($i=0;$i<count($list_ind_courses);$i++)
{
	$course_id = $list_ind_courses[$i]['course_id'];
	$query_timestamps = "SELECT timestamp from Attendance where student_id='$id'  and course_id = '$course_id'";
	$all_attendance_timestamp = array();
	$testing = array();
	$prototype = array();
	$result_timestamp = mysqli_query($dbc,$query_timestamps);
	while ($row =  mysqli_fetch_array($result_timestamp,MYSQLI_ASSOC))
	{
		array_push($all_attendance_timestamp,$row);
	} 
	//$final_ind_attendance [$course_id] = $testin
	//print_r($all_attendance_timestamp)
	//print_r($testing);
	//      array_push (


//	unset($all_attendance_timestamp);

}
//	header('Content-Type: application/json');
	$test = "testing";
	$json['html'] = '<p>'. $test  . '</p>';


	echo json_encode( $test);
?>
