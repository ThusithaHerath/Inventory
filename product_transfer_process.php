<?php
session_start();
require("db_connection.php");
require("dbconfig4.php");

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}



if (isset($_POST['add_items'])) {

    


    $branch   = $_POST['branch'];
    $barcodes = $_POST['barcodes'];
    
    $array = preg_split("/\r\n|\n|\r/", $barcodes);

	$array = array_unique($array);
    
    $html     = '<table class="table mb-0 w-p100">
<thead>
<tr>
<th>#No</th>
<th>Product</th>
<th>Barcode</th>
<th>price</th>
</tr>
</thead>
<tbody>';
    $no_count = 0;
    for ($i = 0; $i < count($array); $i++) {
        $barcode = $array[$i];

		
        
        $sql       = "SELECT * FROM product_sub_barcode WHERE product_main_inst =".$_SESSION['user_branch']." AND product_sub_barcode = '" . $barcode . "'";
        $list_qury = mysqli_query($connation, $sql);
        if(! $result    = mysqli_fetch_array($list_qury)){
            continue;
        }

        $no_count++;


    $product_sub_norep = $result['product_sub_norep'];

    $sql = "SELECT * FROM product_main_barcode WHERE product_main_norep='$product_sub_norep'";

    $main_product_query = mysqli_query($connation, $sql);
    $main_product_result = mysqli_fetch_array($main_product_query);


		$price = $main_product_result['product_main_price'];

        $cat_id = $result['sub_cat'];
        
        
        $sql       = "SELECT * FROM product_sub_category WHERE product_sub_id = '" . $cat_id . "'";
        $list_qury = mysqli_query($connation, $sql);
        $result    = mysqli_fetch_array($list_qury);

		
		
        
        $name = $result['product_sub_name'];
        
        $html .= '<tr>
<td >'. number_format(($no_count+1),0) .'</td>

<td >'. $name .'</td>
<td >'. $barcode .'</td>
<td >'. $price .'</td>

</tr>';
        
        
    }

    if ($no_count == 0) {
        $html .= '</tbody></table><button disabled="disabled" class="form-control btn btn-info" onclick="transfer_barcodes();">Process All</button>';
    }else{
        $html .= '</tbody></table><button class="form-control btn btn-info" onclick="transfer_barcodes();">Process All</button>';
    }
    


	echo $html;
}


if (isset($_POST['transfer_items'])) {

    $transfer_key = generateRandomString();

    $branch   = $_POST['branch'];
    $barcodes = $_POST['barcodes'];
    
    $array = preg_split("/\r\n|\n|\r/", $barcodes);
	$array = array_unique($array);
	
    for ($i = 0; $i < count($array); $i++) {
        $cur_barcode = $array[$i];
        
        
        $sql       = "SELECT * FROM product_sub_barcode WHERE product_main_inst =".$_SESSION['user_branch']." AND product_sub_barcode = '" . $cur_barcode . "'";
        //echo $sql;
        $query  = $conn->query($sql);
        if(!mysqli_fetch_assoc($query)){
            continue;
        }
        
        $product_main_inst = $_SESSION['user_branch'];
        
        $sql = "UPDATE product_sub_barcode
            SET product_main_inst = '".$branch."'
            WHERE product_sub_barcode='".$cur_barcode."'";

            //echo $sql;
        
        if ($conn->query($sql) === TRUE) {
            echo $cur_barcode . " Record Transfered Successfully<br>";
            
            $sql = "
            INSERT INTO product_transferring (barcode, old_institute_id, new_institute_id, transferred_by, transfer_key)
            VALUES ('" . $cur_barcode . "', '" . $product_main_inst . "', '" . $branch . "','" . $_SESSION['user_id'] . "', '". $transfer_key. "')
            ";

            //echo $sql;
            
            $conn->query($sql);
            
        } else {
            echo $cur_barcode . " Record Transfered Failed....<br>";
        }
        
    }
}



?>