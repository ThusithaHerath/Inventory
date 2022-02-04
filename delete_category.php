<?php

	require_once 'dbconfig4.php';
	
	if(isset($_GET['ctid']))
	{

		$stmt_delete = $DB_con->prepare('DELETE FROM product_category WHERE product_category_id =:ctid');
		$stmt_delete->bindParam(':ctid',$_GET['ctid']);
		$stmt_delete->execute();

		echo"<script type='text/javascript'>window.location.href = 'maincategory.php';</script>";
		
	}

?>