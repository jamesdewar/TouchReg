<html>
<body>
<?php
$dbc = mysqli_connect('p:localhost','ma303jd','james23','ma303jd_admin');
//$db = mysqli_select_db($dbc,'ma303jd_admin');
print mysqli_error($dbc);
$username = mysqli_real_escape_string($dbc,$_POST['email']);
$password_input =mysqli_real_escape_string($dbc,$_POST['pass']);
session_start();


$query = "SELECT * FROM teacher WHERE  Email = '$username'  AND password = '$password_input'";
$execute = mysqli_query($dbc,$query); 
$confirm = mysqli_fetch_array($execute);
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
