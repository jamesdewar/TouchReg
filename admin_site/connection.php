<!--
This file is used for checking the credentials of people attempting to sign in


---->


<html>
<body>
<?php

//connection to db . Localhost because the file is hosted on igor
$dbc = mysqli_connect('p:localhost','ma303jd','james23','ma303jd_admin');
// Using escape string for security resons
$username = mysqli_real_escape_string($dbc,$_POST['email']);
$password_input =mysqli_real_escape_string($dbc,$_POST['pass']);
//Need to start sesison to create sessoin variables
session_start();

//Query to check if credentials are correct
$query = "SELECT * FROM teacher WHERE  Email = '$username'  AND password = '$password_input'";
$execute = mysqli_query($dbc,$query); 
$confirm = mysqli_fetch_array($execute);
//Conditional to check if the result of the query is positive or not. Re direct user approprietly
if ($confirm){
$_SESSION['email'] = $username;
echo "<script>window.open('home.php','_self')</script>";
}
else {
echo "<script>window.open('index.html','_self')</script>";
}    	
     
?>

</body>
</html>
