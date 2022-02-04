<?php
	$server = "localhost";
	$username = "root";
	$pass = "";
	$db = "peshakarma";

	//create connection 

	$conn = mysqli_connect($server,$username,$pass,$db);
date_default_timezone_set("Asia/Colombo");
$current_date=date("Y-m-d");
$current_time=date("H:i:s");

	//check conncetion

	if($conn->connect_error){

		die ("Connection Failed!". $conn->connect_error);
	}

?>
