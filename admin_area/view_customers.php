<table width ="795" align="center" bgcolor="pink">

	<tr align="center">
		<td colspan="6">
			<h2>View All Customers Here</h2>
		</td>
	</tr>
	<tr align = "center" bgcolor="skyblue">
		<th>S.N.</th>
		<th>Name</th>
		<th>Username</th>
		<th>Image</th>
		<th>Delete</th>
	</tr>
	<?php
		include("includes/db.php");
		global $con;
		$get_c = "select * from customer";
		$run_c = mysqli_query($con,$get_c);
		$i=0;
		while($row_c=mysqli_fetch_array($run_c)){
			//$c_id = $row_c['customer_id'];
			$c_name = $row_c['name'];
			$c_username = $row_c['username'];
			$c_image = $row_c['image'];
			$i++;
			// while is not closing here

	 ?>
	<tr align="center">
		<td><?php echo $i;?></td>
		<td><?php echo $c_name;?></td>
		<td><?php echo $c_username;?></td>
		<td><img src="../customer/customer_images/<?php echo $c_image;?>" width="60" height="60" /></td>
		<td><a href="delete_customer.php?delete_c=<?php echo $c_username; ?>">Delete</a></td>

	</tr>
	<?php
		} // end of while loop
	?>

</table>