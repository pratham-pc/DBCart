<?php
	session_start();
	include("functions/functions.php");
?>
<html>
<head>
	<title> DBCart </title>
    <link rel="stylesheet" href="styles/style.css" media="all">
</head>
<body>
	<?php
		if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['register'])){
			//$ip = getIp();

			$c_name = $_POST['c_name'];
			$c_username = $_POST['c_username'];
			$c_pass = md5($_POST['c_pass']);
			$c_image = $_FILES['c_image']['name'];
			$c_image_tmp = $_FILES['c_image']['tmp_name'];
			$c_country = $_POST['c_country'];
			$c_city = $_POST['c_city'];
			$c_mobile = $_POST['c_mobile'];
			$c_address = $_POST['c_address'];
			$c_state = $_POST['c_state'];

			move_uploaded_file($c_image_tmp,"customer/customer_images/".$c_image);
			$sql_query = "insert into customer values('".$c_username."', '".$c_name."', '".$c_pass."', '".$c_image."', '".$c_mobile."', '".$c_address."', '".$c_city."', '".$c_state."', '".$c_country."')";

			/*$conn = new mysqli('localhost','root','','DBcart');
			if($conn->connect_error){die("Connection failed");}*/

			$result = mysqli_query($con, $sql_query);

			if($result){
				$_SESSION['username'] = $c_username;
				$_SESSION['name'] = $c_name;
				$_SESSION['image'] = $c_image;
				$_SESSION['mobile'] = $c_mobile;
				$_SESSION['address'] = $c_address;
				$_SESSION['city'] = $c_city;
				$_SESSION['state'] = $c_state;
				$_SESSION['country'] = $c_country;
				//echo "Registration successful";

				if(isset($_SESSION['checkout'])){
					if($_SESSION['checkout']==1){
						$_SESSION['checkout'] = 0;
						echo "<script>window.open('/checkout.php','_self')</script>";
					}
					else{
						echo "<script>window.open('/index.php','_self')</script>";
					}
				}
				else{
					echo "<script>window.open('/index.php','_self')</script>";
				}
			}
			else{
				echo "Registration unsuccessful";
			}
		}
	?>

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
					echo '<li><a href="register.php">Sign Up</a></li>';
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
			<div id="products_box">
				<form method="post" action="register.php" enctype="multipart/form-data">
					<table align="center" width="750" bgcolor="skyblue">
						<tr align="center">
							<td colspan="6"><h2>Create an account</h2></td>
						</tr>

						<tr>
							<td align="right">Name</td>
							<td><input type="text" name="c_name" required></td>
						</tr>

						<tr>
							<td align="right">Username</td>
							<td><input type="text" name="c_username" required></td>
						</tr>

						<tr>
							<td align="right">Password</td>
							<td><input type="password" name="c_pass" required></td>
						</tr>

						<tr>
							<td align="right">Image</td>
							<td><input type="file" name="c_image" required></td>
						</tr>

						<tr>
							<td align="right">Mobile no</td>
							<td><input type="text" name="c_mobile" required></td>
						</tr>

						<tr>
							<td align="right">Address</td>
							<td><textarea cols="15" rows="1" name="c_address" required></textarea></td>
						</tr>

						<tr>
							<td align="right">City</td>
							<td><input type="text" name="c_city" required></td>
						</tr>

						<tr>
							<td align="right">State</td>
							<td><input type="text" name="c_state" required></td>
						</tr>

						<tr>
							<td align="right">Country</td>
							<td>
								<select name="c_country">
									<option>Algeria</option>
									<option>Belgium</option>
									<option>Canada</option>
									<option>Denmark</option>
									<option>Egypt</option>
									<option>France</option>
									<option>Germany</option>
									<option>Hungary</option>
									<option>India</option>
									<option>Japan</option>
								</select>
							</td>
						</tr>

						<tr align="center">
							<td colspan="6"><input type="submit" name="register" value="Register"></td>
						</tr>
					</table>
				</form>
			</div>
        </div>
      </div>

      <div id="footer"> <h2 style="text-align:center;padding-top:10px;">&copy; 2018 by dbcart.com </h2> </div>
    </div>
</body>
</html>
