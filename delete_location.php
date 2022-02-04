<?php

	require_once 'dbconfig4.php';
	
	if(isset($_GET['loid']))
	{

		$stmt_delete = $DB_con->prepare('DELETE FROM thlocation WHERE lid =:loid');
		$stmt_delete->bindParam(':loid',$_GET['loid']);
		$stmt_delete->execute();

		echo"<script type='text/javascript'>window.location.href = 'location.php';</script>";
		
	}

?>