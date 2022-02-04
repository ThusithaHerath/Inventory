	<?php
	$type = $_POST['type'];
	if($type=='Textile Loan'){
	require("db_connection.php");

	$sql = "SELECT * FROM pos_loan_users ";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {


		echo '<select name="loanCusId" class="form-control select2" id="loanCusId" style="width: 100%;">
	<option value="0">Select Loan Customer</option>';
  // output data of each row
		$rowcount = 0;	
		while($row = $result->fetch_assoc()) {
			$rowcount = $rowcount +1;
			?>
			<option value="<?php echo $row["id"]; ?>"><?php echo $row["nic"]; ?> | <?php echo $row["name"]; ?></option>
			<?php
		}

		echo '</select>';
	} else {
		echo "0 results";
	}
	$conn->close();




}else{


echo '<select name="loanCusId" class="form-control select2" id="loanCusId" style="width: 100%;">
	<option value="0">************</option>';
echo '</select>';	

}
	?>
