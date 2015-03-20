<html>
<body>

<?php

// This File is used for the connection credential checking.

//Conneciton to the db
$dbc = mysqli_connect('p:localhost','ma303jd','james23','ma303jd_admin');
//Error Handling
print mysqli_error($dbc); 
//Taking in as variables the credential inputted by the user.
// We use escape_string method as a simple method to clean up the string and prevent sql injection
$username = mysqli_real_escape_string($dbc,$_POST['email']);
$password_input =mysqli_real_escape_string($dbc,$_POST['pass']);
session_start(); // We need to start the session to make session variables

//Query to retrieve the necessary credentials for valid login
$query = "SELECT * FROM teacher WHERE  Email = '$username'  AND password = '$password_input'";
$execute = mysqli_query($dbc,$query); 
$confirm = mysqli_fetch_array($execute);

// if the $confirm variable exists we can confirm that the credentials DO exist and are correct
if ($confirm){
$_SESSION['email'] = $username;
echo "<script>window.open('home.php','_self')</script>"; // Redirect to home if the credentials are correct
}
else {
echo "<script>window.open('index.html','_self')</script>"; // redirect to login if the credentials are incorrect
}    	 
     
?>

</body>
</html>
