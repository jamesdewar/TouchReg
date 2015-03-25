<!--
This file deletes the Session and redirects the user when he decides to sign Out
---->
<?php
session_start();
if(session_destroy()) // Destroying All Sessions
{
header("Location: index.html"); // Redirecting To Home Page
}
?>
