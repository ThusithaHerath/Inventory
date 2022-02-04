<?php

	require_once 'dbconfig4.php';
	
	if(isset($_GET['scid']))
	{

		$stmt_delete = $DB_con->prepare('DELETE FROM thsubcategory WHERE sid =:scid');
		$stmt_delete->bindParam(':scid',$_GET['scid']);
		$stmt_delete->execute();
		
		//header("Location: submaincategory.php");
		echo"<script type='text/javascript'>window.location.href = 'submaincategory.php';</script>";
		
	}

?>