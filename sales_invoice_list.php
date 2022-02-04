<div class="table-responsive">

	<table id="example" class="table mb-0 w-p100">

		<thead>
			<tr>
				<th>#No</th>
				<th>Invoice</th>
				<th>Date</th>
				<th>Time</th>
				<th>Type</th>
				<th>Discount</th>
				<th>Amount</th>
				<th>View</th>
			</tr>
		</thead>
		<tbody>

			<?php
			$total_sale = 0;
			//session_start();
			require("db_connection.php");
			$sdate = $_POST['sdate'];
			$edate = $_POST['edate'];
			$branch = $_POST['branch'];

			if($branch>0){
				$sql = "SELECT * FROM pos_sale WHERE pos_sale_branch='$branch' AND  pos_sale_date>= '$sdate' AND pos_sale_date<= '$edate'  ORDER BY pos_sale_id DESC ";
			}else{
			$sql = "SELECT * FROM pos_sale WHERE pos_sale_branch='$_SESSION[user_branch]' AND  pos_sale_date>= '$sdate' AND pos_sale_date<= '$edate'  ORDER BY pos_sale_id DESC ";
		}
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
  // output data of each row
				$rowcount = 0;
				$total_sale = 0;	
				while($row = $result->fetch_assoc()) {
					$rowcount = $rowcount +1;
					$total_sale = $total_sale+$row["pos_sale_amount"];
					?>
					<tr>
						<td><?php echo $rowcount; ?></td>
						<td><?php echo $row["pos_sale_invoice"]; ?></td>
						<td><?php echo $row["pos_sale_date"]; ?></td>
						<td><?php echo $row["pos_sale_time"]; ?></td>
						<td><?php echo $row["sale_type"]; ?></td>
						<td><?php echo $row["pos_sale_discount"]; ?>%</td>
						<td><?php echo number_format((float)$row["pos_sale_amount"],2); ?></td>
						<td>
							<a target="_" href="sale_invoice_items.php?invoice=<?php echo $row["pos_sale_invoice"]; ?>&tx=<?php echo $row["pos_sale_discount"]; ?>">View Items</a>
						</td>

					</tr>


					<?php
				}
			} else {
				echo "0 results";
			}
			$conn->close();
			?>


		</tbody>
		<tfoot>
			<tr>
				<td colspan="6">Total</td>
				<td><?php echo number_format((float)$total_sale,2); ?></td>
			</tr>
		</tfoot>


	</table>

</div>