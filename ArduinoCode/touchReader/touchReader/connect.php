<?php
	function connection()
	{
		if (!($link=mysqli_connect("p:localhost","ma301wm","wikfe517","ma301wm_test"))) {exit();}
		//if (!mysql_select_db("your_database",$link)) {exit();}
		return $link;
	}
?>