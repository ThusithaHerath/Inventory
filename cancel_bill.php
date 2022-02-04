<?php session_start(); include('connect.php');

	$invoice_no = $_POST['invoice_no'];
	
	$q = $db->prepare("UPDATE `thsales_order_summery` SET is_cancel = 1 WHERE invoice_no = $invoice_no LIMIT 1");

	if ($q->execute()){	
		$a['s'] = 1;
	}else{
		$a['s'] = 0;
	}

	echo json_encode($a);	

?>