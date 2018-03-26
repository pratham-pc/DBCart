<table align="center" width="700" bgcolor="skyblue">
	<tr align="center">
		<th>Payment - ID</th>
		<th>Product(S)</th>
		<th>Customer</th>
		<th>Amount</th>
	</tr>

	<?php
		include("includes/db.php");
		include("../functions/functions.php");
		$total = 0;
		$total_cart_price = 0;
		global $con;
		$ip = getIp();
		$get_order = "select * from payments";
		$run_order = mysqli_query($con, $get_order);
		$o_id_arr = array();
		while($row_order=mysqli_fetch_array($run_order)){
			$pro_id = $row_order['product_id'];
			$c_id = $row_order['customer_id'];
			$amt = $row_order['amount'];
			$pro_price = "select * from products where product_id='$pro_id'";
			$run_pro_price = mysqli_query($con, $pro_price);
			while($pp_price = mysqli_fetch_array($run_pro_price)){
				$product_title = $pp_price['product_title'];
				$product_image = $pp_price['product_image'];
			}
			$payment_id = $row_order['payment_id'];

			?>

	<tr align="center">
		<td>
			<?php echo $payment_id; ?><br>
		</td>
		<td>
			<?php echo $product_title; ?><br>
			<img src="/admin_area/product_images/<?php echo $product_image; ?>" width="60" height="60">
		</td>
		<td>
			<?php echo $c_id; ?><br>
		</td>
		<td>
			<?php echo $amt; ?><br>
		</td>
	</tr>
		<?php }
	  ?>

</table>
