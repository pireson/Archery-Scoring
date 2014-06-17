<?php

require_once("connect.php");

// username and password sent from form 
$myusername=$_POST['myusername']; 
$mypassword=$_POST['mypassword']; 

$result = mysqli_query($con,"SELECT * FROM archer WHERE user_name='$myusername' and password='$mypassword'");
$archer = mysqli_fetch_array($result);

// Mysqli_num_row is counting table row
$count=mysqli_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){

// Register $myusername, $mypassword and redirect to file "login_success.php"
session_start();
$_SESSION["myusername"] = $myusername;
$_SESSION["archer_id"] = $archer["archer_id"];
header("location:round_display.php");

}
else {
header("location:second_login.php");
}
?>