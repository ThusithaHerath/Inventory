<?php
$DB_HOST = "localhost";
$DB_USER = "root";
$DB_PASS = "";
$DB_NAME = "peshakarma";

$connation=mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);
if(!$connation){
	die("Database connation error!");
}
date_default_timezone_set("Asia/Colombo");
$current_date=date("Y-m-d");
$current_time=date("H:i:s");

$sms_user_id="103303";
$sms_api_key="5y3nmu3bs77ji5w5o";
$sms_sender_id="ozoneDEMO";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try{
		$DB_con = new PDO("mysql:host={$DB_HOST};dbname={$DB_NAME}",$DB_USER,$DB_PASS);
		$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
	
?>