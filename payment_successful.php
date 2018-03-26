<?php
	session_start();
	include("functions/functions.php");
?>

<html>
  <head>
    <title> DBCart: Payment Success! </title>
    <link rel="stylesheet" href="styles/style.css" media="all">
  </head>
  <body>
    <div class="main_wrapper">
      <div class="header_wrapper">
        <a href="index.php"><img id="logo" src="images/logo.png" ></a>
				<img src="images/banner.png" id="banner1" height="100px" width="300">
        <img src="images/online_shop.jpg" id="banner" height="100px" width="500">
      </div>

      <div class="menubar">
        <ul id="menu">
          <li><a href="index.php">Home</a></li>
          <li><a href="all_products.php">All Products</a></li>
          <?php if(isset($_SESSION['username'])){echo '<li><a href="customer/my_account.php">My Account</a></li>';}?>
          <li><a href="cart.php">Cart</a></li>
			<?php
				if(!isset($_SESSION['username'])){
					echo '<li><a href="Registration/register.php">Sign Up</a></li>';
				}
			?>
        </ul>

        <div id="form">
          <form action="results.php" method="get" enctype="multipart/form-data">
            <input type="text" name="user_query" placeholder="I am looking for">
            <input type="submit" name="search" value="Search">
          </form>
        </div>
      </div>

      <div class="content_wrapper">
        <div id="sidebar">
          <div id="sidebar_title">Categories</div>
          <ul id="cats">
            <?php getCats(); ?>

          </ul>
          <div id="sidebar_title">Brands</div>
          <ul id="cats">
            <?php getBrands(); ?>
          </ul>
        </div>
        <div id="content_area">
			<?php cart(); ?>
			<div id="shopping_cart">
				<span style="float:right; font-size:18px; padding:5px; line-height:40px;">
					<?php
						if(isset($_SESSION['username'])){
							echo 'Welcome '.$_SESSION['name'];
						}
						else{
							echo 'Welcome Guest';
						}
					?>
					<b style="color:black">Shopping Cart- </b> Items: <?php total_items(); ?> Price: <?php total_price(); ?> <a href="cart.php"
					style="color:black;color:green;text-decoration:none;" >View Cart</a>
					<?php
						if(isset($_SESSION['username'])){
							echo '<a href="logout.php" style="color:black;color:green;text-decoration:none;" >Logout</a>';
						}
						else{
							echo '<a href="Login_v3/login.php" style="color:black;color:green;text-decoration:none;" >Login</a>';
						}
					?>
				</span>
			</div>
			<div id = products_box>
				<br>
				<form action="payment.php" method="post" enctype="multipart/form-data">
					<table align="center" width="700" bgcolor="skyblue">
						<tr align="center">
							<th>Product(S)</th>
							<th>Quantity</th>
							<th>Single Price</th>
							<th>Total Price</th>
						</tr>

						<?php
							$user = $_SESSION['username'];
							$total = 0;
							$total_cart_price = 0;
							global $con;
							$ip = getIp();
							$sel_price = "select * from cart where ip_add='$ip'";
							$run_price = mysqli_query($con, $sel_price);
							$pro_id_arr = array();

							while($p_price=mysqli_fetch_array($run_price)){
								$pro_id = $p_price['p_id'];
								array_push($pro_id_arr, $pro_id);
								$pro_qty = $p_price['qty'];
								$pro_price = "select * from products where product_id='$pro_id'";
								$run_pro_price = mysqli_query($con, $pro_price);
								while($pp_price = mysqli_fetch_array($run_pro_price)){
									$product_price = array($pp_price['product_price']);
									$product_title = $pp_price['product_title'];
									$product_image = $pp_price['product_image'];
									$single_price = $pp_price['product_price'];
									$values = array_sum($product_price);
									$total_price = $single_price * $pro_qty;
									$total += $values;


						?>

						<tr align="center">
							<td>
								<?php echo $product_title; ?><br>
								<img src="admin_area/product_images/<?php echo $product_image; ?>" width="60" height="60">
							</td>
							<td><?php echo $pro_qty; ?></td>



							<td><?php echo "₹".$single_price; ?></td>
							<td><?php echo "₹".$total_price; ?></td>
						</tr>

						<?php }
							$total_cart_price += $total_price;
							$insert_payments = "insert into payments(amount, customer_id, product_id) values('$total_price', '$user', '$pro_id')";
							$run_payments = mysqli_query($con, $insert_payments);

							$insert_order = "insert into orders(p_id, c_id, qty) values ('$pro_id', '$user', '$pro_qty')";
							$run_orders = mysqli_query($con, $insert_order);
							}
							if ($run_orders && $run_payments) {
								$empty_cart = "delete from cart";
								$run_cart = mysqli_query($con, $empty_cart);
							}

						?>
						<tr align="center">
							<td colspan="3" align="right"><b>Total</td>
							<td colspan="3"><?php echo "₹".$total_cart_price; ?></td>
						</tr>

					</table>
				</form>

				<?php

					echo "<h2>Welcome:" .$_SESSION['customer_email']."\nYour Payment was successful, please go to your account</h2>";
					echo "<h3><a href='customer/my_account.php'>Go to your account</h3>";
				?>
			</div>
        </div>
      </div>

      <div id="footer"> <h2 style="text-align:center;padding-top:10px;">&copy; 2018 by dbcart.com </h2> </div>
    </div>

  </body>
</html>
