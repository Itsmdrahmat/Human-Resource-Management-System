<?php
	include 'dbcon.php';
	
	$emp_id = $_GET['id'];
	
	$deletequery = "delete from employee where emp_id = '$emp_id'";
	$query = mysqli_query($con,$deletequery);
	if($query)
	{
		?>
		<script>
			alert("Deleted Successfully");
		</script>
		<?php
		
		?>
		<script>
			location.replace("Manage_Employee.php");
		</script>
		<?php
	}
	else
	{
		?>
		<script>
			alert("Do not Deleted");
		</script>
		<?php
		
		?>
		<script>
			location.replace("Manage_Employee.php");
		</script>
		<?php
	}
	
?>