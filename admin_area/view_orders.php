<form action="" method="post" style="padding:80px;">
<table align="center" width="700" bgcolor="skyblue">
	<tr align="center">
		<th>Order - ID</th>
		<th>Order - Time</th>
		<th>Product(S)</th>
		<th>Quantity</th>
		<th>Order - Status</th>
	</tr>

	<?php
		include("includes/db.php");
		include("../functions/functions.php");
		$total = 0;
		$total_cart_price = 0;
		global $con;
		$ip = getIp();
		$get_order = "select * from orders";
		$run_order = mysqli_query($con, $get_order);
		$o_id_arr = array();
		while($row_order=mysqli_fetch_array($run_order)){
			$pro_id = $row_order['p_id'];
			$pro_price = "select * from products where product_id='$pro_id'";
			$run_pro_price = mysqli_query($con, $pro_price);
			while($pp_price = mysqli_fetch_array($run_pro_price)){
				$product_price = array($pp_price['product_price']);
				$product_title = $pp_price['product_title'];
				$product_image = $pp_price['product_image'];
			}
			$order_id = $row_order['order_id'];
			array_push($o_id_arr, $order_id);
			$pro_qty = $row_order['qty'];
			$pro_date_time = $row_order['order_date_time'];
			$pro_status = $row_order['status'];

if(isset($_POST['update_orders'])){
        for ($i = 0, $j = 0; $i < count($o_id_arr) && $j < count($_POST['qty']); $i++, $j++) {
                $new_o_status = $_POST['qty'][$j];
                $update_o = "update orders set status='$new_o_status' where order_id ='".$o_id_arr[$i]."'";
                $run_o = mysqli_query($con, $update_o);
                $_SESSION['qty'] = $new_o_status;
        }
        if ($run_o) {
        echo "<script>window.open('index.php?view_orders','_self')</script>";
	echo"HOLA";
        }
}

			?>

	<tr align="center">
		<td>
			<?php echo $order_id; ?><br>
		</td>
		<td>
			<?php echo $pro_date_time; ?><br>
		</td>
		<td>
			<?php echo $product_title; ?><br>
			<img src="/admin_area/product_images/<?php echo $product_image; ?>" width="60" height="60">
		</td>
		<td>
			<?php echo $pro_qty; ?><br>
		</td>
		 <td><input type="text" size="10" name="qty[]" value="<?php echo $pro_status; ?>"></td>
	</tr>
		<?php }
	  ?>
	  <tr align="center">
	       <td colspan="2"><input type="submit" name="update_orders" value="Update Orders"></td>
	  </tr>

</table>
</form>
