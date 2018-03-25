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
        <a href="index.php"><img id="logo" src="images/logo.png" ></a>
				<img src="images/banner.png" id="banner1" height="100px" width="300">
        <img src="images/online_shop.jpg" id="banner" height="100px" width="500">
      </div>

      <div class="menubar">
        <ul id="menu">
          <li><a href="index.php">Home</a></li>
          <li><a href="customer/my_account.php">My Account</a></li>
          <li><a href="all_products.php">All Products</a></li>
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
						echo '<a href="login.php" style="color:black;color:green;text-decoration:none;" >Login</a>';
					}
				?>
            </span>
          </div>
          <div id="products_box">
            <?php
            $get_pro = "select * from products";
            $run_pro = mysqli_query($con,$get_pro);
            while ($row_pro=mysqli_fetch_array($run_pro)) {
              $pro_id = $row_pro['product_id'];
              $pro_cat = $row_pro['product_cat'];
              $pro_brand = $row_pro['product_brand'];
              $pro_title = $row_pro['product_title'];
              $pro_price = $row_pro['product_price'];
              $pro_image = $row_pro['product_image'];

              echo " <div id='single_product'>
                      <h4>$pro_title</h4>
                      <img src='admin_area/product_images/$pro_image' width='180' height='180 border=bold'>
                      <p><b>&#8377 $pro_price</b></p>
                      <a href='details.php?pro_id=$pro_id' style='float:left; text-decoration:none; color:black'>Details</a>
                      <a href='index.php?pro_id=$pro_id'><button style='float:right; font-weight:bold'>Add to Cart</button></a>
                      </div>";
          }

             ?>
          </div>
        </div>
      </div>

      <div id="footer"> <h2 style="text-align:center;padding-top:10px;">&copy; 2018 by dbcart.com </h2> </div>
    </div>

  </body>
</html>
