<?php
//session_start();
include 'session.php';

require("conn.php");

$userID = $_SESSION['user_id'];


$log_user_qury=mysqli_query($conn,"SELECT * FROM thusers WHERE thusers.user_id='$_SESSION[user_id]'");
$log_user_resalt=mysqli_fetch_array($log_user_qury);
?>