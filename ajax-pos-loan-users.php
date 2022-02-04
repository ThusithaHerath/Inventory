<?php 
session_start();
require("conn.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_GET['nic']) && isset($_GET['name']) && isset($_GET['institution'])){

	$nic = htmlspecialchars($_GET['nic']);
	$name = htmlspecialchars($_GET['name']);
	$institution = htmlspecialchars($_GET['institution']);

	$query = "INSERT INTO pos_loan_users (nic, name, institution, state) VALUES ('".$nic."', '".$name."', '".$institution. "', 1)";
	//echo $query;
	
	mysqli_query($conn, $query);
}


if(isset($_GET['itm_id'])&&isset($_GET['remove'])){


	$id = htmlspecialchars($_GET['itm_id']);

	if (strcmp($_SESSION["user_type"], "Super Admin") == 0) {
		mysqli_query($conn,"UPDATE pos_loan_users SET state=3 WHERE id=".$id);
	}else{
		mysqli_query($conn,"UPDATE pos_loan_users SET state=2 WHERE id=".$id);		
	}


}

?>

<?php

$no_count=0;

$list_qury=mysqli_query($conn,"SELECT * FROM pos_loan_users");

while($list_resalt=mysqli_fetch_array($list_qury)){

$no_count++;

?>
<tr>
<td><?php echo number_format($no_count,0); ?></td>
<td><a href="JavaScript:remove_user(<?php echo $list_resalt['id']; ?>);" ><i class="fa fa-close text-dark fa-lg"></i></a></td>
<td><?php echo $list_resalt['nic']; ?></td>
<td><?php echo $list_resalt['name']; ?></td>
<td><?php echo $list_resalt['institution']; ?></td>
<td><?php echo $list_resalt['date']; ?></td>
<th>

    <?php 
     if ($list_resalt['state'] == 1) {
        echo "<span class='badge badge-success'>Active</span>";
     
     } else if ($list_resalt['state'] == 2) {
        echo "<span class='badge badge-info'>Delete pending</span>";
     } else if ($list_resalt['state'] == 3) {
        echo "<span class='badge badge-danger'>Deleted</span>";
     } 
    ?>
        
</th>

</tr>
    
<?php } ?>