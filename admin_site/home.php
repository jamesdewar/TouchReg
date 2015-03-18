<?php
include('session.php');
?>

<div id = "personal"></div>
<div id = "stat" style="min-width: 600px; height: 400px; margin: 0 auto">

<?php
echo '<script>';
echo 'var dates = []; 
	var number = []; 
	number = '.json_encode($_SESSION['general_attendance_number']).'; 
	dates = '.json_encode($_SESSION['general_attendance_course']).';
	$(function () {
    $(\'#stat\').highcharts({
        title: {
            text: \'Overall Attendance\',
            x: -20 //center
        },
        xAxis: {
            categories: dates
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
	name: \'Course 1\',
   	 data: number
	}]
    });
});';
echo '</script>';
?>
</div>
			<div id="log_out">
	<a href="logout.php">Log out</a>

</body>
</html>
