<?php
	include 'dbcon.php';
	
	$ids = $_GET['id'];
	
	$deletequery = "delete from payroll where salary_id = '$ids'";
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
			location.replace("Manage_Payroll.php");
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
			location.replace("Manage_Payroll.php");
		</script>
		<?php
	}
	
?>