<?php
mysqli_report(MYSQLI_REPORT_OFF);

$connect = mysqli_connect('localhost:3307','root','','crud_application');

if (mysqli_connect_errno()) {
	
	die("<h1 style='color:red;'> Database Connection Failed!...</h1>");
}


?>