<?php
	session_start();
	if(!isset($_SESSION['user_email'])){
		echo "<script>window.open('login.php?not_admin=You are not admin !','_self')</script>";
	}
	else{
?>

<!DOCTYPE>

<!DOCTYPE html>
<html>
<head>
	<title></title>

<link rel="stylesheet"  href="styles/style.css" media = "all" />
</head>
<body>
	<div class = "main_wrapper">
		<div id = "header">
			<a href="/index.php"><img id="logo" src="/images/logo.png" ></a>
		</div>
		<div id="right">
			<h2 style="text-align: center;">Manage Content</h2>
			<a href="index.php?insert_product" ><b>Insert New Products</b></a>
			<a href="index.php?view_products"><b>View all products</b></a>
			<a href="index.php?insert_cat"><b>Insert New Category</b></a>
			<a href="index.php?view_cats"><b>View All Categories</b></a>
			<a href="index.php?insert_brand"><b>Insert New Brands</b></a>
			<a href="index.php?view_brands"><b>View All Brands</b></a>
			<a href="index.php?view_customers"><b>View Customers</b></a>
			<a href="index.php?view_orders"><b>View Orders</b></a>
			<a href="index.php?view_payments"><b>View Payments</b></a>
			<a href="logout.php"><b>Admin Logout</b></a>
		</div>
		<div id="left">
			<br><br>
			<h2 style="color: red; text-align: center;"><?php echo @$_GET['logged_in'];?></h2>
			<?php
				if(isset($_GET['insert_product'])){
					include("insert_product.php");
				}
				if(isset($_GET['view_products'])){
					include("view_products.php");
				}
				if(isset($_GET['edit_pro'])){
					include("edit_pro.php");
				}
				if(isset($_GET['insert_cat'])){
					include("insert_cat.php");
				}
				if(isset($_GET['view_cats'])){
					include("view_cats.php");
				}
				if(isset($_GET['edit_cat'])){
					include("edit_cat.php");
				}
				if(isset($_GET['insert_brand'])){
					include("insert_brand.php");
				}
				if(isset($_GET['view_brands'])){
					include("view_brands.php");
				}
				if(isset($_GET['edit_brand'])){
					include("edit_brand.php");
				}
				if(isset($_GET['view_customers'])){
					include("view_customers.php");
				}
				if(isset($_GET['view_payments'])){
					include("view_payments.php");
				}
				if(isset($_GET['view_orders'])){
					include("view_orders.php");
				}


			?>
		</div>

</body>
</html>

<?php
	} // else ending
?>
