<?php
	session_start();
	include("../functions/functions.php");
	include("../includes/db.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V3</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
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
						header('Location: ../checkout.php');
					}
					else{
						header('Location: ../index.php');
					}
				}
				else{
					header('Location: ../index.php');
				}
			}
			else{
				echo "Login failed";
			}
			
		}
	?>
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="post" action="login.php" >
					<span class="login100-form-logo">
						<i class="zmdi zmdi-landscape"></i>
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Log in
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">
							Remember me
						</label>
					</div>

					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn" name="login">
							Login
						</button>
					</div>

					<div class="text-center p-t-90">
						<a class="txt1" href="#">
							Forgot Password?
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>

<?php
	
	/*include("../includes/db.php");
	if(isset($_POST['login'])){
		$uname = ($_POST['username']);
		$pass = ($_POST['pass']);
		$sql_query = "select * from customer where username = '".$_POST['username']."' and password = '".md5($_POST['pass'])."'";
		$run_user = mysqli_query($con , $sql_query);
		$check_user = mysqli_num_rows($run_user);

		if($check_user == 0){
			echo "<script>alert('Password or username is wrong try Again')</script>";
		}
		else{
			$_SESSION['username'] = $uname ;
			echo "<script>window.open('../index.php?logged_in=You have successfully logged in !!!','_self')</script>";
		}
	}*/
?>