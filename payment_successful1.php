<?php
session_start();
?>

<html>
<head>
<title>Payment Successfull!</title>
</head>
<body>
<?php
/*Payment and Product information */
include("includes/db.php");
include("functions/functions.php");
$total = 0;
global $con;
$ip = getIp();
$sel_price = "select * from cart where ip_add='$ip'";
$run_price = mysqli_query($con, $sel_price);

$user = $_SESSION['username'];

while($p_price=mysqli_fetch_array($run_price)){
	$pro_id = $p_price['p_id'];
	$pro_qty = $p_price['qty'];
	$pro_price = "select * from products where product_id='$pro_id'";
	$run_pro_price = mysqli_query($con, $pro_price);
	while($pp_price = mysqli_fetch_array($run_pro_price)){
		$product_price = array($pp_price['product_price']);
		$single_price = $pp_price['product_price'];
		$total_price = $single_price * $pro_qty;
		$values = array_sum($product_price);
		$values *= $pro_qty;
		$total += $values;
	}
	$insert_payments = "insert into payments (amount,customer_id,product_id) values('$', '$user', '$pro_id')";
	$run_payments = mysqli_query($con, $insert_payments);
	$insert_order = "insert into orders (p_id, c_id, qty) values ('$pro_id', '$user', '$pro_qty')";
	$run_orders = mysqli_query($con, $insert_order);
}

$empty_cart = "delete from cart";
$run_cart = mysqli_query($con, $empty_cart);

echo $total;
// 	// quantity of the products
// 	$get_qty = "select * from cart where p_id='$pro_id'";
// 	$run_qty = mysqli_query($con, $get_qty);
// 	$row_qty = mysqli_fetch_array($run_qty);
// 	$qty = $row_qty['qty'];
// 	if ($qty ==0 {
// 		$qty = 1;
// 	} else {
// 		$qty = $qty;
// 		$total = $total * $qty
// 	}
 	// customer detials

echo "<h2>Welcome:" .$_SESSION['customer_email']."Your Payment was successful, please go to your account</h2>";
echo "<h3><a href='customer/my_account.php'>Go to your account</h3>";
?>
</body>
</html>
