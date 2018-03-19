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
		if(isset($_POST['login']) && $_SERVER["REQUEST_METHOD"]=="POST"){
			$sql_query = "select * from customer where username = '".$_POST['username']."' and password = '".md5($_POST['pass'])."'";
			
			//$conn = new mysqli('localhost','root','','DBcart');
			//if($conn->connect_error){die("Connection failed");}

			$result = mysqli_query($con, $sql_query);
			
			if(mysqli_num_rows($result)>0){
				$row = mysqli_fetch_array($result);
				
				$_SESSION['username'] = $row['username'];
				$_SESSION['name'] = $row['name'];
				$_SESSION['image'] = $row['image'];
				$_SESSION['mobile'] = $row['mobile'];
				$_SESSION['address'] = $row['address'];
				$_SESSION['city'] = $row['city'];
				$_SESSION['state'] = $row['state'];
				$_SESSION['country'] = $row['country'];
				
				echo "Login successful";
				if(isset($_SESSION['checkout'])){
					if($_SESSION['checkout']==1){
						$_SESSION['checkout'] = 0;
						header('Location: checkout.php');
					}
					else{
						header('Location: index.php');
					}
				}
				else{
					header('Location: index.php');
				}
			}
			else{
				echo "Login failed";
			}
			
		}
	?>
	
	<div class="main_wrapper">
      <div class="header_wrapper">
        <a href="index.php"><img id="logo" src="images/logo.png" ></a>
        <img src="images/online_shop.jpg" id="banner" height="100px" width="500">
      </div>

      <div class="menubar">
        <ul id="menu">
          <li><a href="index.php">Home</a></li>
          <li><a href="all_products.php">All Products</a></li>
          <li><a href="customer/my_account.php">My Account</a></li>
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
				<form method="post" action="login.php" enctype="multipart/form-data">
					<table align="center" width="500" bgcolor="skyblue">
						<tr align="center">
							<td colspan="6"><h2>Login or register to buy</h2></td>
						</tr>
						
						<tr>
							<td align="right">Username</td>
							<td><input type="text" name="username" placeholder="enter username" required></td>
						</tr>
						
						<tr>
							<td align="right">Password</td>
							<td><input type="password" name="pass" placeholder="enter password" required></td>
						</tr>
						
						<tr align="center">
							<td colspan="6"><input type="submit" name="login" value="Login"></td>
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
