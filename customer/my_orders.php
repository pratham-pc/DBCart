<?php
	session_start();
	include("functions/functions.php");
?>

<html>
  <head>
    <title> DBCart </title>
    <link rel="stylesheet" href="/styles/style.css" media="all">
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
          <li><a href="/index.php">Home</a></li>
          <li><a href="/all_products.php">All Products</a></li>
          <li><a href="/customer/my_account.php">My Account</a></li>
          <li><a href="/cart.php">Cart</a></li>
			<?php
				if(!isset($_SESSION['username'])){
					echo '<li><a href="/register.php">Sign Up</a></li>';
				}
			?>
        </ul>

        <div id="form">
          <form action="/results.php" method="get" enctype="multipart/form-data">
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
					<b style="color:black">Shopping Cart- </b> Items: <?php total_items(); ?> Price: <?php total_price(); ?> <a href="/cart.php"
					style="color:black;color:green;text-decoration:none;" >View Cart</a>
					<?php
						if(isset($_SESSION['username'])){
							echo '<a href="/logout.php" style="color:black;color:green;text-decoration:none;" >Logout</a>';
						}
						else{
							echo '<a href="/login.php" style="color:black;color:green;text-decoration:none;" >Login</a>';
						}
					?>
				</span>
			</div>
			<div id = products_box>
				<br>
				<form action="my_orders.php" method="post" enctype="multipart/form-data">
					<table align="center" width="700" bgcolor="skyblue">
						<tr align="center">
							<th>Order - ID</th>
							<th>Order - Time</th>
							<th>Product(S)</th>
							<th>Quantity</th>
						</tr>

						<?php
							$user = $_SESSION['username'];
							$total = 0;
							$total_cart_price = 0;
							global $con;
							$ip = getIp();
							$get_order = "select * from orders where c_id='$user'";
							$run_order = mysqli_query($con, $get_order);
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
								$pro_qty = $row_order['qty'];
								$pro_date_time = $row_order['order_date_time'];
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

						</tr>
							<?php }
						  ?>



					</table>
				</form>

			</div>
        </div>
      </div>

      <div id="footer"> <h2 style="text-align:center;padding-top:10px;">&copy; 2018 by dbcart.com </h2> </div>
    </div>

  </body>
</html>
