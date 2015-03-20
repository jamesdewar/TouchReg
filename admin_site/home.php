<?php
include('session.php'); // The session file has virtually ALL the logic + html that create the home page
?>

<div id = "personal"></div>
<div id = "stat" style="min-width: 600px; height: 400px; margin: 0 auto">

<?php

// To represent graphs we use a JS library called HighCharts. Below you will find an implementation for the overall Attendance
//One of the scripts that we used for inspiration is: http://jsfiddle.net/gh/get/jquery/1.9.1/highslide-software/highcharts.com/tree/master/samples/highcharts/demo/line-basic/
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
