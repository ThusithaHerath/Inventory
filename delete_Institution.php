<?php

	require_once 'dbconfig4.php';
	
	if(isset($_GET['inid']))
	{

		$stmt_delete = $DB_con->prepare('DELETE FROM product_institution WHERE product_institution_id =:inid');
		$stmt_delete->bindParam(':inid',$_GET['inid']);
		$stmt_delete->execute();

		echo"<script type='text/javascript'>window.location.href = 'Institution.php';</script>";
		
	}

?>