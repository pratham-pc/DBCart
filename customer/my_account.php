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
				<?php
					/*if(!isset($_GET['my_orders'])){
						if(!isset($_GET['edit_account'])){
							if(!isset($_GET['change_pass'])){
								if(!isset($_GET['delete_account'])){
									*/echo "<h2 style='padding:20px;'> Welcome: ".$_SESSION['name']."</h2><br>";
									echo "<b>Thanks for shopping with DBCart !</b>";
								/*}
							}
						}
					}

					if(isset($_GET['edit_account'])){
						include("edit_account.php");
					}
					if(isset($_GET['change_pass'])){
						include("change_pass.php");
					}
					if(isset($_GET['delete_account'])){
						include("delete_account.php");
					}*/
				?>

			</div>
        </div>
      </div>

      <div id="footer"> <h2 style="text-align:center;padding-top:10px;">&copy; 2018 by dbcart.com </h2> </div>
    </div>

  </body>
</html>
