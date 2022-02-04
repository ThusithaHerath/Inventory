<?php

	require_once 'dbconfig4.php';
	
	if(isset($_GET['scid']))
	{

		$stmt_delete = $DB_con->prepare('DELETE FROM product_maincategory WHERE product_maincategory_id =:scid');
		$stmt_delete->bindParam(':scid',$_GET['scid']);
		$stmt_delete->execute();
		
		//header("Location: mainmaincategory.php");
		echo"<script type='text/javascript'>window.location.href = 'mainmaincategory.php';</script>";
		
	}

?>