<?php
	include("includes/db.php");
	include("includes/functions.php");
	if(isset($_GET['delete_c'])){
		$delete_id = $_GET['delete_c'];
		//echo $delete_id ;
		$delete_c = "delete from customer where username = '$delete_id'";
		$run_delete = mysqli_query($con,$delete_c);
		$row = mysqli_fetch_array($run_delete);
		echo $delete_c;
		echo $row['username'];
		echo $row['name'];
		if($run_delete){
			echo "<script>alert('A customer has been deleted !')</script>";
			echo "<script>window.open('index.php?view_customers','_self')</script>";
		}
	}

?>