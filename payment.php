<html>
<head>
<title>Payment Gateway</title>
</head>
<body>
<div>
<?php
	include("includes/db.php");
	include("functions/functions.php");
	$total = 0;
	global $con;
	$ip = getIp();
	$sel_price = "select * from cart where ip_addr='$ip'";
	$run_price = mysqli_query($con, $selprice);
	while($p_price=mysqli_fetch_array($run_price)) {
		$pro_id= $p_price['p_id'];
		$pro_price = "select * from products where product_id='$pro_id'";
		$run_pro_price = mysqli_query($con, $pro_price);
		while($pp_price = mysql_fetch_array($runpro_price)) {
			$product_price = array($pp_price['product_price']);
			$product_id = $pp_price['product_id'];
		 	$values = array_sum($product_price);
			$total += $values;
		}
	}
?>

<h2 align = "center">Pay using Cash on delivery method</h2>
<h2><a href="payment_successful.php">Pay ₹<?php echo total_price(); ?> !</a></h2>
<h2><a href = "payment_unsuccesful.php">Cancel</a></h2>
</div>
</body>
</html>
