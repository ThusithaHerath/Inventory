<?php session_start(); include('connect.php');

	$invoice_no = get_max();
	$amount = $_POST['total_amount'];
	$profit = 0;
	$datetime = date('Y-m-d h:i:s');
	$added_by = $_SESSION['user_id'];
	
	$q = $db->prepare("INSERT INTO `thsales_order_summery` (`invoice_no`, `amount`, `profit`, `datetime`, `added_by`) VALUES 	('$invoice_no', '$amount', '0', '$datetime', '$added_by') ");	

	if ($q->execute()){

		$su = true;

		for($n = 0 ; $n < count ( $_POST['product_id'] ) ; $n++ ){

			$product_id = $_POST['product_id'][$n];
			$price = $_POST['price'][$n];
			$qty = $_POST['qty'][$n];

			$q = $db->prepare("INSERT INTO `thsales_order_details` (`invoice_no`, `product_id`, `price`, `qty`) VALUES ('$invoice_no', '$product_id', '$price', '$qty')");
			$q->execute();

			$q = $db->prepare("UPDATE `thproducts` SET qty = (qty - $qty) WHERE product_id = $product_id LIMIT 1 ");
			$q->execute();

		}

	}

	if ($su){
		$a['s'] = 1;
	}else{
		$a['s'] = 0;
	}

	echo json_encode($a);


	function get_max(){	

		include('connect.php');
		$result = $db->prepare("select ifnull(max(invoice_no)+1,1) as max_no from `thsales_order_summery`");	
		$result->execute();		
		$max_no = $result->fetch();		
		return $max_no['max_no'];

	}

?>