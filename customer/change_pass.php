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
				<h2 style = "text-align:center;">Change Your Password</h2>
				<form action = "change_pass.php"  method = "post" enctype="multipart/form-data">
					<table align = "center" , width = "600">
					<tr>	
						<td align = "right"><b>Enter Current Password:</b></td>
						<td><input type = "password" name = "current_pass" required></td>
					</tr>
					<tr>
						<td align = "right"><b>Enter New Password:</b></td>
						<td><input type = "password" name = "new_pass" required></td>

					</tr>
					<tr>
						<td align = "right"><b>Enter New Password Again:</b></td>
						<td><input type = "password" name = "new_pass_again" required></td>

					</tr>
					<tr align = "center">
						<td colspan = "8" align = "center"><input type = "submit" name = "change_pass" value="Change Password"/></td>
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
		if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['change_pass'])){
			//$ip = getIp();
			
			$current_pass = ($_POST['current_pass']);
			$new_pass = $_POST['new_pass'];
			$new_again = $_POST['new_pass_again'];
			
			$sel_pass = "select * from customer where password = '".md5($current_pass)."' AND username = '".$_SESSION['username']."'";
			$run_pass = mysqli_query($con , $sel_pass);

			$check_pass = mysqli_num_rows($run_pass);
			
			if($check_pass == 0){
				echo "<script>alert('Your current password is wrong !')</script>";
				exit();
			}
			if($new_pass != $new_again){
				echo "<script>alert('New password do not match !')</script>";
				exit();
			}
			else{
				$update_pass = " update customer set password = '".md5($new_pass)."' where username = '".$_SESSION['username']."' " ;
				$run_update = mysqli_query($con , $update_pass);
				header('Location: my_account.php');
				//echo "<script>alert('Your password was updated successfully !')</script>" ;
			}
		}
	?>








<?php
	/*include("includes/db.php");
	if(isset($_POST['change_pass'])){

		$user = $_SESSION['username'];
		$current_pass = ($_POST['current_pass']);
		$new_pass = $_POST['new_pass'];
		$new_again = $_POST['new_pass_again'];

		$sel_pass = "select * from customer where password = '$current_pass' AND 
		username = '$user' ";

		$run_pass = mysqli_query($con , $sel_pass);

		$check_pass = mysqli_num_rows($run_pass);

		if($check_pass == 0){
			echo "<script>alert('Your current password is wrong !')</script>";
			exit();
		}
		if($new_pass != $new_again){
			echo "<script>alert('New password do not match !')</script>";
			exit();
		}
		else{
			$update_pass = " update customer set password = '$new_pass' 
			where username = '$user' " ;
			$run_update = mysqli_query($con , $update_pass);
			echo "<script>alert('Your password was updated successfully !')</script>" ;
			echo "<script>window.open('my_account.php' ,'_self')</script>";
		}



	}*/
?>