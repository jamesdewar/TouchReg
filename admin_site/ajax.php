<?php
$id = (int)$_POST['id'];
$all_attendance_timestamp = array();
$all_attendance_course = array();
$list_timestamps = array();
$dbc = mysqli_connect('localhost', 'ma303jd', 'james23','ma303jd_admin');
$query = "SELECT timestamp,course_id from Attendance where student_id='$id' ORDER BY course_id ASC";
$result = mysqli_query($dbc,$query);
//$row_test = mysqli_fetch_array($result,MYSQLI_NUM);
while ( $row = mysqli_fetch_array($result, MYSQLI_ASSOC) ) 
{
	$list_timestamps[] = $row;
}

foreach ($list_timestamps as $temp)
{
	$timestamp = new DateTime($temp['timestamp']);
	$format_date = $timestamp->format('Y-m-d H:i:s');
	$overall_ind_attendance[$temp['timestamp']] = $temp['course_id'];

}
//$overall_ind_attendance = array_combine($all_attendance_timestamp,$all_attendance_course);
$input = 0;
$test = array();

foreach ($overall_ind_attendance as $key => $value) {
	if ($input != $value)
	{
		$input = $value;
		${"test".$input} = array();
		array_push(${"test".$input},$key); 
		
	}
	else
	{
		array_push(${"test".$input},$key);
		
	}	
}
$com1 = implode(",",$test5);
$com2 = implode(",",$test1);
$com = implode(",",$test3);
$json = array();
$json['html'] = '<p>'. $com1. "  ".  $com  . '</p>';

header('Content-Type: application/json');
echo json_encode( $json );
?>
