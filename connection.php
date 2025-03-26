<?php
//connecting to mysli server
$domain="localhost";
$dbuser="root";
$dbpass="";
$dbname="cde";
$con= mysqli_connect($domain,$dbuser,$dbpass) or die(mysqli_error($con));
mysqli_select_db($con,'cde')or die(mysqli_error($con));
?>
