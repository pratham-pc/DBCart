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
    <div class="main_wrapper">
      <div class="header_wrapper">
        <a href="../index.php"><img id="logo" src="images/logo.png" ></a>
				<img src="images/banner.png" id="banner1" height="100px" width="300">
        <img src="images/online_shop.jpg" id="banner" height="100px" width="500">
      </div>

      <div class="menubar">
        <ul id="menu">
          <li><a href="../index.php">Home</a></li>
          <li><a href="../all_products.php">All Products</a></li>
          <li><a href="my_account.php">My Account</a></li>
          <li><a href="../cart.php">Cart</a></li>
			<?php
				if(!isset($_SESSION['username'])){
					echo '<li><a href="../register.php">Sign Up</a></li>';
				}
			?>
        </ul>

        <div id="form">
          <form action="../results.php" method="get" enctype="multipart/form-data">
            <input type="text" name="user_query" placeholder="I am looking for">
            <input type="submit" name="search" value="Search">
          </form>
        </div>
      </div>

      <div class="content_wrapper">
        <div id="sidebar">
          <div id="sidebar_title">My Account</div>
          <ul id="cats">
			<?php
				echo "<p style='text-align:center;'><img src='customer_images/".$_SESSION['image']."' width='150' height='150'></p>";
			?>
            <li><a href="my_orders.php">My Orders</a></li>
			<li><a href="edit_account.php">Edit Account</a></li>
			<li><a href="change_pass.php">Change Password</a></li>
			<li><a href="delete_account.php">Delete Account</a></li>
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
					?>

					<?php
						if(isset($_SESSION['username'])){
							echo '<a href="../logout.php" style="color:black;color:green;text-decoration:none;" >Logout</a>';
						}
						else{
							echo '<a href="../login.php" style="color:black;color:green;text-decoration:none;" >Login</a>';
						}
					?>
				</span>
			</div>
			<div id="products_box">
				<form method="post" action="edit_account.php" enctype="multipart/form-data">
					<table align="center" width="750" bgcolor="skyblue">
						<tr align="center">
							<td colspan="6"><h2>Update your account</h2></td>
						</tr>

						<tr>
							<td align="right">Name</td>
							<td><input type="text" name="c_name" value="<?php echo $_SESSION['name'] ; ?>"></td>
						</tr>

						<tr>
							<td align="right">Username</td>
							<td><input type="text" name="c_username" value="<?php echo $_SESSION['username'] ; ?>"></td>
						</tr>

						<tr>
							<td align="right">Image</td>
							<td><input type="file" name="c_image" ><img src="customer_images/<?php echo $_SESSION['image'] ; ?>" width = "50" height = "50" /></td>
						</tr>

						<tr>
							<td align="right">Mobile no</td>
							<td><input type="text" name="c_mobile" value="<?php echo $_SESSION['mobile'] ; ?>" ></td>
						</tr>

						<tr>
							<td align="right">Address</td>
							<td><textarea cols="15" rows="1" name="c_address"><?php echo $_SESSION['address']; ?></textarea></td>
						</tr>

						<tr>
							<td align="right">City</td>
							<td><input type="text" name="c_city" value="<?php echo $_SESSION['city'] ; ?>" ></td>
						</tr>

						<tr>
							<td align="right">State</td>
							<td><input type="text" name="c_state" value="<?php echo $_SESSION['state'] ; ?>" ></td>
						</tr>

						<tr>
							<td align="right">Customer Country</td>
							<td>
								<select name="c_country" disabled >
									<option><?php echo $_SESSION['country'] ; ?></option>
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
							<td colspan="6"><input type="submit" name="update" value="Update"></td>
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

	<?php
		if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['update'])){
			//$ip = getIp();

			$c_name = $_POST['c_name'];
			$c_username = $_POST['c_username'];

			if($_FILES['c_image']['name']!=""){
				$c_image = $_FILES['c_image']['name'];
				$c_image_tmp = $_FILES['c_image']['tmp_name'];
				move_uploaded_file($c_image_tmp,"customer_images/".$c_image);
			}
			else{
				$c_image = $_SESSION['image'];
			}


			//$c_country = $_POST['c_country'];
			$c_city = $_POST['c_city'];
			$c_mobile = $_POST['c_mobile'];
			$c_address = $_POST['c_address'];
			$c_state = $_POST['c_state'];



			$update_c = "update customer set username='$c_username',name='$c_name',city='$c_city',state='$c_state',image='$c_image',mobile='$c_mobile',address='$c_address' where username='".$_SESSION['username']."'";

			$result = mysqli_query($con, $update_c);

			if($result){
				$_SESSION['username'] = $c_username;
				$_SESSION['name'] = $c_name;
				$_SESSION['image'] = $c_image;
				$_SESSION['mobile'] = $c_mobile;
				$_SESSION['address'] = $c_address;
				$_SESSION['city'] = $c_city;
				$_SESSION['state'] = $c_state;

				header('Location: my_account.php');
				//$_SESSION['country'] = $c_country;
				/*echo "<script>alert('Your account has been successfully updated !!!')</script>";
				echo "<script>window.open('my_account.php','_self')</script>";*/
			}
			else{
				echo "Registration unsuccessful";
			}
		}
	?>
