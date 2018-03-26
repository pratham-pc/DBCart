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
				<br>
				<h2 style = "text-align:center;">Do you really want to delete your account? </h2>
				<form action = "delete_account.php" method = "post">
					<br>
					<input type="submit" name="yes" value = "Yes I want" />
					<input type="submit" name="no" value = "No I was Joking" />

				</form>
			</div>
        </div>
      </div>

      <div id="footer"> <h2 style="text-align:center;padding-top:10px;">&copy; 2018 by dbcart.com </h2> </div>
    </div>

  </body>
</html>

	<?php
		if($_SERVER["REQUEST_METHOD"]=="POST"){
			//$ip = getIp();

			$user = $_SESSION['username'];
			if(isset($_POST['yes'])){
				$delete_customer="delete from customer where username = '$user'";
				$run_customer = mysqli_query($con , $delete_customer);
				echo "<script>alert('Your account has been deleted successfully !')</script>";
				header('Location: ../logout.php');
				//echo "<script>window.open('../index.php','_self')</script>";
			}
			if(isset($_POST['no'])){
				//echo "hello world";
				echo "<script>alert('Do not Joke again !')</script>";
				header('Location: my_account.php');
				//echo "<script>window.open('my_account.php','_self')</script>";
			}
		}
	?>
